<?php

require_once(ROOT_DIR . 'Domain/Access/namespace.php');
require_once(ROOT_DIR . 'lib/Application/Authentication/namespace.php');
require_once(ROOT_DIR . 'lib/Email/Messages/AccountDeletedEmail.php');

interface IManageDepartmentsService
{
    /**
     * @param $departmentid string
     * @param $departmentcode string
     * @param $departmentname string
     * @param $groupid string
     * @return User
     */
    public function AddDepartment(
        $departmentid,
        $departmentcode,
        $departmentname,
        $groupid
    );

    /**
     * @param $userId int
     * @param $departmentid string
     * @param $departmentcode string
     * @param $departmentname string
     * @param $groupid string
     * @return User
     */
    public function UpdateDepartment($userId, $departmentid, $departmentcode, $departmentname, $groupid);

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
    public function DeleteDepartment($userId);

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
     * @param string $departmentname
     * @return User
     */
    public function LoadDepartment($departmentname);
}

class ManageDepartmentsService implements IManageDepartmentsService
{
    /**
     * @var IDepartmentRegistration
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
        IDepartmentRegistration $registration,
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

    public function AddDepartment(
        $departmentid,
        $departmentcode,
        $departmentname,
        $groupid
    ) {
        $user = $this->registration->DepartmentRegister(
            $departmentid,
            $departmentcode,
            $departmentname,
            $groupid
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

    public function DeleteDepartment($userId, $notify = true)
    {
        $currentUser = ServiceLocator::GetServer()->GetUserSession();
        if ($currentUser->UserId == $userId) {
            // don't delete own account
            return;
        }

        $user = $this->userRepository->DepartmentLoadById($userId);
        $this->userRepository->DeleteByDepartment($userId);

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

    public function UpdateDepartment($userId, $departmentid, $departmentcode, $departmentname, $groupid)
    {
        $user = $this->userRepository->DepartmentLoadById($userId);
        $user->ChangeDepartmentId($departmentid);
        $user->ChangeDepartmentCode($departmentcode);
        $user->ChangeDepartmentName($departmentname);
        $user->ChangeGroupId($groupid);
        // Cập nhật department
        $this->userRepository->DepartmentUpdate($user);
        // Cập nhật user_groups khi người dùng cập nhật groups cho khoa
        $this->userRepository->UpdateUserGroupsByDepartment($userId,$groupid);
        

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

    public function LoadDepartment($departmentname)
    {
        return $this->userRepository->DepartmentLoadByUsername($departmentname);
    }
}
