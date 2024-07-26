<?php

class UniqueEmailLecturerValidator extends ValidatorBase implements IValidator
{
    private $_email;
    private $_lecturerid;
    private $userRepository;

    public function __construct(IUserViewRepository $userRepository, $email, $lecturerid = null)
    {
        $this->_email = $email;
        $this->_lecturerid = $lecturerid;
        $this->userRepository = $userRepository;
    }

    public function Validate()
    {
        $this->isValid = true;

        $lecturerId = $this->userRepository->LecturerInfoExists($this->_email, null);

        if (!empty($lecturerId)) {
            $this->isValid = $lecturerId == $this->_lecturerid;
        }

        if (!$this->isValid) {
            $this->AddMessageKey('UniqueEmailLecturerRequired');
        }
    }
}
