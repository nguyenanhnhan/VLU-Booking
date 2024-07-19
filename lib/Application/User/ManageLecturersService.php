<?php

require_once(ROOT_DIR . 'Domain/Access/namespace.php');
require_once(ROOT_DIR . 'lib/Application/Authentication/namespace.php');
require_once(ROOT_DIR . 'lib/Email/Messages/AccountDeletedEmail.php');

interface IManageLecturersService
{
    /**
     * @param $lecturerid string
     * @param $fullname string
     * @param $hiredate string
     * @param $phonenumber string
     * @param $departmentid string
     * @param $emaillecturer string
     * @return User
     */
    public function AddLecturer(
        $lecturerid,
        $fullname,
        $hiredate,
        $phonenumber,
        $departmentid,
        $emaillecturer
    );

    /**
     * @param $userId int
     * @param $lecturerid string
     * @param $fullname string
     * @param $hiredate string
     * @param $phonenumber string
     * @param $departmentid string
     * @param $emaillecturer string
     * @return User
     */
    public function UpdateLecturer($userId, $lecturerid, $fullname, $hiredate, $phonenumber, $departmentid, $emaillecturer);

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
    public function DeleteLecturer($userId);

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
    public function LoadLecturer($email);
}

class ManageLecturersService implements IManageLecturersService
{
    /**
     * @var ILecturerRegistration
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
        ILecturerRegistration $registration,
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

    public function AddLecturer(
        $lecturerid,
        $fullname,
        $hiredate,
        $phonenumber,
        $departmentid,
        $emaillecturer
    ) {
        $user = $this->registration->LecturerRegister(
            $lecturerid,
            $fullname,
            $hiredate,
            $phonenumber,
            $departmentid,
            $emaillecturer
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

    public function DeleteLecturer($userId, $notify = true)
    {
        $currentUser = ServiceLocator::GetServer()->GetUserSession();
        if ($currentUser->UserId == $userId) {
            // don't delete own account
            return;
        }

        $user = $this->userRepository->LecturerLoadById($userId);
        $this->userRepository->DeleteByLecturer($userId);

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

    public function UpdateLecturer($userId, $lecturerid, $fullname, $hiredate, $phonenumber, $departmentid, $emaillecturer)
    {
        $user = $this->userRepository->LecturerLoadById($userId);
        $user->ChangeLecturerId($lecturerid);
        $user->ChangeFullName($fullname);
        $user->ChangeHireDate($hiredate);
        $user->ChangePhoneNumber($phonenumber);
        $user->ChangeDepartmentId($departmentid);
        $user->ChangeEmailLecturer($emaillecturer);
        
        $this->userRepository->LecturerUpdate($user);

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

    public function LoadLecturer($email)
    {
        return $this->userRepository->LecturerLoadByUsername($email);
    }
}
