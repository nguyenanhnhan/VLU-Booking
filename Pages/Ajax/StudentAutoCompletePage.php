<?php

require_once(ROOT_DIR . 'Domain/Access/namespace.php');
require_once(ROOT_DIR . 'Pages/SecurePage.php');

class StudentAutoCompletePage extends Page
{
    private $listMethods = [];

    public function __construct()
    {
        parent::__construct();

        $this->listMethods[StudentAutoCompleteType::Student] = 'GetStudents';
        $this->listMethods[StudentAutoCompleteType::MyStudents] = 'GetMyStudents';
        $this->listMethods[StudentAutoCompleteType::Group] = 'GetGroups';
        $this->listMethods[StudentAutoCompleteType::Organization] = 'GetOrganizations';
    }

    public function PageLoad()
    {
        $results = $this->GetResults($this->GetType(), $this->GetSearchTerm());

        Log::Debug(sprintf('AutoComplete: %s results found for search type: %s, term: %s', count($results), $this->GetType(), $this->GetSearchTerm()));

        $this->SetJson($results);
    }

    private function GetResults($type, $term)
    {
        if (array_key_exists($type, $this->listMethods)) {
            $method = $this->listMethods[$type];
            return $this->$method($term);
        }

        Log::Debug("AutoComplete for type: $type not defined");

        return [];
    }

    public function GetType()
    {
        return $this->GetQuerystring(QueryStringKeys::AUTOCOMPLETE_TYPE);
    }

    public function GetSearchTerm()
    {
        return $this->GetQuerystring(QueryStringKeys::AUTOCOMPLETE_TERM);
    }

    /**
     * @param $term string
     * @return array|AutocompleteStudent[]
     */
    private function GetStudents($term)
    {
        if ($term == 'group') {
            return $this->GetGroupUsers($this->GetQuerystring(QueryStringKeys::GROUP_ID));
        }

        $onlyActive = false;
        $activeQS = $this->GetQuerystring(QueryStringKeys::ACCOUNT_STATUS);
        if ($activeQS == AccountStatus::ACTIVE) {
            $onlyActive = true;
        }
        $filter = new SqlFilterLike(ColumnNames::STUDENT_ID, $term);
        $filter->_Or(new SqlFilterLike(ColumnNames::FULL_NAME, $term));
        $filter->_Or(new SqlFilterLike(ColumnNames::EMAIL, $term));
        $filter->_Or(new SqlFilterLike(ColumnNames::DEPARTMENT_NAME, $term));

        $r = new UserRepository();
        $currentUser = ServiceLocator::GetServer()->GetUserSession();
        $user = $r->LoadById($currentUser->UserId);

        $status = AccountStatus::ACTIVE;
        if (!$onlyActive && ($currentUser->IsAdmin || $currentUser->IsGroupAdmin)) {
            $status = AccountStatus::ALL;
        }
        $results = $r->GetStudentList(1, 1, null, null, $filter)->Results();
        

        $hideUserDetails = Configuration::Instance()->GetSectionKey(ConfigSection::PRIVACY, ConfigKeys::PRIVACY_HIDE_USER_DETAILS, new BooleanConverter());
        $users = [];
        /** @var $result UserItemView */
        foreach ($results as $result) {
            if (!$hideUserDetails || $result->Id == $currentUser->UserId || $user->IsGroupAdminFor($result->GroupIds) || $currentUser->IsAdmin) {
                $users[] = new AutocompleteStudent($result->Id, $result->Email, $result->FullName);
            }
        }

        return $users;
    }

    private function GetGroups($term)
    {
        $filter = new SqlFilterLike(new SqlFilterColumn(TableNames::GROUPS_ALIAS, ColumnNames::GROUP_NAME), $term);
        $r = new GroupRepository();
        return $r->GetList(1, PageInfo::All, null, null, $filter)->Results();
    }

    /**
     * @param $term string
     * @return array|AutocompleteStudent[]
     */
    private function GetMyStudents($term)
    {
        $userSession = ServiceLocator::GetServer()->GetUserSession();
        if ($userSession->IsAdmin || $userSession->IsResourceAdmin || $userSession->IsScheduleAdmin) {
            return $this->GetStudents($term);
        }

        $userRepo = new UserRepository();
        $user = $userRepo->LoadById($userSession->UserId);

        $groupIds = [];

        foreach ($user->GetAdminGroups() as $group) {
            $groupIds[] = $group->GroupId;
        }

        $users = [];
        if (!empty($groupIds)) {
            $userFilter = new SqlFilterLike(ColumnNames::FIRST_NAME, $term);
            $userFilter->_Or(new SqlFilterLike(ColumnNames::LAST_NAME, $term));

            $groupRepo = new GroupRepository();
            $results = $groupRepo->GetUsersInGroup($groupIds, null, null, $userFilter)->Results();

            /** @var $result UserItemView */
            foreach ($results as $result) {
                // consolidates results by user id if the user is in multiple groups
                $users[$result->Id] = new AutocompleteStudent($result->Id, $result->First, $result->Last, $result->Email, $result->FullName);
            }
        }

        return array_values($users);
    }

    private function GetGroupUsers($groupId)
    {
        $groupRepo = new GroupRepository();
        $results = $groupRepo->GetUsersInGroup($groupId)->Results();

        $users = [];
        /** @var $result UserItemView */
        foreach ($results as $result) {
            // consolidates results by user id if the user is in multiple groups
            $users[$result->Id] = new AutocompleteStudent($result->Id, $result->First, $result->Last, $result->Email, $result->FullName);
        }

        return array_values($users);
    }

    private function GetOrganizations($term)
    {
        $filter = new SqlFilterLike(ColumnNames::ORGANIZATION, $term);

        $r = new UserRepository();
        $results = $r->GetList(1, PageInfo::All, null, null, $filter)->Results();

        $organizations = [];
        /** @var $result UserItemView */
        foreach ($results as $result) {
            $organizations[] = $result->Organization;
        }

        return $organizations;
    }
}

class AutocompleteStudent
{
    public $Id;
    public $Email;
    public $FullName;
    public $DisplayName;

    public function __construct($userId, $email, $fullName)
    {
        
        $this->Id = $userId;
        $this->Email = $email;
        $this->FullName = $fullName;
        $this->DisplayName = "($email) ($fullName)";
        
    }
}

class StudentAutoCompleteType
{
    public const Student = 'student';
    public const Group = 'group';
    public const MyStudents = 'myStudents';
    public const Organization = 'organization';
}
