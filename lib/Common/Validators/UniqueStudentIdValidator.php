<?php

class UniqueStudentIdValidator extends ValidatorBase implements IValidator
{
    private $_studentid;
    private $_userid;
    private $userRepository;

    public function __construct(IUserViewRepository $userRepository, $studentid, $userid = null)
    {
        $this->_studentid = $studentid;
        $this->_userid = $userid;
        $this->userRepository = $userRepository;
    }

    public function Validate()
    {
        $this->isValid = true;
        $userId = $this->userRepository->StudentExists(null, $this->_studentid);

        if (!empty($userId)) {
            $this->isValid = $userId == $this->_userid;
        }

        if (!$this->isValid) {
            $this->AddMessageKey('UniqueStudentIdRequired');
        }
    }
}
