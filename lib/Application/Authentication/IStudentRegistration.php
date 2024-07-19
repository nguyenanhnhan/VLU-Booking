<?php

interface IStudentRegistration
{
    /**
     * @param string $mssv
     * @param string $fullname
     * @param string $email
     * @param string $majorname
     * @param string $studentclass
     * @param string $studenttype
     * @param string $studentstatus
     * @param string $enrollmentdate
     * @param string $trainingprogram
     * @param string $departmentid
     * @return User
     */
    public function StudentRegister($mssv,$fullname, $email, $majorname, $studentclass, $studenttype, $studentstatus, $enrollmentdate, $trainingprogram, $departmentid);

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
