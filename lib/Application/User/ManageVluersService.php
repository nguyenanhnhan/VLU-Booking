<?php

require_once(ROOT_DIR . 'Domain/Access/namespace.php');
require_once(ROOT_DIR . 'lib/Application/Authentication/namespace.php');
require_once(ROOT_DIR . 'lib/Email/Messages/AccountDeletedEmail.php');

interface IManageVluersService
{
    /**
     * @param $studentid string
     * @param $fullname string
     * @param $email string
     * @param $majorname string
     * @param $studentclass string
     * @param $studenttype string
     * @param $studentstatus string
     * @param $enrollmentdate string
     * @param $trainingprogram string
     * @param $departmentid string
     * @return User
     */
    public function AddStudent(
        $studentid,
        $fullname,
        $email,
        $majorname,
        $studentclass,
        $studenttype,
        $studentstatus,
        $enrollmentdate,
        $trainingprogram,
        $departmentid
    );

    /**
     * @param $userId int
     * @param $studentid string
     * @param $fullname string
     * @param $email string
     * @param $majorname string
     * @param $studentclass string
     * @param $studenttype string
     * @param $studentstatus string
     * @param $enrollmentdate string
     * @param $trainingprogram string
     * @param $departmentid string
     * @return User
     */
    public function UpdateStudent($userId, $studentid, $fullname, $email, $majorname, $studentclass, $studenttype, $studentstatus, $enrollmentdate, $trainingprogram, $departmentid);

    /**
     * @param $userId int
     * @param $attribute AttributeValue
     */
    public function ChangeAttribute($userId, $attribute);

    /**
     * @param $userId int
     * @param $attributes AttributeValue[]
     */
    public function ChangeAttributes($userId, $attributes);

    /**
     * @param $userId int
     */
    public function DeleteStudent($userId);

    /**
     * @param User $user
     * @param int[] $groupIds
     */
    public function ChangeGroups($user, $groupIds);

    /**
     * @param int $userId
     * @param string $password
     */
    public function UpdatePassword($userId, $password);

    /**
     * @param string $email
     * @return User
     */
    public function LoadStudent($email);
}

class ManageVluersService implements IManageVluersService
{
    /**
     * @var IStudentRegistration
     */
    private $registration;

    /**
     * @var IUserRepository
     */
    private $userRepository;

    /**
     * @var IGroupRepository
     */
    private $groupRepository;

    /**
     * @var IUserViewRepository
     */
    private $userViewRepository;

    /**
     * @var PasswordEncryption
     */
    private $passwordEncryption;

    public function __construct(
        IStudentRegistration $registration,
        IUserRepository $userRepository,
        IGroupRepository $groupRepository,
        IUserViewRepository $userViewRepository,
        PasswordEncryption $passwordEncryption
    ) {
        $this->registration = $registration;
        $this->userRepository = $userRepository;
        $this->groupRepository = $groupRepository;
        $this->userViewRepository = $userViewRepository;
        $this->passwordEncryption = $passwordEncryption;
    }

    public function AddStudent(
        $studentid,
        $fullname,
        $email,
        $majorname,
        $studentclass,
        $studenttype,
        $studentstatus,
        $enrollmentdate,
        $trainingprogram,
        $departmentid
    ) {
        $user = $this->registration->StudentRegister(
            $studentid,
            $fullname,
            $email,
            $majorname,
            $studentclass,
            $studenttype,
            $studentstatus,
            $enrollmentdate,
            $trainingprogram,
            $departmentid
        );

        return $user;
    }

    public function ChangeAttribute($userId, $attributeValue)
    {
        $user = $this->userRepository->LoadById($userId);
        $user->ChangeCustomAttribute($attributeValue);
        $this->userRepository->Update($user);
    }

    public function ChangeAttributes($userId, $attributes)
    {
        $user = $this->userRepository->LoadById($userId);
        foreach ($attributes as $attribute) {
            $user->ChangeCustomAttribute($attribute);
        }
        $this->userRepository->Update($user);
    }

    public function DeleteStudent($userId, $notify = true)
    {
        $currentUser = ServiceLocator::GetServer()->GetUserSession();
        if ($currentUser->UserId == $userId) {
            // don't delete own account
            return;
        }

        $user = $this->userRepository->StudentLoadById($userId);
        $this->userRepository->DeleteByStudent($userId);

        if ($notify && Configuration::Instance()->GetKey(ConfigKeys::REGISTRATION_NOTIFY, new BooleanConverter())) {
            $applicationAdmins = $this->userViewRepository->GetApplicationAdmins();
            $groupAdmins = $this->userViewRepository->GetGroupAdmins($userId);

            foreach ($applicationAdmins as $applicationAdmin) {
                ServiceLocator::GetEmailService()->Send(new AccountDeletedEmail($user, $applicationAdmin, $currentUser));
            }

            foreach ($groupAdmins as $groupAdmin) {
                ServiceLocator::GetEmailService()->Send(new AccountDeletedEmail($user, $groupAdmin, $currentUser));
            }
        }
    }

    public function UpdateStudent($userId, $studentid, $fullname, $email, $majorname, $studentclass, $studenttype, $studentstatus, $enrollmentdate, $trainingprogram, $departmentid)
    {
        $user = $this->userRepository->StudentLoadById($userId);
    
        $user->ChangeFullName($fullname);
        $user->ChangeEmailStudent($email);
        $user->ChangeMajorName($majorname);
        $user->ChangeStudentClass($studentclass);
        $user->ChangeStudentType($studenttype);
        $user->ChangeStudentStatus($studentstatus);
        $user->ChangeEnrollmentDate($enrollmentdate);
        $user->ChangeTrainingProgram($trainingprogram);
        $user->ChangeDepartmentId($departmentid);

        $this->userRepository->StudentUpdate($user);

        return $user;
    }

    public function ChangeGroups($user, $groupIds)
    {
        if (is_null($groupIds)) {
            return;
        }

        $existingGroupIds = [];
        foreach ($user->Groups() as $group) {
            $existingGroupIds[] = $group->GroupId;
        }

        foreach ($groupIds as $targetGroupId) {
            if (!in_array($targetGroupId, $existingGroupIds)) {
                // add group
                $group = $this->groupRepository->LoadById($targetGroupId);
                $group->AddUser($user->Id());
                $this->groupRepository->Update($group);
            }
        }

        foreach ($existingGroupIds as $existingId) {
            if (!in_array($existingId, $groupIds)) {
                // remove user
                $group = $this->groupRepository->LoadById($existingId);
                $group->RemoveUser($user->Id());
                $this->groupRepository->Update($group);
            }
        }
    }

    public function UpdatePassword($userId, $password)
    {
        $user = $this->userRepository->LoadById($userId);

        $encrypted = $this->passwordEncryption->EncryptPassword($password);

        $user->ChangePassword($encrypted->EncryptedPassword(), $encrypted->Salt());

        $this->userRepository->Update($user);
    }

    public function LoadStudent($email)
    {
        return $this->userRepository->StudentLoadByUsername($email);
    }
}
