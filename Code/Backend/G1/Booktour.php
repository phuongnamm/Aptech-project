<?php
require_once("dbInfo.php");

class Booktour {
	public $anonymousAddress;
	public $anonymousBookTour;
	public $anonymousEmail;
	public $anonymousPhone;
	public $bookTourID;
	public $description;
	public $flag;
	public $memberID;
	public $status;
	public $tourID;

	public function addBooktour() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `booktour`
				(
					`AnonymousAddress`,
					`AnonymousBookTour`,
					`AnonymousEmail`,
					`AnonymousPhone`,
					`Description`,
					`Flag`,
					`MemberID`,
					`Status`,
					`TourID`
				)
				VALUES
				(
					:anonymousAddress,
					:anonymousBookTour,
					:anonymousEmail,
					:anonymousPhone,
					:description,
					:flag,
					:memberID,
					:status,
					:tourID
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":anonymousAddress" => $this->anonymousAddress,
			":anonymousBookTour" => $this->anonymousBookTour,
			":anonymousEmail" => $this->anonymousEmail,
			":anonymousPhone" => $this->anonymousPhone,
			":description" => $this->description,
			":flag" => $this->flag,
			":memberID" => $this->memberID,
			":status" => $this->status,
			":tourID" => $this->tourID));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->bookTourID = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function updateBooktour() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`booktour`
				SET		`AnonymousAddress` = :anonymousAddress,
						`AnonymousBookTour` = :anonymousBookTour,
						`AnonymousEmail` = :anonymousEmail,
						`AnonymousPhone` = :anonymousPhone,
						`Description` = :description,
						`Flag` = :flag,
						`MemberID` = :memberID,
						`Status` = :status,
						`TourID` = :tourID
				WHERE	`BookTourID` = :bookTourID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":anonymousAddress" => $this->anonymousAddress,
			":anonymousBookTour" => $this->anonymousBookTour,
			":anonymousEmail" => $this->anonymousEmail,
			":anonymousPhone" => $this->anonymousPhone,
			":bookTourID" => $this->bookTourID,
			":description" => $this->description,
			":flag" => $this->flag,
			":memberID" => $this->memberID,
			":status" => $this->status,
			":tourID" => $this->tourID));

		// Close the database connection.
		$conn = NULL;
	}

	public static function deleteBooktour($bookTourID) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `booktour`
				WHERE	`BookTourID` = :bookTourID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":bookTourID" => $bookTourID));

		// Close the database connection.
		$conn = NULL;
	}

	public static function getBooktour($bookTourID) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`AnonymousAddress`,
						`AnonymousBookTour`,
						`AnonymousEmail`,
						`AnonymousPhone`,
						`BookTourID`,
						`Description`,
						`Flag`,
						`MemberID`,
						`Status`,
						`TourID`
				FROM	`booktour`
				WHERE	`BookTourID` = :bookTourID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":bookTourID" => $bookTourID));

		// Fetch record.
		$booktour = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$booktour = new Booktour();
			$booktour->anonymousAddress = $row["AnonymousAddress"];
			$booktour->anonymousBookTour = $row["AnonymousBookTour"];
			$booktour->anonymousEmail = $row["AnonymousEmail"];
			$booktour->anonymousPhone = $row["AnonymousPhone"];
			$booktour->bookTourID = $row["BookTourID"];
			$booktour->description = $row["Description"];
			$booktour->flag = $row["Flag"];
			$booktour->memberID = $row["MemberID"];
			$booktour->status = $row["Status"];
			$booktour->tourID = $row["TourID"];
		}

		// Close the database connection.
		$conn = NULL;

		return $booktour;
	}

	public static function getAllRecords($pageNo, $pageSize, &$totalRecords, $sortColumn, $sortOrder) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Validate sort column and order.
		$defaultSortColumn = "`BookTourID`";
		$sortColumns = Array("ANONYMOUSADDRESS", "ANONYMOUSBOOKTOUR", "ANONYMOUSEMAIL", "ANONYMOUSPHONE", "BOOKTOURID", "DESCRIPTION", "FLAG", "MEMBERID", "STATUS", "TOURID");
		$sortColumn = in_array(strtoupper($sortColumn), $sortColumns) ? "`$sortColumn`" : $defaultSortColumn;
		$sortOrder = strcasecmp($sortOrder, "DESC") == 0 ? "DESC" : "ASC";

		$pageNo = (int)$pageNo;
		$pageSize = (int)$pageSize;

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`booktour`;";

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

		$sql = "SELECT	`AnonymousAddress`,
						`AnonymousBookTour`,
						`AnonymousEmail`,
						`AnonymousPhone`,
						`BookTourID`,
						`Description`,
						`Flag`,
						`MemberID`,
						`Status`,
						`TourID`
				FROM	`booktour`
				ORDER BY $sortColumn $sortOrder
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$booktour = new Booktour();
			$booktour->anonymousAddress = $row["AnonymousAddress"];
			$booktour->anonymousBookTour = $row["AnonymousBookTour"];
			$booktour->anonymousEmail = $row["AnonymousEmail"];
			$booktour->anonymousPhone = $row["AnonymousPhone"];
			$booktour->bookTourID = $row["BookTourID"];
			$booktour->description = $row["Description"];
			$booktour->flag = $row["Flag"];
			$booktour->memberID = $row["MemberID"];
			$booktour->status = $row["Status"];
			$booktour->tourID = $row["TourID"];

			array_push($list, $booktour);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}
}
?>