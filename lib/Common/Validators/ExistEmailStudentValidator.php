<?php
//Kiểm tra xem email của sinh viên đã tồn tại trong hệ thống chưa, và đảm bảo rằng email là duy nhất trừ khi thuộc về sinh viên hiện tại.
class ExistEmailStudentValidator extends ValidatorBase implements IValidator
{
    private $_email;
    private $existingStudentInfo;

    public function __construct($existingStudentInfo, $email)
    {
        $this->_email = $email;
        $this->existingStudentInfo= $existingStudentInfo;
    }

    public function Validate()
    {
        $this->isValid = true;
        
        if (isset($this->existingStudentInfo['email'][$this->_email])){
            $this->isValid = false;
        }

        if (!$this->isValid) {
            $this->AddMessageKey('UniqueEmailStudentRequired');
        }
    }
}
