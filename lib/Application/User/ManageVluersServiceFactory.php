<?php

require_once(ROOT_DIR . 'lib/Application/Authentication/namespace.php');
require_once(ROOT_DIR . 'Domain/Access/namespace.php');
// định nghĩa một interface và một lớp factory để tạo đối tượng ManageVluersService
interface IManageVluersServiceFactory
{
    /**
     * @return IManageVluersService
     */
    public function CreateAdmin();
}

class ManageVluersServiceFactory implements IManageVluersServiceFactory
{
    public function CreateAdmin()
    {
        $userRepository = new UserRepository();
        return new ManageVluersService(new VluAdminRegistration(), $userRepository, new GroupRepository(), $userRepository, new PasswordEncryption());
    }
}
