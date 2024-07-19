<?php

require_once(ROOT_DIR . 'lib/Application/Authentication/namespace.php');
require_once(ROOT_DIR . 'Domain/Access/namespace.php');

interface IManageDepartmentsServiceFactory
{
    /**
     * @return IManageDepartmentsService
     */
    public function CreateAdmin();
}

class ManageDepartmentsServiceFactory implements IManageDepartmentsServiceFactory
{
    public function CreateAdmin()
    {
        $userRepository = new UserRepository();
        return new ManageDepartmentsService(new DepartmentAdminRegistration(), $userRepository, new GroupRepository(), $userRepository, new PasswordEncryption());
    }
}
