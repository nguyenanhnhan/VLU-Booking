<?php

class UniqueEmailStudentValidator extends ValidatorBase implements IValidator
{
    private $_email;
    private $_studentid;
    private $userRepository;

    public function __construct(IUserViewRepository $userRepository, $email, $studentid = null)
    {
        $this->_email = $email;
        $this->_studentid = $studentid;
        $this->userRepository = $userRepository;
    }

    public function Validate()
    {
        $this->isValid = true;

        $studentId = $this->userRepository->StudentInfoExists($this->_email, null);

        if (!empty($studentId)) {
            $this->isValid = $studentId == $this->_studentid;
        }

        if (!$this->isValid) {
            $this->AddMessageKey('UniqueEmailStudentRequired');
        }
    }
}
