<?php

class UniqueLecturerIdValidator extends ValidatorBase implements IValidator
{
    private $_lecturerid;
    private $_userid;
    private $userRepository;

    public function __construct(IUserViewRepository $userRepository, $lecturerid, $userid = null)
    {
        $this->_lecturerid = $lecturerid;
        $this->_userid = $userid;
        $this->userRepository = $userRepository;
    }

    public function Validate()
    {
        $this->isValid = true;
        $userId = $this->userRepository->LecturerInfoExists(null, $this->_lecturerid);

        if (!empty($userId)) {
            $this->isValid = $userId == $this->_userid;
        }

        if (!$this->isValid) {
            $this->AddMessageKey('UniqueLecturerIdRequired');
        }
    }
}
