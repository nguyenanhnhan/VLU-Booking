<?php

interface IDepartmentRegistration
{
    /**
     * @param string $departmentid
     * @param string $departmentcode
     * @param string $departmentname
     * @param string $groupid
     * @return User
     */
    public function DepartmentRegister($departmentid,$departmentcode,$departmentname,$groupid);

    /**
     * @param string $loginName
     * @param string $emailAddress
     * @return bool if the user exists or not
     */
    public function UserExists($loginName, $emailAddress);

    /**
     * Add or update a user who has already been authenticated
     * @param AuthenticatedUser $user
     * @param bool $insertOnly
     * @param bool $overwritePassword
     * @return void
     */
    public function Synchronize(AuthenticatedUser $user, $insertOnly = false, $overwritePassword = true);
}
