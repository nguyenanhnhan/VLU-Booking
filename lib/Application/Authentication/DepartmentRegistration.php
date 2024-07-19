<?php

require_once(ROOT_DIR . 'Domain/namespace.php');
require_once(ROOT_DIR . 'Domain/Access/namespace.php');
require_once(ROOT_DIR . 'lib/Application/Reservation/ReservationEvents.php');

class DepartmentRegistration implements IDepartmentRegistration
{
    /**
     * @var PasswordEncryption
     */
    private $passwordEncryption;

    /**
     * @var IUserRepository
     */
    private $userRepository;

    /**
     * @var IRegistrationNotificationStrategy
     */
    private $notificationStrategy;

    /**
     * @var IRegistrationPermissionStrategy
     */
    private $permissionAssignmentStrategy;

    /**
     * @var IGroupViewRepository
     */
    private $groupRepository;

    public function __construct(
        $passwordEncryption = null,
        $userRepository = null,
        $notificationStrategy = null,
        $permissionAssignmentStrategy = null,
        $groupRepository = null
    ) {
        $this->passwordEncryption = $passwordEncryption;
        $this->userRepository = $userRepository;
        $this->notificationStrategy = $notificationStrategy;
        $this->permissionAssignmentStrategy = $permissionAssignmentStrategy;
        $this->groupRepository = $groupRepository;

        if ($passwordEncryption == null) {
            $this->passwordEncryption = new PasswordEncryption();
        }

        if ($userRepository == null) {
            $this->userRepository = new UserRepository();
        }

        if ($notificationStrategy == null) {
            $this->notificationStrategy = new RegistrationNotificationStrategy();
        }

        if ($permissionAssignmentStrategy == null) {
            $this->permissionAssignmentStrategy = new RegistrationPermissionStrategy();
        }

        if ($groupRepository == null) {
            $this->groupRepository = new GroupRepository();
        }
    }

    public function DepartmentRegister(
        $departmentid,
        $departmentcode,
        $departmentname,
        $groupid
    ) {
       
        // Create a new Group object
        $group = new Group(null, $departmentname);

        // Add the new group using GroupRepository
        $groupRepository = new GroupRepository();
        $newGroupId = $groupRepository->Add($group);

        // Use the new group ID for the department
        if ($this->CreatePending()) {
            $user = User::DepartmentCreatePending($departmentid, $departmentcode, $departmentname, $newGroupId);
        } else {
            $user = User::DepartmentCreate($departmentid, $departmentcode, $departmentname, $newGroupId);
        }

        $userId = $this->userRepository->AddDepartment($user);
        if ($user->Id() != $userId) {
            $user->WithId($userId);
        }

        return $user;
    }

    /**
     * @return bool
     */
    protected function CreatePending()
    {
        return Configuration::Instance()->GetKey(ConfigKeys::REGISTRATION_REQUIRE_ACTIVATION, new BooleanConverter());
    }

    public function UserExists($loginName, $emailAddress)
    {
        $userId = $this->userRepository->UserExists($emailAddress, $loginName);

        return !empty($userId);
    }

    public function Synchronize(AuthenticatedUser $user, $insertOnly = false, $overwritePassword = true)
    {
        if ($this->UserExists($user->UserName(), $user->Email())) {
            if ($insertOnly) {
                return;
            }

            $password = null;
            $salt = null;

            if ($overwritePassword) {
                $encryptedPassword = $this->passwordEncryption->EncryptPassword($user->Password());
                $password = $encryptedPassword->EncryptedPassword();
                $salt = $encryptedPassword->Salt();
            }

            $command = new UpdateUserFromLdapCommand($user->UserName(), $user->Email(), $user->FirstName(), $user->LastName(), $password, $salt, $user->Phone(), $user->Organization(), $user->Title());
            ServiceLocator::GetDatabase()->Execute($command);

            if ($this->GetUserGroups($user) != null) {
                $updatedUser = $this->userRepository->LoadByUsername($user->Username());
                $updatedUser->ChangeGroups($this->GetUserGroups($user));
                $this->userRepository->Update($updatedUser);
            }
        } else {
            $defaultHomePageId = Configuration::Instance()->GetKey(ConfigKeys::DEFAULT_HOMEPAGE, new IntConverter());
            $additionalFields = ['phone' => $user->Phone(), 'organization' => $user->Organization(), 'position' => $user->Title()];
            $this->DepartmentRegister(
                $user->UserName(),
                $user->Email(),
                $user->FirstName(),
                $user->LastName(),
                $user->Password(),
                $user->TimezoneName(),
                $user->LanguageCode(),
                empty($defaultHomePageId) ? Pages::DEFAULT_HOMEPAGE_ID : $defaultHomePageId,
                $additionalFields,
                [],
                $this->GetUserGroups($user)
            );
        }
    }

    /**
     * @param AuthenticatedUser $user
     * @return null|UserGroup[]
     */
    private function GetUserGroups(AuthenticatedUser $user)
    {
        $userGroups = $user->GetGroups();

        if (empty($userGroups)) {
            return null;
        }
     
        $groupsToSync = [];
        if ($userGroups != null) {
            $lowercaseGroups = array_map('strtolower', $userGroups);
            $altGroups = $userGroups;
            $altGroups= array_map(function($dn) {return sscanf(explode(",", $dn)[0], "cn=%s,")[0];}, $altGroups);

            $groupsToSync = [];
            $groups = $this->groupRepository->GetList()->Results();
            /** @var GroupItemView $group */
            foreach ($groups as $group) {
                if (in_array(strtolower($group->Name()), $lowercaseGroups)) {
                    Log::Debug('Syncing group %s for user %s', $group->Name(), $user->Username());
                    $groupsToSync[] = new UserGroup($group->Id(), $group->Name());
                } else {
                    if (in_array(strtolower($group->Name()), $altGroups)) {
                      Log::Debug('Syncing group %s for user %s', $group->Name(), $user->Username());
                      $groupsToSync[] = new UserGroup($group->Id(), $group->Name());
                    } else {
                      Log::Debug('User %s is not part of group %s, sync skipped', $user->Username(), $group->Name());
                    }
                }
            }
        }

        return $groupsToSync;
    }
}

class DepartmentAdminRegistration extends DepartmentRegistration
{
    protected function DepartmentCreatePending()
    {
        return false;
    }
}

class DepartmentGuestRegistration extends DepartmentRegistration
{
    protected function DepartmentCreatePending()
    {
        return false;
    }
}
