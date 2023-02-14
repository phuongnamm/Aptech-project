<?php

require_once '../PhpSetting/DBinfoConfig.php';

class Mountaineering {
	public $banner;
	public $description;
	public $flag;
	public $level;
	public $locationX;
	public $locationY;
	public $mountaineeringID;
	public $mountainName;
	public $sheltering;
	public $techniques;
	public $type;

	public function addMountaineering() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `mountaineering`
				(
					`Banner`,
					`Description`,
					`Level`,
					`LocationX`,
					`LocationY`,
					`MountainName`,
					`Sheltering`,
					`Techniques`,
					`Type`
				)
				VALUES
				(
					:banner,
					:description,
					:level,
					:locationX,
					:locationY,
					:mountainName,
					:sheltering,
					:techniques,
					:type
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":banner" => $this->banner,
			":description" => $this->description,
			":level" => $this->level,
			":locationX" => $this->locationX,
			":locationY" => $this->locationY,
			":mountainName" => $this->mountainName,
			":sheltering" => $this->sheltering,
			":techniques" => $this->techniques,
			":type" => $this->type));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->mountaineeringID = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function getListMountaineering() {
        // chuỗi kết nối đến DB
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);
        
        // câu lệnh sql
        $sql = "SELECT MountaineeringID, LocationX, LocationY, MountainName, Banner, Sheltering, Techniques, Description,
				CASE
					WHEN Type =	1 THEN '1 Chặng'
					WHEN Type =	2 THEN 'Nhiều chặng'
					ELSE 'Error'
				END
				AS `Type`,
				CASE 
					WHEN Level = 1 THEN 'Dễ'
					WHEN Level = 2 THEN 'Trung Bình'
					WHEN Level = 3 THEN 'Khó'
					ELSE 'Erorr'
				END
				AS `Level`
				FROM `mountaineering`
				WHERE Flag IS NULL;";
        
        // chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);
        
        // thực hiện
        $stmt->execute();
        
        $list = Array();
        while($row = $stmt ->fetch(PDO::FETCH_ASSOC)) {
            $s = new Mountaineering();
            $s->banner = $row["Banner"];
            $s->mountaineeringID = $row["MountaineeringID"];
			$s->description = $row["Description"];
			$s->level = $row["Level"];
			$s->locationX = $row["LocationX"];
			$s->locationY = $row["LocationY"];
			$s->mountainName = $row["MountainName"];
			$s->sheltering = $row["Sheltering"];
			$s->techniques = $row["Techniques"];
			$s->type = $row["Type"];
            
            array_push($list, $s);
        }
        
        // đóng kết nối
        $conn = NULL;
        
        return $list;
    }

	// chức năng edit
	public function updateMountaineering() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`mountaineering`
				SET	`Description` = :description,
					`LocationX` = :locationX,
					`LocationY` = :locationY,
					`MountainName` = :mountainName,
					`Sheltering` = :sheltering,
					`Techniques` = :techniques
				WHERE	`MountaineeringID` = :mountaineeringID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":description" => $this->description,
			":locationX" => $this->locationX,
			":locationY" => $this->locationY,
			":mountaineeringID" => $this->mountaineeringID,
			":mountainName" => $this->mountainName,
			":sheltering" => $this->sheltering,
			":techniques" => $this->techniques
		));

		// Close the database connection.
		$conn = NULL;
	}

	public static function deleteMountaineering($mountaineeringID) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `mountaineering`
				WHERE	`MountaineeringID` = :mountaineeringID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":mountaineeringID" => $mountaineeringID));

		// Close the database connection.
		$conn = NULL;
	}

	public static function getMountaineering($mountaineeringID) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`Banner`,
						`Description`,
						`Flag`,
						`Level`,
						`LocationX`,
						`LocationY`,
						`MountaineeringID`,
						`MountainName`,
						`Sheltering`,
						`Techniques`,
						`Type`
				FROM	`mountaineering`
				WHERE	`MountaineeringID` = :mountaineeringID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":mountaineeringID" => $mountaineeringID));

		// Fetch record.
		$mountaineering = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$mountaineering = new Mountaineering();
			$mountaineering->banner = $row["Banner"];
			$mountaineering->description = $row["Description"];
			$mountaineering->flag = $row["Flag"];
			$mountaineering->level = $row["Level"];
			$mountaineering->locationX = $row["LocationX"];
			$mountaineering->locationY = $row["LocationY"];
			$mountaineering->mountaineeringID = $row["MountaineeringID"];
			$mountaineering->mountainName = $row["MountainName"];
			$mountaineering->sheltering = $row["Sheltering"];
			$mountaineering->techniques = $row["Techniques"];
			$mountaineering->type = $row["Type"];
		}

		// Close the database connection.
		$conn = NULL;

		return $mountaineering;
	}

	public static function getAllRecords($pageNo, $pageSize, &$totalRecords, $sortColumn, $sortOrder) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Validate sort column and order.
		$defaultSortColumn = "`MountaineeringID`";
		$sortColumns = Array("BANNER", "DESCRIPTION", "FLAG", "LEVEL", "LOCATIONX", "LOCATIONY", "MOUNTAINEERINGID", "MOUNTAINNAME", "SHELTERING", "TECHNIQUES", "TYPE");
		$sortColumn = in_array(strtoupper($sortColumn), $sortColumns) ? "`$sortColumn`" : $defaultSortColumn;
		$sortOrder = strcasecmp($sortOrder, "DESC") == 0 ? "DESC" : "ASC";

		$pageNo = (int)$pageNo;
		$pageSize = (int)$pageSize;

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`mountaineering`;";

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

		$sql = "SELECT	`Banner`,
						`Description`,
						`Flag`,
						`Level`,
						`LocationX`,
						`LocationY`,
						`MountaineeringID`,
						`MountainName`,
						`Sheltering`,
						`Techniques`,
						`Type`
				FROM	`mountaineering`
				ORDER BY $sortColumn $sortOrder
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$mountaineering = new Mountaineering();
			$mountaineering->banner = $row["Banner"];
			$mountaineering->description = $row["Description"];
			$mountaineering->flag = $row["Flag"];
			$mountaineering->level = $row["Level"];
			$mountaineering->locationX = $row["LocationX"];
			$mountaineering->locationY = $row["LocationY"];
			$mountaineering->mountaineeringID = $row["MountaineeringID"];
			$mountaineering->mountainName = $row["MountainName"];
			$mountaineering->sheltering = $row["Sheltering"];
			$mountaineering->techniques = $row["Techniques"];
			$mountaineering->type = $row["Type"];

			array_push($list, $mountaineering);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}

	// function delete
	public function updateListMountaineering() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Update query.
		$sql = "UPDATE `mountaineering` SET `Flag` = :flag WHERE `MountaineeringID` = :mountaineeringID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":mountaineeringID" => $this->mountaineeringID,
			":flag" => $this->flag
		));

		// Close the database connection.
		$conn = NULL;
	}
}
?>