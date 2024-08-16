<?php

class ExistStudentIdValidator extends ValidatorBase implements IValidator
{
    private $_studentid;
    private $existingStudentInfo;

    public function __construct($existingStudentInfo, $studentid)
    {
        $this->_studentid = $studentid;
        $this->existingStudentInfo = $existingStudentInfo;
    }

    public function Validate()
    {
        $this->isValid = true;

        if (isset($this->existingStudentInfo['student_id'][$this->_studentid])) {
            $this->isValid = false;
        }

        if (!$this->isValid) {
            $this->AddMessageKey('UniqueStudentIdRequired');
        }
    }
}
