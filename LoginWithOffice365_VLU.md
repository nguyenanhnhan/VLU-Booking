- [1. Tài liệu mô tả bổ sung mã nguồn](#1-tài-liệu-mô-tả-bổ-sung-mã-nguồn)
  - [1.1. Quy trình đăng nhập Office 365 và phân quyền vào nhóm](#11-quy-trình-đăng-nhập-office-365-và-phân-quyền-vào-nhóm)
    - [1.1.1. Mã nguồn](#111-mã-nguồn)
      - [1.1.1.1. Database](#1111-database)
      - [1.1.1.2. ColumnNames.php](#1112-columnnamesphp)
      - [1.1.1.3. ParameterNames.php](#1113-parameternamesphp)
      - [1.1.1.4. Queries.php](#1114-queriesphp)
      - [1.1.1.5. Commands.php](#1115-commandsphp)
      - [1.1.1.6. UserRepository.php](#1116-userrepositoryphp)
      - [1.1.1.7. ExternalAuthLoginPresenter.php](#1117-externalauthloginpresenterphp)


# 1. Tài liệu mô tả bổ sung mã nguồn

## 1.1. Quy trình đăng nhập Office 365 và phân quyền vào nhóm

![alt text](https://github.com/nguyenanhnhan/VLU-Booking/blob/develop/LoginWithOffice365_ver2.jpg?raw=true)

### 1.1.1. Mã nguồn
#### 1.1.1.1. Database

- Script_Tables.sql
  - Mô tả: Chứa các lệnh tạo bảng students, lecturers, departments
    <details>
    <summary>Nhấn vào đây để xem mã nguồn</summary>

    ```sql
        -- Tạo bảng vlu_departments trước vì các bảng khác sẽ tham chiếu đến nó
    CREATE TABLE vlu_departments (
        department_id INT PRIMARY KEY NOT NULL COMMENT 'Mã khoa',
        department_code VARCHAR(20) NOT NULL COMMENT 'Tên viết tắt của khoa',
        department_name VARCHAR(100) NOT NULL COMMENT 'Tên khoa'
    );

    -- Tạo bảng vlu_students
    CREATE TABLE vlu_students (
        student_id VARCHAR(20) PRIMARY KEY NOT NULL COMMENT 'MSSV',
        full_name VARCHAR(100) NOT NULL COMMENT 'Họ và tên',
        enrollment_date DATE COMMENT 'Ngày nhập học',
        student_type VARCHAR(50) NOT NULL COMMENT 'Loại sinh viên',
        status VARCHAR(50) NOT NULL COMMENT 'Tình trạng sinh viên',
        department_id INT NOT NULL COMMENT 'Mã khoa',
        major_name VARCHAR(100) COMMENT 'Tên chuyên ngành',
        training_program VARCHAR(100) COMMENT 'Chương trình đào tạo',
        student_class VARCHAR(255) COMMENT 'Lớp sinh viên',
        email VARCHAR(100) NOT NULL COMMENT 'Email'
    );

    -- Tạo bảng vlu_lecturers
    CREATE TABLE vlu_lecturers (
        lecturer_id VARCHAR(20) PRIMARY KEY NOT NULL COMMENT 'Mã giảng viên',
        full_name VARCHAR(100) NOT NULL COMMENT 'Họ và tên',
        department_id INT NOT NULL COMMENT 'Mã khoa',
        email VARCHAR(100) NOT NULL COMMENT 'Email',
        phone_number VARCHAR(15) COMMENT 'Số điện thoại',
        hire_date DATE COMMENT 'Ngày tuyển dụng'
    );

    -- Thêm ràng buộc khóa ngoại cho bảng vlu_students
    ALTER TABLE vlu_students
    ADD CONSTRAINT students_ibfk_1 FOREIGN KEY (department_id) REFERENCES vlu_departments(department_id);

    -- Thêm ràng buộc khóa ngoại cho bảng vlu_lecturers
    ALTER TABLE vlu_lecturers
    ADD CONSTRAINT lecturers_ibfk_1 FOREIGN KEY (department_id) REFERENCES vlu_departments(department_id);

    ```
  
- VLU_booking.sql
  - Mô tả: Chứa các lệnh import dữ liệu của bảng students, lecturers, departments
  [Link data]()

#### 1.1.1.2. ColumnNames.php
*/lib/Database/Commands/ColumnNames.php*

- **Mô tả**
Tệp này chứa các **hằng số** được khai báo được đại diện cho các tên cột của sinh viên, giảng viên và khoa

- **Các thay đổi**
  - Thêm các hằng số đại diện cho các cột trong bảng dữ liệu students, lecturers, departments
    <details>
    <summary>Nhấn vào đây để xem mã nguồn</summary>

    ```php
    //-------------------------------------------Source VLU--------------------------------
    public const DEPARTMENT_ID = 'department_id';
    public const FULL_NAME = 'full_name';
    // Students
    public const STUDENT_ID = 'student_id';
    public const STUDENT_ENROLLMENT_DATE = 'enrollment_date';
    public const STUDENT_TYPE = 'student_type';
    public const STUDENT_STATUS = 'status';
    public const STUDENT_MAJOR_NAME = 'major_name';
    public const STUDENT_TRAINING_PROGRAM = 'training_program';
    public const STUDENT_CLASS = 'student_class';
    // Lecturers
    public const LECTURER_ID = 'lecturer_id';
    public const LECTURER_PHONE_NUMBER = 'phone_number';
    public const LECTURER_HIRE_DATE = 'hire_date';
    // Departments
    public const DEPARTMENT_CODE = 'department_code';
    public const DEPARTMENT_NAME = 'department_name';
    //-------------------------------------------END Source VLU--------------------------------
    ```

#### 1.1.1.3. ParameterNames.php
*/lib/Database/Commands/ParameterNames.php*

- **Mô tả**
Tệp này chứa các **hằng số** để định nghĩa tên tham số trong các lệnh SQL

- **Các thay đổi**
  - Thêm các hằng số định nghĩa placeholder trong câu lệnh SQL. Một phương pháp thông thường để tránh các vấn đề về bảo mật như SQL Injection

    <details>
    <summary>Nhấn vào đây để xem mã nguồn</summary>

    ```php
    //-------------------------------------------Source VLU--------------------------------
    public const EMAIL = ':email';
    public const DEPARTMENT_ID = ':department_id';
    //-------------------------------------------END Source VLU--------------------------------
    ```

#### 1.1.1.4. Queries.php
*/lib/Database/Commands/Queries.php*

- **Mô tả**
Tệp này chứa các **hằng số** được khai báo liên quan đến câu lệnh SQL dùng để truy vấn cơ sở dữ liệu của sinh viên, giảng viên và khoa

- **Các thay đổi**
  - Thêm các hằng số dùng truy vấn trong bảng dữ liệu students, lecturers, departments
    <details>
    <summary>Nhấn vào đây để xem mã nguồn</summary>

    ```php
    	//-------------------------------------------Source VLU--------------------------------
	const GET_STUDENT_DEPARTMENT = 
    "SELECT department_id FROM students WHERE email = :email";
    const GET_LECTURER_DEPARTMENT = 
    "SELECT department_id FROM lecturers WHERE email = :email";
    const GET_DEPARTMENT_INFO = 
    "SELECT department_code, department_name FROM departments WHERE department_id = :department_id";
	//-------------------------------------------END Source VLU--------------------------------
    ```

#### 1.1.1.5. Commands.php
*/lib/Database/Commands/Commands.php*

- **Mô tả**
Tệp này chứa các lớp con của **SqlCommand** được sử dụng tạo các đối tượng lệnh SQL cho việc truy vấn thông tin sinh viên, giảng viên, khoa từ cơ sở dữ liệu

- **Các thay đổi**
  - Thêm các lớp **GetStudentCommand**, **GetLecturerCommand**, và **GetDepartmentCommand** để truy vấn cơ sở dữ liệu lấy thông tin từ hằng số *Queries* và *ParameterNames*
    <details>
    <summary>Nhấn vào đây để xem mã nguồn</summary>

    ```php
    class GetStudentCommand extends SqlCommand
    {
        public function __construct($email)
        {
            parent::__construct(Queries::GET_STUDENT_DEPARTMENT);

            $this->AddParameter(new Parameter(ParameterNames::EMAIL, $email));
        }
    }
    class GetLecturerCommand extends SqlCommand
    {
        public function __construct($email)
        {
            parent::__construct(Queries::GET_LECTURER_DEPARTMENT);

            $this->AddParameter(new Parameter(ParameterNames::EMAIL, $email));
        }   
    }
    class GetDepartmentCommand extends SqlCommand
    {
        public function __construct($departmentId)
        {
            parent::__construct(Queries::GET_DEPARTMENT_INFO);

            $this->AddParameter(new Parameter(ParameterNames::DEPARTMENT_ID, $departmentId));
        }
    }
    ```

#### 1.1.1.6. UserRepository.php
*/Domain/Access/UserRepository.php*
- **Mô tả**

Tệp này chứa lớp **UserRepository**, cung cấp các phương thức để truy vấn thông tin sinh viên, giảng viên, và khoa từ cơ sở dữ liệu.

- **Các thay đổi**

  - Thêm các phương thức **GetStudent**, **GetLecturer**, và **GetDepartment** để lấy thông tin từ cơ sở dữ liệu dựa trên *email* và *department_id*.
    <details>
    <summary>Nhấn vào đây để xem mã nguồn</summary>

    ```php
    //-------------------------------------------Source VLU--------------------------------
    public function GetStudent($email)
    {
        // Tạo đối tượng GetStudentCommand với email
        $command = new GetStudentCommand($email);

        // Thực thi lệnh truy vấn và lấy kết quả
        $studentResult = ServiceLocator::GetDatabase()->Query($command);

        // Lấy hàng kết quả đầu tiên
        $studentData = $studentResult->GetRow();
        $studentResult->Free();
        // Trả về dữ liệu sinh viên 
        return $studentData;
    }
    public function GetLecturer($email)
    {
        // Tạo đối tượng GetLecturerCommand với email
        $command = new GetLecturerCommand($email);

        // Thực thi lệnh truy vấn và lấy kết quả
        $lecturerResult = ServiceLocator::GetDatabase()->Query($command);

        // Lấy hàng kết quả đầu tiên
        $lecturerData = $lecturerResult->GetRow();

        $lecturerResult->Free();
        // Trả về dữ liệu giảng viên 
        return $lecturerData;
    }

    public function GetDepartment($departmentId)
    {
        // Tạo đối tượng GetDepartment với departmentId
        $command = new GetDepartmentCommand($departmentId);

        // Thực thi lệnh truy vấn và lấy kết quả
        $departmentResult = ServiceLocator::GetDatabase()->Query($command);

        // Lấy hàng kết quả đầu tiên
        $departmentData = $departmentResult->GetRow();

        $departmentResult->Free();
        // Trả về dữ liệu department 
        return $departmentData;
    }
    ```

  - Thêm phương thức **determineUserGroups** xác định nhóm người dùng dựa trên *email*
    <details>
    <summary>Nhấn vào đây để xem mã nguồn</summary>

    ```php
    public function determineUserGroups($email) {
        $groups = [];
        
        // Kiểm tra xem người dùng là sinh viên hay giảng viên và lấy department_id
        $departmentId = $this->getUserDepartmentId($email);
        
        if ($departmentId !== null) {
            // Thêm các nhóm dựa trên thông tin khoa
            $this->addDepartmentGroups($departmentId, $groups);
        }
        
        return $groups;
    }
    ```

  - Thêm phương thức **getUserDepartmentId** dùng để lấy *departmentId* của người dùng
    <details>
    <summary>Nhấn vào đây để xem mã nguồn</summary>

    ```php
    private function getUserDepartmentId($email) {
        // Kiểm tra sinh viên
        $studentResult = $this->GetStudent($email);
        if ($studentResult) {
            return $studentResult[ColumnNames::DEPARTMENT_ID];
        }
        
        // Kiểm tra giảng viên
        $lecturerResult = $this->GetLecturer($email);
        if ($lecturerResult) {
            return $lecturerResult[ColumnNames::DEPARTMENT_ID];
        }
        
        // Không tìm thấy sinh viên hoặc giảng viên
        return null;
    }
    ```

  - Thêm phương thức **addDepartmentGroups** thêm người dùng vào các nhóm dựa trên *departmentId*
      <details>
      <summary>Nhấn vào đây để xem mã nguồn</summary>

      ```php
      private function addDepartmentGroups($departmentId, &$groups) {
          $departmentResult = $this->GetDepartment($departmentId);
          if ($departmentResult) {
              $groups[] = $departmentResult[ColumnNames::DEPARTMENT_CODE];
              $groups[] = $departmentResult[ColumnNames::DEPARTMENT_NAME];
          } else {
              echo "No department found for department ID: $departmentId"; 
          }
      }
      ```

#### 1.1.1.7. ExternalAuthLoginPresenter.php
*/Presenters/Authentication/ExternalAuthLoginPresenter.php*
- **Mô tả**
Tệp này chứa lớp **ExternalAuthLoginPresenter**, xử lý đăng nhập xác thực bên ngoài (**Microsoft**).

- **Các thay đổi**
  - Tạo 1 đối tượng mới từ class **UserRepository**
    <details>
    <summary>Nhấn vào đây để xem mã nguồn</summary>

    ```php
    $userRepository = new UserRepository();
    ```

  - Gọi phương thức **determineUserGroups** từ đối tượng **UserRepository** vừa tạo có chứa tham số email.
    <details>
    <summary>Nhấn vào đây để xem mã nguồn</summary>

    ```php
    $groups = $userRepository->determineUserGroups($email);
    ```

  - Sửa phương thức **processUserData** ở lớp **AuthenticatedUser** có thêm nhóm người dùng khi sau đăng nhập.
    <details>
    <summary>Nhấn vào đây để xem mã nguồn</summary>

    ```php
    private function processUserData($username,$email,$firstName,$lastName){
        $requiredDomainValidator = new RequiredEmailDomainValidator($email);
        $requiredDomainValidator->Validate();
        if (!$requiredDomainValidator->IsValid()) {
            $this->page->ShowError(array(Resources::GetInstance()->GetString('InvalidEmailDomain')));
            return;
        }
        if($this->registration->UserExists($username,$email)){
            $this->authentication->Login($email, new WebLoginContext(new LoginData()));
            LoginRedirector::Redirect($this->page);
        }
        else{
            // Xác định nhóm của người dùng dựa trên dữ liệu đầu vào
            //-------------------------------------------Source VLU--------------------------------
            $userRepository = new UserRepository();
            $groups = $userRepository->determineUserGroups($email);
            $this->registration->Synchronize(new AuthenticatedUser(
                $username,
                $email,
                $firstName, 
                $lastName,
                Password::GenerateRandom(),
                Resources::GetInstance()->CurrentLanguage,
                Configuration::Instance()->GetDefaultTimezone(),
                null,
                null,
                null,
            $groups),
                false,
                false);
            $this->authentication->Login($email, new WebLoginContext(new LoginData()));
            LoginRedirector::Redirect($this->page);
            //-------------------------------------------END Source VLU--------------------------------
        }
    }
    ```

