<?php
//Kiểm tra xem email của sinh viên đã tồn tại trong hệ thống chưa, và đảm bảo rằng email là duy nhất trừ khi thuộc về sinh viên hiện tại.
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
