<?php

require_once(ROOT_DIR . 'Domain/Access/namespace.php');
require_once(ROOT_DIR . 'Presenters/ActionPresenter.php');
require_once(ROOT_DIR . 'lib/Application/Authentication/namespace.php');
require_once(ROOT_DIR . 'lib/Application/User/namespace.php');
require_once(ROOT_DIR . 'lib/Application/Admin/VluerImportCsv.php');
require_once(ROOT_DIR . 'lib/Application/Admin/VluerImportExcel.php');
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
//Các hằng số đại diện cho chức năng
class ManageVluersActions
{
    public const Activate = 'activate';
    public const AddStudent = 'addStudent';
    public const ChangeAttribute = 'changeAttribute';
    public const Deactivate = 'deactivate';
    public const DeleteStudent = 'deleteStudent';
    public const Password = 'password';
    public const Permissions = 'permissions';
    public const UpdateStudent = 'updateStudent';
    public const ChangeColor = 'changeColor';
    public const ImportUsers = 'importUsers';
    public const ChangeCredits = 'changeCredits';
    public const InviteUsers = 'inviteUsers';
    public const DeleteMultipleStudents = 'deleteMultipleStudents';
}

interface IManageVluersPresenter
{
    public function AddStudent();

    public function UpdateStudent();
}

class ManageVluersPresenter extends ActionPresenter implements IManageVluersPresenter
{
    /**
     * @var IManageVluersPage
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
     * @var IManageVluersService
     */
    private $manageVluersService;

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
     * @param ImanageVluersService $manageVluersService
     */
    public function SetManageVluersService($manageVluersService)
    {
        $this->manageVluersService = $manageVluersService;
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
     * @param IManageVluersPage $page
     * @param UserRepository $userRepository
     * @param IResourceRepository $resourceRepository
     * @param PasswordEncryption $passwordEncryption
     * @param ImanageVluersService $manageVluersService
     * @param IAttributeService $attributeService
     * @param IGroupRepository $groupRepository
     * @param IGroupViewRepository $groupViewRepository
     */
    public function __construct(
        IManageVluersPage $page,
        IUserRepository $userRepository,
        IResourceRepository $resourceRepository,
        PasswordEncryption $passwordEncryption,
        ImanageVluersService $manageVluersService,
        IAttributeService $attributeService,
        IGroupRepository $groupRepository,
        IGroupViewRepository $groupViewRepository
    ) {
        parent::__construct($page);

        $this->page = $page;
        $this->userRepository = $userRepository;
        $this->resourceRepository = $resourceRepository;
        $this->passwordEncryption = $passwordEncryption;
        $this->manageVluersService = $manageVluersService;
        $this->attributeService = $attributeService;
        $this->groupRepository = $groupRepository;
        $this->groupViewRepository = $groupViewRepository;

        $this->AddAction(ManageVluersActions::Activate, 'Activate');
        $this->AddAction(ManageVluersActions::AddStudent, 'AddStudent');
        $this->AddAction(ManageVluersActions::Deactivate, 'Deactivate');
        $this->AddAction(ManageVluersActions::DeleteStudent, 'DeleteStudent');
        $this->AddAction(ManageVluersActions::Password, 'ResetPassword');
        $this->AddAction(ManageVluersActions::Permissions, 'ChangePermissions');
        $this->AddAction(ManageVluersActions::UpdateStudent, 'UpdateStudent');
        $this->AddAction(ManageVluersActions::ChangeAttribute, 'ChangeAttribute');
        $this->AddAction(ManageVluersActions::ChangeColor, 'ChangeColor');
        $this->AddAction(ManageVluersActions::ImportUsers, 'ImportUsers');
        $this->AddAction(ManageVluersActions::ChangeCredits, 'ChangeCredits');
        $this->AddAction(ManageVluersActions::InviteUsers, 'InviteUsers');
        $this->AddAction(ManageVluersActions::DeleteMultipleStudents, 'DeleteMultipleStudents');
    }

    public function PageLoad() // Định nghĩa phương thức `PageLoad`.
    {
        if ($this->page->GetUserId() != null) { // Kiểm tra nếu người dùng hiện tại đã đăng nhập (UserId không rỗng).
            $userList = $this->userRepository->GetStudentList(
                1, // Trang số 1.
                1, // Kích thước trang là 1.
                null, // Không có trường sắp xếp.
                null, // Không có hướng sắp xếp.
                new SqlFilterEquals(ColumnNames::STUDENT_ID, $this->page->GetUserId()) // Tạo bộ lọc để lấy thông tin sinh viên theo UserId.
            );
        } else { // Nếu người dùng chưa đăng nhập.
            $userList = $this->userRepository->GetStudentList(
                $this->page->GetPageNumber(), // Lấy số trang từ thuộc tính `page`.
                $this->page->GetPageSize(), // Lấy kích thước trang từ thuộc tính `page`.
                $this->page->GetSortField(), // Lấy trường sắp xếp từ thuộc tính `page`.
                $this->page->GetSortDirection(), // Lấy hướng sắp xếp từ thuộc tính `page`.
                null // Không có bộ lọc.
            );
        }

        $this->page->BindUsers($userList->Results()); // Gắn kết danh sách người dùng vào trang.
        $this->page->BindPageInfo($userList->PageInfo()); // Gắn kết thông tin trang vào trang.

        $groups = $this->groupViewRepository->GetDepartmentList(); // Lấy danh sách nhóm/phòng ban.
        $this->page->BindGroups($groups->Results()); // Gắn kết danh sách nhóm/phòng ban vào trang.

        $user = $this->userRepository->StudentLoadById(ServiceLocator::GetServer()->GetUserSession()->UserId); // Lấy thông tin sinh viên theo UserId từ phiên người dùng hiện tại.

        $resources = $this->GetResourcesThatCurrentUserCanAdminister($user); // Lấy danh sách tài nguyên mà người dùng hiện tại có thể quản lý.
        $this->page->BindResources($resources); // Gắn kết danh sách tài nguyên vào trang.

        $attributeList = $this->attributeService->GetByCategory(CustomAttributeCategory::USER); // Lấy danh sách thuộc tính tùy chỉnh theo danh mục người dùng.
        $this->page->BindAttributeList($attributeList); // Gắn kết danh sách thuộc tính tùy chỉnh vào trang.

        $this->page->BindStatusDescriptions(); // Gắn kết mô tả trạng thái vào trang.
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

    public function AddStudent()
    {
        // Gọi phương thức AddStudent của đối tượng manageVluersService
        // Truyền vào các thông tin chi tiết của sinh viên từ đối tượng page
        $this->manageVluersService->AddStudent(
            $this->page->GetMSSV(),             // Lấy mã số sinh viên từ đối tượng page
            $this->page->GetFullName(),         // Lấy họ tên đầy đủ của sinh viên từ đối tượng page
            $this->page->GetEmail(),            // Lấy email của sinh viên từ đối tượng page
            $this->page->GetMajorName(),        // Lấy ngành học của sinh viên từ đối tượng page
            $this->page->GetStudentClass(),     // Lấy lớp của sinh viên từ đối tượng page
            $this->page->GetStudentType(),      // Lấy loại sinh viên từ đối tượng page
            $this->page->GetStudentStatus(),    // Lấy trạng thái của sinh viên từ đối tượng page
            $this->page->GetEnrollmentDate(),   // Lấy ngày nhập học của sinh viên từ đối tượng page
            $this->page->GetTrainingProgram(),  // Lấy chương trình đào tạo của sinh viên từ đối tượng page
            $this->page->GetDepartmentId()      // Lấy mã phòng ban của sinh viên từ đối tượng page
        );
    }


    public function UpdateStudent()
    {
        Log::Debug('Updating user %s', $this->page->GetUserId());


        $this->manageVluersService->UpdateStudent(
            $this->page->GetUserId(),
            $this->page->GetMSSV(),
            $this->page->GetFullName(),
            $this->page->GetEmail(),
            $this->page->GetMajorName(),
            $this->page->GetStudentClass(),
            $this->page->GetStudentType(),
            $this->page->GetStudentStatus(),
            $this->page->GetEnrollmentDate(),
            $this->page->GetTrainingProgram(),
            $this->page->GetDepartmentId()
        );
    }

    public function DeleteStudent()
    {
        $userId = $this->page->GetUserId();
        Log::Debug('Deleting user %s', $userId);

        $this->manageVluersService->DeleteStudent($userId);
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

        if ($action == ManageVluersActions::UpdateStudent) {
            $this->page->RegisterValidator('emailformat', new EmailValidator($this->page->GetEmail()));
            $this->page->RegisterValidator(
                'uniqueemail',
                new UniqueEmailValidator($this->userRepository, $this->page->GetEmail(), $this->page->GetUserId())
            );
            $this->page->RegisterValidator(
                'uniqueusername',
                new UniqueUserNameValidator($this->userRepository, $this->page->GetFullName(), $this->page->GetUserId())
            );
            
        }

        if ($action == ManageVluersActions::AddStudent) {
            $this->page->RegisterValidator('addUserEmailformat', new EmailValidator($this->page->GetEmail()));
            $this->page->RegisterValidator(
                'addUserUniqueemail',
                new UniqueEmailValidator($this->userRepository, $this->page->GetEmail())
            );
            $this->page->RegisterValidator(
                'addUserUsername',
                new UniqueUserNameValidator($this->userRepository, $this->page->GetFullName())
            );
            $this->page->RegisterValidator(
                'addAttributeValidator',
                new AttributeValidator(
                    $this->attributeService,
                    CustomAttributeCategory::USER,
                    $this->GetAttributeValues(),
                    null,
                    true,
                    true
                )
            );
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
        if ($action == ManageUsersActions::ImportUsers) {
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
            $csv = new VluerImportCsv($importFile, $attributesIndexed);
            $rows = $csv->GetRows();
        } else if (in_array(strtolower($fileExtension), ['xls', 'xlsx'])) {
            $csv = new VluerImportExcel($importFile, $attributesIndexed);
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
    
        // Second pass: Process rows and insert students
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
    
        $emailValidator = new EmailValidator($row->email);
        $uniqueEmailValidator = new UniqueEmailValidator($this->userRepository, $row->email);
        $uniqueUsernameValidator = new UniqueUserNameValidator($this->userRepository, $row->fullname);
    
        $emailValidator->Validate();
        if (!$emailValidator->IsValid()) {
            $evMsgs = $emailValidator->Messages();
            $messages[] = $evMsgs[0] . " ({$row->email})";
            return;
        }
    
        if (!$shouldUpdate) {
            $uniqueEmailValidator->Validate();
            $uniqueUsernameValidator->Validate();
    
            if (!$uniqueEmailValidator->IsValid()) {
                $uevMsgs = $uniqueEmailValidator->Messages();
                $messages[] = $uevMsgs[0] . " ({$row->email})";
                return;
            }
            if (!$uniqueUsernameValidator->IsValid()) {
                $uuvMsgs = $uniqueUsernameValidator->Messages();
                $messages[] = $uuvMsgs[0] . " ({$row->fullname})";
                return;
            }
        }
    
        if ($shouldUpdate) {
            $user = $this->manageVluersService->LoadStudent($row->email);
            if ($user->Id() == null) {
                $shouldUpdate = false;
            } else {
                $user->ChangeMSSV($row->studentid);
                $user->ChangeFullName($row->fullname);
                $user->ChangeEmailStudent($row->email);
                $user->ChangeStudentClass($row->studentclass);
                $user->ChangeStudentType($row->studenttype);
                $user->ChangeStudentStatus($row->studentstatus);
                $user->ChangeEnrollmentDate($row->enrollmentdate);
                $user->ChangeTrainingProgram($row->trainingprogram);
                $user->ChangeDepartmentId($row->departmentid);
            }
        }
        if (!$shouldUpdate) {
            $user = $this->manageVluersService->AddStudent(
                $row->studentid,
                $row->fullname,
                $row->email,
                $row->majorname,
                $row->studentclass,
                $row->studenttype,
                $row->studentstatus,
                $row->enrollmentdate,
                $row->trainingprogram,
                $row->departmentid
            );
        }
    
        if ($shouldUpdate) {
            $this->userRepository->StudentUpdate($user);
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

    public function DeleteMultipleStudents()
    {
        $ids = $this->page->GetDeletedStudentIds();
        Log::Debug('User multiple delete. Ids=%s', implode(',', $ids));
        foreach ($ids as $id) {
            $this->manageVluersService->DeleteStudent($id);
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
    //Phương thức show giao diện update
    public function ShowUpdate()
    {
        //Lấy Id của student
        $userId = $this->page->GetUserId();
        $user = $this->userRepository->StudentLoadById($userId);
        $attributes = $this->attributeService->GetAttributes(CustomAttributeCategory::USER, [$userId]);
        $groups = $this->groupViewRepository->GetDepartmentList();
        $this->page->BindGroups($groups->Results());
        $this->page->ShowUserUpdate($user, $attributes->GetDefinitions());
    }
}
