<?php
require_once("dbInfo.php");

class Tour {
	public $avatarTour;
	public $categoryTourID;
	public $description;
	public $flag;
	public $location;
	public $status;
	public $timeLimit;
	public $timeStart;
	public $tourID;
	public $tourName;
	public $tourPrice;
	public $tourSale;

	public function addTour() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `tour`
				(
					`AvatarTour`,
					`CategoryTourID`,
					`Description`,
					`Flag`,
					`Location`,
					`Status`,
					`TimeLimit`,
					`TimeStart`,
					`TourName`,
					`TourPrice`,
					`TourSale`
				)
				VALUES
				(
					:avatarTour,
					:categoryTourID,
					:description,
					:flag,
					:location,
					:status,
					:timeLimit,
					STR_TO_DATE(:timeStart, '%m/%d/%Y %h:%i %p'),
					:tourName,
					:tourPrice,
					:tourSale
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":avatarTour" => $this->avatarTour,
			":categoryTourID" => $this->categoryTourID,
			":description" => $this->description,
			":flag" => $this->flag,
			":location" => $this->location,
			":status" => $this->status,
			":timeLimit" => $this->timeLimit,
			":timeStart" => $this->timeStart,
			":tourName" => $this->tourName,
			":tourPrice" => $this->tourPrice,
			":tourSale" => $this->tourSale));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->tourID = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function updateTour() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`tour`
				SET		`AvatarTour` = :avatarTour,
						`CategoryTourID` = :categoryTourID,
						`Description` = :description,
						`Flag` = :flag,
						`Location` = :location,
						`Status` = :status,
						`TimeLimit` = :timeLimit,
						`TimeStart` = STR_TO_DATE(:timeStart, '%m/%d/%Y %h:%i %p'),
						`TourName` = :tourName,
						`TourPrice` = :tourPrice,
						`TourSale` = :tourSale
				WHERE	`TourID` = :tourID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":avatarTour" => $this->avatarTour,
			":categoryTourID" => $this->categoryTourID,
			":description" => $this->description,
			":flag" => $this->flag,
			":location" => $this->location,
			":status" => $this->status,
			":timeLimit" => $this->timeLimit,
			":timeStart" => $this->timeStart,
			":tourID" => $this->tourID,
			":tourName" => $this->tourName,
			":tourPrice" => $this->tourPrice,
			":tourSale" => $this->tourSale));

		// Close the database connection.
		$conn = NULL;
	}

	public static function deleteTour($tourID) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `tour`
				WHERE	`TourID` = :tourID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":tourID" => $tourID));

		// Close the database connection.
		$conn = NULL;
	}

	public static function getTour($tourID) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`AvatarTour`,
						`CategoryTourID`,
						`Description`,
						`Flag`,
						`Location`,
						`Status`,
						`TimeLimit`,
						DATE_FORMAT(`TimeStart`, '%m/%d/%Y %h:%i %p') AS TimeStart,
						`TourID`,
						`TourName`,
						`TourPrice`,
						`TourSale`
				FROM	`tour`
				WHERE	`TourID` = :tourID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":tourID" => $tourID));

		// Fetch record.
		$tour = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$tour = new Tour();
			$tour->avatarTour = $row["AvatarTour"];
			$tour->categoryTourID = $row["CategoryTourID"];
			$tour->description = $row["Description"];
			$tour->flag = $row["Flag"];
			$tour->location = $row["Location"];
			$tour->status = $row["Status"];
			$tour->timeLimit = $row["TimeLimit"];
			$tour->timeStart = $row["TimeStart"];
			$tour->tourID = $row["TourID"];
			$tour->tourName = $row["TourName"];
			$tour->tourPrice = $row["TourPrice"];
			$tour->tourSale = $row["TourSale"];
		}

		// Close the database connection.
		$conn = NULL;

		return $tour;
	}

	public static function getAllRecords($pageNo, $pageSize, &$totalRecords, $sortColumn, $sortOrder) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Validate sort column and order.
		$defaultSortColumn = "`TourID`";
		$sortColumns = Array("AVATARTOUR", "CATEGORYTOURID", "DESCRIPTION", "FLAG", "LOCATION", "STATUS", "TIMELIMIT", "TIMESTART", "TOURID", "TOURNAME", "TOURPRICE", "TOURSALE");
		$sortColumn = in_array(strtoupper($sortColumn), $sortColumns) ? "`$sortColumn`" : $defaultSortColumn;
		$sortOrder = strcasecmp($sortOrder, "DESC") == 0 ? "DESC" : "ASC";

		$pageNo = (int)$pageNo;
		$pageSize = (int)$pageSize;

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`tour`;";

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

		$sql = "SELECT	`AvatarTour`,
						`CategoryTourID`,
						`Description`,
						`Flag`,
						`Location`,
						`Status`,
						`TimeLimit`,
						DATE_FORMAT(`TimeStart`, '%m/%d/%Y %h:%i %p') AS TimeStart,
						`TourID`,
						`TourName`,
						`TourPrice`,
						`TourSale`
				FROM	`tour`
				ORDER BY $sortColumn $sortOrder
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$tour = new Tour();
			$tour->avatarTour = $row["AvatarTour"];
			$tour->categoryTourID = $row["CategoryTourID"];
			$tour->description = $row["Description"];
			$tour->flag = $row["Flag"];
			$tour->location = $row["Location"];
			$tour->status = $row["Status"];
			$tour->timeLimit = $row["TimeLimit"];
			$tour->timeStart = $row["TimeStart"];
			$tour->tourID = $row["TourID"];
			$tour->tourName = $row["TourName"];
			$tour->tourPrice = $row["TourPrice"];
			$tour->tourSale = $row["TourSale"];

			array_push($list, $tour);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}
}
?>