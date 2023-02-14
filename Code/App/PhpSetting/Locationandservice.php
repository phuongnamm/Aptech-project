<?php

require_once 'DBinfoConfig.php';

class Locationandservice {
	public $description;
	public $flag;
	public $locationAndServiceID;
	public $mountaineeringID;
	public $serviceID;

	public function addLocationandservice() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `locationandservice`
				(
					`Description`,
					`MountaineeringID`,
					`ServiceID`
				)
				VALUES
				(
					:description,
					:mountaineeringID,
					:serviceID
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":description" => $this->description,
			":mountaineeringID" => $this->mountaineeringID,
			":serviceID" => $this->serviceID));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->locationAndServiceID = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function getListLocationandservice() {
        // chuỗi kết nối đến DB
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);
        
        // câu lệnh sql
        $sql = "SELECT `M`.MountainName, `L`.Description, `L`.MountaineeringID, `L`.ServiceID, `L`.LocationAndServiceID, `S`.ServiceName FROM `locationandservice` `L`
				INNER JOIN `mountaineering` `M` 
					ON `L`.MountaineeringID = `M`.MountaineeringID
				INNER JOIN `service` `S` 
					ON `S`.ServiceID = `L`.ServiceID
				WHERE `L`.Flag IS NULL;";
        
        // chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);
        
        // thực hiện
        $stmt->execute();
        
        $list = Array();
        while($row = $stmt ->fetch(PDO::FETCH_ASSOC)) {
            $s = new Locationandservice();
			$s->description = $row["Description"];
			$s->locationAndServiceID = $row["LocationAndServiceID"];
			$s->mountaineeringID = $row["MountaineeringID"];
			$s->MountainName = $row["MountainName"];
			$s->ServiceName = $row["ServiceName"];
			$s->serviceID = $row["ServiceID"];
            
            array_push($list, $s);
        }
        
        // đóng kết nối
        $conn = NULL;
        
        return $list;
    }

	public function updateLocationandservice() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`locationandservice`
				SET		`Description` = :description
				WHERE	`LocationAndServiceID` = :locationAndServiceID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":description" => $this->description,
			":locationAndServiceID" => $this->locationAndServiceID
		));

		// Close the database connection.
		$conn = NULL;
	}

	public static function deleteLocationandservice($locationAndServiceID) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `locationandservice`
				WHERE	`LocationAndServiceID` = :locationAndServiceID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":locationAndServiceID" => $locationAndServiceID));

		// Close the database connection.
		$conn = NULL;
	}

	public static function getLocationandservice($locationAndServiceID) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`Description`,
						`Flag`,
						`LocationAndServiceID`,
						`MountaineeringID`,
						`ServiceID`
				FROM	`locationandservice`
				WHERE	`LocationAndServiceID` = :locationAndServiceID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":locationAndServiceID" => $locationAndServiceID));

		// Fetch record.
		$locationandservice = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$locationandservice = new Locationandservice();
			$locationandservice->description = $row["Description"];
			$locationandservice->flag = $row["Flag"];
			$locationandservice->locationAndServiceID = $row["LocationAndServiceID"];
			$locationandservice->mountaineeringID = $row["MountaineeringID"];
			$locationandservice->serviceID = $row["ServiceID"];
		}

		// Close the database connection.
		$conn = NULL;

		return $locationandservice;
	}

	public static function getAllRecords($pageNo, $pageSize, &$totalRecords, $sortColumn, $sortOrder) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Validate sort column and order.
		$defaultSortColumn = "`LocationAndServiceID`";
		$sortColumns = Array("DESCRIPTION", "FLAG", "LOCATIONANDSERVICEID", "MOUNTAINEERINGID", "SERVICEID");
		$sortColumn = in_array(strtoupper($sortColumn), $sortColumns) ? "`$sortColumn`" : $defaultSortColumn;
		$sortOrder = strcasecmp($sortOrder, "DESC") == 0 ? "DESC" : "ASC";

		$pageNo = (int)$pageNo;
		$pageSize = (int)$pageSize;

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`locationandservice`;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Get total records count.
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$totalRecords = $row['Count'];
		$stmt = NULL;

		$totalPages = ceil($totalRecords / $pageSize);
		if ($pageNo > $totalPages) {
			$pageNo = $totalPages;
		}

		$start = $pageSize * $pageNo - $pageSize;
		if($start < 0) {
			$start = 0;
		}

		$sql = "SELECT	`Description`,
						`Flag`,
						`LocationAndServiceID`,
						`MountaineeringID`,
						`ServiceID`
				FROM	`locationandservice`
				ORDER BY $sortColumn $sortOrder
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$locationandservice = new Locationandservice();
			$locationandservice->description = $row["Description"];
			$locationandservice->flag = $row["Flag"];
			$locationandservice->locationAndServiceID = $row["LocationAndServiceID"];
			$locationandservice->mountaineeringID = $row["MountaineeringID"];
			$locationandservice->serviceID = $row["ServiceID"];

			array_push($list, $locationandservice);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}

	// function delete
	public function updateListLocationandservice() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Update query.
		$sql = "UPDATE `locationandservice` SET `flag` = :flag WHERE `locationAndServiceID` = :locationAndServiceID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":locationAndServiceID" => $this->locationAndServiceID,
			":flag" => $this->flag
		));

		// Close the database connection.
		$conn = NULL;
	}
}
?>