<?php

require_once 'DBinfoConfig.php';
require_once 'Common.php';

class Member {

    // Khai báo các trường trong bảng
    public $MemberID;
    public $MemberName;
    public $Password;
    public $Role;
    public $Fisrtname;
    public $Middlename;
    public $Lastname;
    public $Birthday;
    public $Sex;
    public $Telephone;
    public $Email;
    public $Status;
    public $Description;
    public $Flag;

//    public function register() {
//        // chuỗi kết nối đến DB
//        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
//        $dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
//        $conn = new PDO($dsn, DBinfoConfig::getUsername(), DBinfoConfig::getPassword(), $options);
//
//        // Kiểm tra username hoặc email có bị trùng hay không
//        $sql = "SELECT * FROM Member WHERE MemberName = :MemberName OR Email = :Email";
//
//        // Thực thi câu truy vấn
//        $stmt = $conn->prepare($sql);
//        //Thực hiện câu lệnh
//        $stmt->execute(array(":MemberName" => $this->MemberName, ":Email" => $this->Email));
//        $list = Array();
//        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//            $s = new User();
//            $s->MemberName = $row["MemberName"];
//            $s->Email = $row["Email"];
//            array_push($list, $s);
//        }
//        // Nếu kết quả trả về lớn hơn 1 thì nghĩa là username hoặc email đã tồn tại trong CSDL
//        if (count($list) == 0) {
//            $sql = "INSERT INTO  `Member`(MemberName, Password, Fisrtname, Middlename, Lastname, Birthday, Sex, Telephone, Email) 
//                    VALUES ( :MemberName, :Password, :Fisrtname, :Middlename, :Lastname, :Birthday, :Sex, :Telephone, :Email);";
//            $stmt = $conn->prepare($sql);
////         thực hiện
//            $stmt->execute(array(":MemberName" => $this->MemberName, ":Password" => $this->Password,
//                ":Fisrtname" => $this->Fisrtname, ":Middlename" => $this->Middlename,
//                ":Lastname" => $this->Lastname, ":Birthday" => $this->Birthday,
//                ":Sex" => $this->Sex, ":Telephone" => $this->Telephone,
//                ":Email" => $this->Email
//            ));
//            echo '<script language="javascript">alert("Đăng ký thành công!"); window.location="login.php";</script>';
//        } else {
//            echo '<script language="javascript">alert("Email hoặc Username này đã tồn tại!"); window.location="register.php";</script>';
//            exit();
//        }
//
//        // đóng kết nối
//        $conn = NULL;
//    }
    public function register() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUsername(), DBinfoConfig::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO  `member`(
                        MemberName,
                        Password,
                        Firstname,
                        Middlename,
                        Lastname,
                        Birthday,
                        Sex,
                        Telephone,
                        Email
                    ) 
                    VALUES (
                        :MemberName, 
                        :Password,
                        :Firstname,
                        :Middlename,
                        :Lastname,
                        :Birthday,
                        :Sex,
                        :Telephone,
                        :Email);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
                    ":MemberName" => $this->MemberName, 
                    ":Password" => $this->Password,
                    ":Firstname" => $this->Firstname,
                    ":Middlename" => $this->Middlename,
                    ":Lastname" => $this->Lastname, 
                    ":Birthday" => $this->Birthday,
                    ":Sex" => $this->Sex,
                    ":Telephone" => $this->Telephone,
                    ":Email" => $this->Email,
                ));

//		// Get value of the auto increment column.
//		$newId = $conn->lastInsertId();
//		$this->memberID = $newId;
                echo '<script language="javascript">alert("Đăng ký thành công!"); window.location="login.php";</script>';
                // đóng kết nối
                $conn = NULL;
	}

    public function login() {
        // chuỗi kết nối đến DB
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
        $conn = new PDO($dsn, DBinfoConfig::getUsername(), DBinfoConfig::getPassword(), $options);

        // câu lệnh sql
        $sql = "SELECT * FROM `member` WHERE MemberName = :MemberName AND Password = :Password;";

        // chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);

        // thực hiện
        $stmt->execute(array(":MemberName" => $this->MemberName, ":Password" => $this->Password));

        $list = Array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $s = new Member();
            $s->MemberName = $row["MemberName"];
            $s->Password = $row["Password"];

            array_push($list, $s);
        }

        // đóng kết nối
        $conn = NULL;

        return $list;
    }

    // logout
    public function Logout() {
        // xóa ss khi tạo ở login
        session_destroy();
//        unset($_SESSION["Username"]);
    }

    public function GetUserByUsername() {
        // chuỗi kết nối đến DB
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
        $conn = new PDO($dsn, DBinfoConfig::getUsername(), DBinfoConfig::getPassword(), $options);

        // câu lệnh sql
        $sql = "SELECT * FROM `member` WHERE Username = :Username;";

        // chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);

        // thực hiện
        $stmt->execute(array(":Username" => $this->Username));

        $list = Array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $s = new Member();
            $s->MemberID = $row["MemberID"];
            $s->Username = $row["Username"];
            $s->Lastname = $row["Lastname"];
            $s->Middlename = $row["Middlename"];
            $s->Fisrtname = $row["Fisrtname"];

            array_push($list, $s);
        }

        // đóng kết nối
        $conn = NULL;

        return $list;
    }

}
?>

