<?php

require_once(ROOT_DIR . 'Domain/Access/namespace.php');
require_once(ROOT_DIR . 'Presenters/ActionPresenter.php');
require_once(ROOT_DIR . 'lib/Application/Authentication/namespace.php');
require_once(ROOT_DIR . 'lib/Application/User/namespace.php');
require_once(ROOT_DIR . 'lib/Application/Admin/LecturerImportCsv.php');
require_once(ROOT_DIR . 'lib/Application/Admin/LecturerImportExcel.php');
require_once(ROOT_DIR . 'lib/Application/Admin/CsvImportResult.php');
require_once(ROOT_DIR . 'lib/Email/Messages/InviteUserEmail.php');
require_once(ROOT_DIR . 'lib/Email/Messages/AccountCreationForUserEmail.php');

class ManageUsersActions
{
    public const Activate = 'activate';
    public const AddUser = 'addUser';
    public const ChangeAttribute = 'changeAttribute';
    public const Deactivate = 'deactivate';
    public const DeleteUser = 'deleteUser';
    public const Password = 'password';
    public const Permissions = 'permissions';
    public const UpdateUser = 'updateUser';
    public const ChangeColor = 'changeColor';
    public const ImportUsers = 'importUsers';
    public const ChangeCredits = 'changeCredits';
    public const InviteUsers = 'inviteUsers';
    public const DeleteMultipleUsers = 'deleteMultipleUsers';
}

class ManageLecturersActions
{
    public const Activate = 'activate';
    public const AddLecturer = 'addLecturer';
    public const ChangeAttribute = 'changeAttribute';
    public const Deactivate = 'deactivate';
    public const DeleteLecturer = 'deleteLecturer';
    public const Password = 'password';
    public const Permissions = 'permissions';
    public const UpdateLecturer = 'updateLecturer';
    public const ChangeColor = 'changeColor';
    public const ImportUsers = 'importUsers';
    public const ChangeCredits = 'changeCredits';
    public const InviteUsers = 'inviteUsers';
    public const DeleteMultipleDepartments = 'deleteMultipleDepartments';
}

interface IManageLecturersPresenter
{
    public function AddLecturer();

    public function UpdateLecturer();
}

class ManageLecturersPresenter extends ActionPresenter implements IManageLecturersPresenter
{
    /**
     * @var IManageLecturersPage
     */
    private $page;

    /**
     * @var IUserRepository
     */
    private $userRepository;

    /**
     * @var ResourceRepository
     */
    private $resourceRepository;

    /**
     * @var PasswordEncryption
     */
    private $passwordEncryption;

    /**
     * @var IManageUsersService
     */
    private $manageUsersService;
    
    /**
     * @var IManageLecturersService
     */
    private $manageLecturersService;

    /**
     * @var IAttributeService
     */
    private $attributeService;

    /**
     * @var IGroupRepository
     */
    private $groupRepository;

    /**
     * @var IGroupViewRepository
     */
    private $groupViewRepository;

    /**
     * @param IGroupRepository $groupRepository
     */
    public function SetGroupRepository($groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    /**
     * @param IGroupViewRepository $groupViewRepository
     */
    public function SetGroupViewRepository($groupViewRepository)
    {
        $this->groupViewRepository = $groupViewRepository;
    }

    /**
     * @param IAttributeService $attributeService
     */
    public function SetAttributeService($attributeService)
    {
        $this->attributeService = $attributeService;
    }

    /**
     * @param ImanageUsersService $manageUsersService
     */
    public function SetManageUsersService($manageUsersService)
    {
        $this->manageUsersService = $manageUsersService;
    }

    /**
     * @param IManageLecturersService $manageLecturersService
     */
    public function SetmanageLecturersService($manageLecturersService)
    {
        $this->manageLecturersService = $manageLecturersService;
    }

    /**
     * @param ResourceRepository $resourceRepository
     */
    public function SetResourceRepository($resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
    }

    /**
     * @param UserRepository $userRepository
     */
    public function SetUserRepository($userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param IManageLecturersPage $page
     * @param UserRepository $userRepository
     * @param IResourceRepository $resourceRepository
     * @param PasswordEncryption $passwordEncryption
     * @param IManageLecturersService $manageLecturersService
     * @param IAttributeService $attributeService
     * @param IGroupRepository $groupRepository
     * @param IGroupViewRepository $groupViewRepository
     */
    public function __construct(
        IManageLecturersPage $page,
        IUserRepository $userRepository,
        IResourceRepository $resourceRepository,
        PasswordEncryption $passwordEncryption,
        IManageLecturersService $manageLecturersService,
        IAttributeService $attributeService,
        IGroupRepository $groupRepository,
        IGroupViewRepository $groupViewRepository
    ) {
        parent::__construct($page);

        $this->page = $page;
        $this->userRepository = $userRepository;
        $this->resourceRepository = $resourceRepository;
        $this->passwordEncryption = $passwordEncryption;
        $this->manageLecturersService = $manageLecturersService;
        $this->attributeService = $attributeService;
        $this->groupRepository = $groupRepository;
        $this->groupViewRepository = $groupViewRepository;

        $this->AddAction(ManageLecturersActions::Activate, 'Activate');
        $this->AddAction(ManageLecturersActions::AddLecturer, 'AddLecturer');
        $this->AddAction(ManageLecturersActions::Deactivate, 'Deactivate');
        $this->AddAction(ManageLecturersActions::DeleteLecturer, 'DeleteLecturer');
        $this->AddAction(ManageLecturersActions::Password, 'ResetPassword');
        $this->AddAction(ManageLecturersActions::Permissions, 'ChangePermissions');
        $this->AddAction(ManageLecturersActions::UpdateLecturer, 'UpdateLecturer');
        $this->AddAction(ManageLecturersActions::ChangeAttribute, 'ChangeAttribute');
        $this->AddAction(ManageLecturersActions::ChangeColor, 'ChangeColor');
        $this->AddAction(ManageLecturersActions::ImportUsers, 'ImportUsers');
        $this->AddAction(ManageLecturersActions::ChangeCredits, 'ChangeCredits');
        $this->AddAction(ManageLecturersActions::InviteUsers, 'InviteUsers');
        $this->AddAction(ManageLecturersActions::DeleteMultipleDepartments, 'DeleteMultipleDepartments');
    }

    public function PageLoad()
    {
        if ($this->page->GetUserId() != null) {
            $userList = $this->userRepository->GetLecturerList(
                1,
                1,
                null,
                null,
                new SqlFilterEquals(ColumnNames::LECTURER_ID, $this->page->GetUserId())
            );
        } else {
            $userList = $this->userRepository->GetLecturerList(
                $this->page->GetPageNumber(),
                $this->page->GetPageSize(),
                $this->page->GetSortField(),
                $this->page->GetSortDirection(),
                null
            );
        }

        $this->page->BindUsers($userList->Results());
        $this->page->BindPageInfo($userList->PageInfo());

        $groups = $this->groupViewRepository->GetDepartmentList();
        $this->page->BindGroups($groups->Results());

        $user = $this->userRepository->LecturerLoadById(ServiceLocator::GetServer()->GetUserSession()->UserId);

        $resources = $this->GetResourcesThatCurrentUserCanAdminister($user);
        $this->page->BindResources($resources);

        $attributeList = $this->attributeService->GetByCategory(CustomAttributeCategory::USER);
        $this->page->BindAttributeList($attributeList);

        $this->page->BindStatusDescriptions();
    }

    public function Deactivate()
    {
        if ($this->page->GetUserId() != ServiceLocator::GetServer()->GetUserSession()->UserId) {
            $user = $this->userRepository->LoadById($this->page->GetUserId());
            $user->Deactivate();
            $this->userRepository->Update($user);
            $this->page->SetJsonResponse(Resources::GetInstance()->GetString('Inactive'));
        } else {
            $this->page->SetJsonResponse(Resources::GetInstance()->GetString('Active'));
        }
    }

    public function Activate()
    {
        $user = $this->userRepository->LoadById($this->page->GetUserId());
        $user->Activate();
        $this->userRepository->Update($user);
        $this->page->SetJsonResponse(Resources::GetInstance()->GetString('Active'));
    }

    public function AddLecturer()
    {
        $this->manageLecturersService->AddLecturer(
            $this->page->GetLecturerId(),
            $this->page->GetFullName(),
            $this->page->GetHireDate(),
            $this->page->GetPhoneNumber(),
            $this->page->GetDepartmentId(),
            $this->page->GetEmail()
            
        );

        // $userId = $user->Id();
        // $groupId = $this->page->GetUserGroup();

        // if (!empty($groupId)) {
        //     $group = $this->groupRepository->LoadById($groupId);
        //     $group->AddUser($userId);
        //     $this->groupRepository->Update($group);
        // }

        // if ($this->page->SendEmailNotification()) {
        //     ServiceLocator::GetEmailService()->Send(new AccountCreationForUserEmail(
        //         $user,
        //         $this->page->GetPassword(),
        //         ServiceLocator::GetServer()->GetUserSession()
        //     ));
        // }
    }

    public function UpdateLecturer()
    {
        Log::Debug('Updating user %s', $this->page->GetUserId());


        $this->manageLecturersService->UpdateLecturer(
            $this->page->GetUserId(),
            $this->page->GetLecturerId(),
            $this->page->GetFullName(),
            $this->page->GetHireDate(),
            $this->page->GetPhoneNumber(),
            $this->page->GetDepartmentId(),
            $this->page->GetEmail()
        );
    }

    public function DeleteLecturer()
    {
        $userId = $this->page->GetUserId();
        Log::Debug('Deleting user %s', $userId);

        $this->manageLecturersService->DeleteLecturer($userId);
    }

    public function ChangePermissions()
    {
        $currentUser = $this->userRepository->LoadById(ServiceLocator::GetServer()->GetUserSession()->UserId);
        $resources = $this->GetResourcesThatCurrentUserCanAdminister($currentUser);

        $acceptableResourceIds = [];

        foreach ($resources as $resource) {
            $acceptableResourceIds[] = $resource->GetId();
        }

        $user = $this->userRepository->LoadById($this->page->GetUserId());
        $allowedResources = [];

        if (is_array($this->page->GetAllowedResourceIds())) {
            $allowedResources = $this->page->GetAllowedResourceIds();
        }

        $allowed = [];
        $view = [];
        foreach ($allowedResources as $resource) {
            $split = explode('_', $resource);
            $resourceId = $split[0];
            $permissionType = $split[1];

            if ($permissionType === ResourcePermissionType::Full . '') {
                $allowed[] = $resourceId;
            } else {
                if ($permissionType === ResourcePermissionType::View . '') {
                    $view[] = $resourceId;
                }
            }
        }

        $currentResources = $user->GetAllowedResourceIds();
        $toRemainUnchanged = array_diff($currentResources, $acceptableResourceIds);

        $user->ChangeAllowedPermissions(array_merge($toRemainUnchanged, $allowed));
        $user->ChangeViewPermissions(array_merge($toRemainUnchanged, $view));
        $this->userRepository->Update($user);
    }

    public function ResetPassword()
    {
        $salt = $this->passwordEncryption->Salt();
        $encryptedPassword = $this->passwordEncryption->Encrypt($this->page->GetPassword(), $salt);

        $user = $this->userRepository->LoadById($this->page->GetUserId());
        $user->ChangePassword($encryptedPassword, $salt);
        $this->userRepository->Update($user);
    }

    public function ChangeAttribute()
    {
        $this->manageUsersService->ChangeAttribute($this->page->GetUserId(), $this->GetInlineAttributeValue());
    }

    public function ExportUsers()
    {
        $this->PageLoad();
        $this->page->ShowExportCsv();
    }

    public function ProcessDataRequest($dataRequest)
    {
        if ($dataRequest == 'permissions') {
            $this->page->SetJsonResponse($this->GetUserResourcePermissions());
        } elseif ($dataRequest == 'groups') {
            $this->page->SetJsonResponse($this->GetUserGroups());
        } elseif ($dataRequest == 'all') {
            $users = $this->userRepository->GetAll();
            $this->page->SetJsonResponse($users);
        } elseif ($dataRequest == 'template') {
            $this->ShowTemplateCSV();
        } elseif ($dataRequest == 'export') {
            $this->ExportUsers();
        } elseif ($dataRequest == 'update') {
            $this->ShowUpdate();
        }
    }

    /**
     * @return int[] all resource ids the user has permission to
     */
    public function GetUserResourcePermissions()
    {
        $user = $this->userRepository->LoadById($this->page->GetUserId());
        return ['full' => $user->GetAllowedResourceIds(), 'view' => $user->GetAllowedViewResourceIds()];
    }

    /**
     * @return array|AttributeValue[]
     */
    private function GetAttributeValues()
    {
        $attributes = [];
        foreach ($this->page->GetAttributes() as $attribute) {
            $attributes[] = new AttributeValue($attribute->Id, $attribute->Value);
        }
        return $attributes;
    }

    private function GetInlineAttributeValue()
    {
        $value = $this->page->GetValue();
        if (is_array($value)) {
            $value = $value[0];
        }
        $id = str_replace(FormKeys::ATTRIBUTE_PREFIX, '', $this->page->GetName());

        return new AttributeValue($id, $value);
    }

    protected function LoadValidators($action)
    {
        Log::Debug('Loading validators for %s', $action);

        if ($action == ManageLecturersActions::UpdateLecturer) {
            // $this->page->RegisterValidator('emailformat', new EmailValidator($this->page->GetEmail()));
            // $this->page->RegisterValidator(
            //     'uniqueemail',
            //     new UniqueEmailValidator($this->userRepository, $this->page->GetEmail(), $this->page->GetUserId())
            // );
            $this->page->RegisterValidator(
                'uniqueusername',
                new UniqueUserNameValidator($this->userRepository, $this->page->GetFullName(), $this->page->GetUserId())
            );
            
        }

        if ($action == ManageLecturersActions::AddLecturer) {
            // $this->page->RegisterValidator('addUserEmailformat', new EmailValidator($this->page->GetEmail()));
            // $this->page->RegisterValidator(
            //     'addUserUniqueemail',
            //     new UniqueEmailValidator($this->userRepository, $this->page->GetEmail())
            // );
            $this->page->RegisterValidator(
                'addUserUsername',
                new UniqueUserNameValidator($this->userRepository, $this->page->GetDepartmentName())
            );
            // $this->page->RegisterValidator(
            //     'addAttributeValidator',
            //     new AttributeValidator(
            //         $this->attributeService,
            //         CustomAttributeCategory::USER,
            //         $this->GetAttributeValues(),
            //         null,
            //         true,
            //         true
            //     )
            // );
        }

        if ($action == ManageUsersActions::ChangeAttribute) {
            $this->page->RegisterValidator(
                'attributeValidator',
                new AttributeValidatorInline(
                    $this->attributeService,
                    CustomAttributeCategory::USER,
                    $this->GetInlineAttributeValue(),
                    $this->page->GetUserId(),
                    true,
                    true
                )
            );
        }
        $validator = ['csv','xlsx'];
        if ($action == ManageLecturersActions::ImportUsers) {
            $this->page->RegisterValidator('fileExtensionValidator', new FileExtensionValidator($validator, $this->page->GetImportFile()));
        }
    }

    /***
     * @return array|int[]
     */
    public function GetUserGroups()
    {
        $userId = $this->page->GetUserId();

        $user = $this->userRepository->LoadById($userId);

        $groups = [];
        foreach ($user->Groups() as $group) {
            $groups[] = $group->GroupId;
        }

        return $groups;
    }

    public function ChangeColor()
    {
        $userId = $this->page->GetUserId();
        Log::Debug('Changing reservation color for userId: %s', $userId);

        $color = $this->page->GetReservationColor();

        $user = $this->userRepository->LoadById($userId);
        $user->ChangePreference(UserPreferences::RESERVATION_COLOR, $color);

        $this->userRepository->Update($user);
    }

    public function ChangeCredits()
    {
        $userId = $this->page->GetUserId();
        $creditCount = $this->page->GetValue();

        Log::Debug('Changing credit count for userId: %s to %s', $userId, $creditCount);

        $user = $this->userRepository->LoadById($userId);
        $user->ChangeCurrentCredits(
            $creditCount,
            Resources::GetInstance()->GetString('CreditsUpdatedLog', [ServiceLocator::GetServer()->GetUserSession()])
        );
        $this->userRepository->Update($user);
    }

    /**
     * @param User $user
     * @return BookableResource[]
     */
    private function GetResourcesThatCurrentUserCanAdminister($user)
    {
        $resources = [];
        $allResources = $this->resourceRepository->GetResourceList();
        foreach ($allResources as $resource) {
            if ($user->IsResourceAdminFor($resource)) {
                $resources[] = $resource;
            }
        }
        return $resources;
    }

    public function ImportUsers()
    {
        ini_set('max_execution_time', 600);

        /** @var CustomAttribute[] $attributesIndexed */
        $attributesIndexed = [];
        /** @var CustomAttribute $attribute */

        $importFile = $this->page->GetImportFile();
        $fileExtension = pathinfo($importFile->OriginalName(), PATHINFO_EXTENSION);

        $importCount = 0;
        $messages = [];

        if (strtolower($fileExtension) === 'csv') {
            $csv = new LecturerImportCsv($importFile, $attributesIndexed);
            $rows = $csv->GetRows();
        } else if (in_array(strtolower($fileExtension), ['xls', 'xlsx'])) {
            $csv = new LecturerImportExcel($importFile, $attributesIndexed);
            $rows = $csv->GetRows();
        } else {
            $this->page->SetImportResult(new CsvImportResult(0, [], 'Unsupported file type'));
            return;
        }

        if (count($rows) == 0) {
            $this->page->SetImportResult(new CsvImportResult(0, [], 'Empty file or missing header row'));
            return;
        }

        $departmentsToInsert = [];

        // First pass: Collect departments to insert
        foreach ($rows as $row) {
            if (!$this->userRepository->DepartmentExists($row->departmentid)) {
                if (!isset($departmentsToInsert[$row->departmentid])) {
                    $departmentsToInsert[$row->departmentid] = [
                        'department_code' => '',
                        'department_name' => $row->departmentname
                    ];
                }
            }
        }

        // Insert departments
        foreach ($departmentsToInsert as $departmentid => $departmentData) {
            $this->userRepository->InsertDepartment($departmentid, $departmentData['department_code'], $departmentData['department_name']);
            $messages[] = "Inserted new department with ID: $departmentid";
        }

        // Second pass: Process rows and insert lecturers
        foreach ($rows as $row) {
            try {
                $this->processRow($row, $messages, $importCount);
            } catch (Exception $ex) {
                Log::Error('Error importing users. %s', $ex);
            }
        }

        $this->page->SetImportResult(new CsvImportResult($importCount, $csv->GetSkippedRowNumbers(), $messages));
    }

    private function processRow($row, &$messages, &$importCount)
    {
        $shouldUpdate = $this->page->GetUpdateOnImport();

        $emailValidator = new EmailValidator($row->emaillecturer);
        $uniqueEmailValidator = new UniqueEmailValidator($this->userRepository, $row->emaillecturer);
        $uniqueUsernameValidator = new UniqueUserNameValidator($this->userRepository, $row->fullname);

        $emailValidator->Validate();
        if (!$emailValidator->IsValid()) {
            $evMsgs = $emailValidator->Messages();
            $messages[] = $evMsgs[0] . " ({$row->emaillecturer})";
            return;
        }

        if (!$shouldUpdate) {
            $uniqueEmailValidator->Validate();
            $uniqueUsernameValidator->Validate();

            if (!$uniqueEmailValidator->IsValid()) {
                $uevMsgs = $uniqueEmailValidator->Messages();
                $messages[] = $uevMsgs[0] . " ({$row->emaillecturer})";
                return;
            }
            if (!$uniqueUsernameValidator->IsValid()) {
                $uuvMsgs = $uniqueUsernameValidator->Messages();
                $messages[] = $uuvMsgs[0] . " ({$row->fullname})";
                return;
            }
        }

        if ($shouldUpdate) {
            $user = $this->manageLecturersService->LoadLecturer($row->emaillecturer);
            if ($user->Id() == null) {
                $shouldUpdate = false;
            } else {
                $user->ChangeLecturerId($row->lecturerid);
                $user->ChangeFullName($row->fullname);
                $user->ChangeHireDate($row->hiredate);
                $user->ChangePhoneNumber($row->phonenumber);
                $user->ChangeDepartmentId($row->departmentid);
                $user->ChangeEmailLecturer($row->emaillecturer);
            }
        }
        if (!$shouldUpdate) {
            $user = $this->manageLecturersService->AddLecturer(
                $row->lecturerid,
                $row->fullname,
                $row->hiredate,
                $row->phonenumber,
                $row->departmentid,
                $row->emaillecturer
            );
        }

        if ($shouldUpdate) {
            $this->userRepository->LecturerUpdate($user);
        }

        $importCount++;
    }


    public function InviteUsers()
    {
        $emailList = $this->page->GetInvitedEmails();
        $emails = preg_split('/[,;\s\n]+/', $emailList);
        foreach ($emails as $email) {
            ServiceLocator::GetEmailService()->Send(new InviteUserEmail(trim($email), ServiceLocator::GetServer()->GetUserSession()));
        }
    }

    public function DeleteMultipleDepartments()
    {
        $ids = $this->page->GetDeletedDepartmentIds();
        Log::Debug('User multiple delete. Ids=%s', implode(',', $ids));
        foreach ($ids as $id) {
            $this->manageLecturersService->DeleteLecturer($id);
        }
    }

    private function ShowTemplateCSV()
    {
        $attributes = $this->attributeService->GetByCategory(CustomAttributeCategory::USER);
        $importAttributes = [];
        foreach ($attributes as $attribute) {
            if (!$attribute->UniquePerEntity()) {
                $importAttributes[] = $attribute;
            }
        }
        $this->page->ShowTemplateCSV($importAttributes);
    }

    private function DetermineStatus($status)
    {
        if ($status == AccountStatus::INACTIVE || strtolower($status) == 'inactive') {
            return AccountStatus::INACTIVE;
        }

        return AccountStatus::ACTIVE;
    }

    public function ShowUpdate()
    {
        //Lấy Id của lecturer
        $userId = $this->page->GetUserId();
        $user = $this->userRepository->LecturerLoadById($userId);
        $attributes = $this->attributeService->GetAttributes(CustomAttributeCategory::USER, [$userId]);
        //Lấy Id của các khoa
        $groups = $this->groupViewRepository->GetDepartmentList();
        $this->page->BindGroups($groups->Results());
        $this->page->ShowUserUpdate($user, $attributes->GetDefinitions(), $groups->Results());
    }
}
