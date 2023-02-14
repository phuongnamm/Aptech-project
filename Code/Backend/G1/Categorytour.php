<?php
require_once("dbInfo.php");

class Categorytour {
	public $categoryTourID;
	public $categoryTourName;
	public $description;
	public $flag;
	public $status;

	public function addCategorytour() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `categorytour`
				(
					`CategoryTourName`,
					`Description`,
					`Flag`,
					`Status`
				)
				VALUES
				(
					:categoryTourName,
					:description,
					:flag,
					:status
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":categoryTourName" => $this->categoryTourName,
			":description" => $this->description,
			":flag" => $this->flag,
			":status" => $this->status));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->categoryTourID = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function updateCategorytour() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`categorytour`
				SET		`CategoryTourName` = :categoryTourName,
						`Description` = :description,
						`Flag` = :flag,
						`Status` = :status
				WHERE	`CategoryTourID` = :categoryTourID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":categoryTourID" => $this->categoryTourID,
			":categoryTourName" => $this->categoryTourName,
			":description" => $this->description,
			":flag" => $this->flag,
			":status" => $this->status));

		// Close the database connection.
		$conn = NULL;
	}

	public static function deleteCategorytour($categoryTourID) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `categorytour`
				WHERE	`CategoryTourID` = :categoryTourID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":categoryTourID" => $categoryTourID));

		// Close the database connection.
		$conn = NULL;
	}

	public static function getCategorytour($categoryTourID) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`CategoryTourID`,
						`CategoryTourName`,
						`Description`,
						`Flag`,
						`Status`
				FROM	`categorytour`
				WHERE	`CategoryTourID` = :categoryTourID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":categoryTourID" => $categoryTourID));

		// Fetch record.
		$categorytour = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$categorytour = new Categorytour();
			$categorytour->categoryTourID = $row["CategoryTourID"];
			$categorytour->categoryTourName = $row["CategoryTourName"];
			$categorytour->description = $row["Description"];
			$categorytour->flag = $row["Flag"];
			$categorytour->status = $row["Status"];
		}

		// Close the database connection.
		$conn = NULL;

		return $categorytour;
	}

	public static function getAllRecords($pageNo, $pageSize, &$totalRecords, $sortColumn, $sortOrder) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Validate sort column and order.
		$defaultSortColumn = "`CategoryTourID`";
		$sortColumns = Array("CATEGORYTOURID", "CATEGORYTOURNAME", "DESCRIPTION", "FLAG", "STATUS");
		$sortColumn = in_array(strtoupper($sortColumn), $sortColumns) ? "`$sortColumn`" : $defaultSortColumn;
		$sortOrder = strcasecmp($sortOrder, "DESC") == 0 ? "DESC" : "ASC";

		$pageNo = (int)$pageNo;
		$pageSize = (int)$pageSize;

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`categorytour`;";

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

		$sql = "SELECT	`CategoryTourID`,
						`CategoryTourName`,
						`Description`,
						`Flag`,
						`Status`
				FROM	`categorytour`
				ORDER BY $sortColumn $sortOrder
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$categorytour = new Categorytour();
			$categorytour->categoryTourID = $row["CategoryTourID"];
			$categorytour->categoryTourName = $row["CategoryTourName"];
			$categorytour->description = $row["Description"];
			$categorytour->flag = $row["Flag"];
			$categorytour->status = $row["Status"];

			array_push($list, $categorytour);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}
}
?>