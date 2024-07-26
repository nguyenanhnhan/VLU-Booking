<?php

class UniqueDepartmentIdValidator extends ValidatorBase implements IValidator
{
    private $_departmentid;
    private $_userid;
    private $userRepository;

    public function __construct(IUserViewRepository $userRepository, $departmentid, $userid = null)
    {
        $this->_departmentid = $departmentid;
        $this->_userid = $userid;
        $this->userRepository = $userRepository;
    }

    public function Validate()
    {
        $this->isValid = true;
        $userId = $this->userRepository->DepartmentInfoExists(null, $this->_departmentid);

        if (!empty($userId)) {
            $this->isValid = $userId == $this->_userid;
        }

        if (!$this->isValid) {
            $this->AddMessageKey('UniqueDepartmentIdRequired');
        }
    }
}
