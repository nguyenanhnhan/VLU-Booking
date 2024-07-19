<?php

require_once(ROOT_DIR . 'lib/Application/Authentication/namespace.php');
require_once(ROOT_DIR . 'Domain/Access/namespace.php');

interface IManageLecturersServiceFactory
{
    /**
     * @return IManageLecturersService
     */
    public function CreateAdmin();
}

class ManageLecturersServiceFactory implements IManageLecturersServiceFactory
{
    public function CreateAdmin()
    {
        $userRepository = new UserRepository();
        return new ManageLecturersService(new LecturerAdminRegistration(), $userRepository, new GroupRepository(), $userRepository, new PasswordEncryption());
    }
}
