<?php

require_once 'DBinfoConfig.php';

class CategoryTour {
	public $CategoryTourID;
	public $CategoryTourName;
	public $Status;
	public $Description;
	public $Flag;

	public function addCategoryTour() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `categorytour` 
				(
					`CategoryTourName`, 
					`Status`,
					`Description`
				) 
				VALUES 
				(
					:CategoryTourName, 
					:Status, 
					:Description
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":CategoryTourName" => $this->CategoryTourName,
			":Status" => $this->Status,
			":Description" => $this->Description));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->serviceID = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function getListCategoryTour() {
        // chuỗi kết nối đến DB
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);
        
        // câu lệnh sql
        $sql = "SELECT CategoryTourID, CategoryTourName, Description, Flag,
				CASE
					WHEN Status = 1 THEN 'Active'
					WHEN Status = 2 THEN 'Stop working'
					WHEN Status = 3 THEN 'Not activated'
					ELSE 'Error'
				END
				AS `Status`
				FROM `categorytour`
				WHERE Flag IS NULL;";
        
        // chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);
        
        // thực hiện
        $stmt->execute();
        
        $list = Array();
        while($row = $stmt ->fetch(PDO::FETCH_ASSOC)) {
            $s = new CategoryTour();
            $s->CategoryTourID = $row["CategoryTourID"];
            $s->CategoryTourName = $row["CategoryTourName"];
			$s->Status = $row["Status"];
			$s->Description = $row["Description"];
			$s->Flag = $row["Flag"];
            
            array_push($list, $s);
        }
        
        // đóng kết nối
        $conn = NULL;
        
        return $list;
    }
	
	public function getCategoryTourName() {
        // chuỗi kết nối đến DB
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);
        
        // câu lệnh sql
        $sql = "SELECT
				* FROM `categorytour`
	   			WHERE CategoryTourID = :CategoryTourID AND Flag IS NULL;";
        
        // chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);
        
        // thực hiện
        $stmt->execute(array(":CategoryTourID" => $this->CategoryTourID));
        
        $list = Array();
        while($row = $stmt ->fetch(PDO::FETCH_ASSOC)) {
            $s = new CategoryTour();
            $s->CategoryTourID = $row["CategoryTourID"];
            $s->CategoryTourName = $row["CategoryTourName"];
            
            array_push($list, $s);
        }
        
        // đóng kết nối
        $conn = NULL;
        
        return $list;
    }

	// function delete
	public function updateListCategoryTour() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Update query.
		$sql = "UPDATE `categorytour` SET `Flag` = :Flag WHERE `CategoryTourID` = :CategoryTourID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":CategoryTourID" => $this->CategoryTourID,
			":Flag" => $this->Flag
		));

		// Close the database connection.
		$conn = NULL;
	}

	// function edit
	public function updateCategorytour() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`categorytour`
				SET		`CategoryTourName` = :CategoryTourName,
						`Description` = :Description
				WHERE	`CategoryTourID` = :CategoryTourID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":CategoryTourID" => $this->CategoryTourID,
			":CategoryTourName" => $this->CategoryTourName,
			":Description" => $this->Description
		));

		// Close the database connection.
		$conn = NULL;
	}
}
?>