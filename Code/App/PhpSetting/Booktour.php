<?php

require_once 'DBinfoConfig.php';

class Booktour {
	public $BookTourID;
	public $TourID;
	public $AnonymousBookTour;
	public $AnonymousEmail;
	public $AnonymousAddress;
	public $AnonymousPhone;
	public $Status;
	public $Description;
	public $Flag;

	// Booktour
	public function addBooktour() {
		// chuỗi kết nối đến DB
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `booktour`
				(
					`AnonymousAddress`,
					`AnonymousBookTour`,
					`AnonymousEmail`,
					`AnonymousPhone`,
					`TourID`
				)
				VALUES
				(
					:AnonymousAddress,
					:AnonymousBookTour,
					:AnonymousEmail,
					:AnonymousPhone,
					:TourID
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":AnonymousAddress" => $this->AnonymousAddress,
			":AnonymousBookTour" => $this->AnonymousBookTour,
			":AnonymousEmail" => $this->AnonymousEmail,
			":AnonymousPhone" => $this->AnonymousPhone,
			":TourID" => $this->TourID));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->bookTourID = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function getListBooktour() {
        // chuỗi kết nối đến DB
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);
        
        // câu lệnh sql
        $sql = "SELECT * FROM `booktour` WHERE Flag IS NULL;";
        
        // chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);
        
        // thực hiện
        $stmt->execute();
        
        $list = Array();
        while($row = $stmt ->fetch(PDO::FETCH_ASSOC)) {
            $s = new Booktour();
            $s->BookTourID = $row["BookTourID"];
            $s->TourID = $row["TourID"];
			$s->AnonymousBookTour = $row["AnonymousBookTour"];
			$s->AnonymousEmail = $row["AnonymousEmail"];
			$s->AnonymousAddress = $row["AnonymousAddress"];
			$s->AnonymousPhone = $row["AnonymousPhone"];
			$s->Status = $row["Status"];
			$s->Description = $row["Description"];
			$s->Flag = $row["Flag"];
            
            array_push($list, $s);
        }
        
        // đóng kết nối
        $conn = NULL;
        
        return $list;
    }

	public function getUserBooktour() {
        // chuỗi kết nối đến DB
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);
        
        // câu lệnh sql
        $sql = "SELECT COUNT(BookTourID) AS totaluserbooktour FROM `booktour` WHERE Flag IS NULL;";
        
        // chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);
        
        // thực hiện
        $stmt->execute();
        
        $list = Array();
        while($row = $stmt ->fetch(PDO::FETCH_ASSOC)) {
            $s = new Booktour();
            $s->totaluserbooktour = $row["totaluserbooktour"];
            
            array_push($list, $s);
        }
        
        // đóng kết nối
        $conn = NULL;
        
        return $list;
    }

	// function delete
    public function updateListBooktour() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`booktour` SET `Flag` = :Flag WHERE `BookTourID` = :BookTourID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":BookTourID" => $this->BookTourID,
			":Flag" => $this->Flag));

		// Close the database connection.
		$conn = NULL;
	}

    public function editListBootour() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`booktour`
				SET		`TourID` = :TourID,
						`AnonymousBookTour` = :AnonymousBookTour,
						`AnonymousEmail` = :AnonymousEmail,
						`AnonymousAddress` = :AnonymousAddress,
						`AnonymousPhone` = :AnonymousPhone,
						`Status` = :Status,
						`Description` = :Description
				WHERE	`BookTourID` = :BookTourID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":BookTourID" => $this->BookTourID,
			":TourID" => $this->TourID,
			":AnonymousBookTour" => $this->AnonymousBookTour,
			":AnonymousEmail" => $this->AnonymousEmail,
			":AnonymousAddress" => $this->AnonymousAddress,
			":AnonymousPhone" => $this->AnonymousPhone,
			":Status" => $this->Status,
			":Description" => $this->Description));

		// Close the database connection.
		$conn = NULL;
	}

}
?>