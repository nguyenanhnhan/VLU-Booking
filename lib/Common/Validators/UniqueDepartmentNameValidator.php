<?php

class UniqueDepartmentNameValidator extends ValidatorBase implements IValidator
{
    private $_departmentname;
    private $_departmentid;
    private $userRepository;

    public function __construct(IUserViewRepository $userRepository, $departmentname, $departmentid = null)
    {
        $this->_departmentname = $departmentname;
        $this->_departmentid = $departmentid;
        $this->userRepository = $userRepository;
    }

    public function Validate()
    {
        $this->isValid = true;

        $departmentId = $this->userRepository->DepartmentInfoExists($this->_departmentname, null);

        if (!empty($departmentId)) {
            $this->isValid = $departmentId == $this->_departmentid;
        }

        if (!$this->isValid) {
            $this->AddMessageKey('UniqueDepartmentNameRequired');
        }
    }
}
