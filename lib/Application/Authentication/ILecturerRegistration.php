<?php

interface ILecturerRegistration
{
    /**
     * @param string $lecturerid
     * @param string $fullname
     * @param string $hiredate
     * @param string $phonenumber
     * @param string $departmentid
     * @param string $emaillecturer
     * @return User
     */
    public function LecturerRegister($lecturerid,$fullname,$hiredate,$phonenumber,$departmentid,$emaillecturer);

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
