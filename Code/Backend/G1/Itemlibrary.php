<?php
require_once("dbInfo.php");

class Itemlibrary {
	public $description;
	public $file;
	public $flag;
	public $itemID; // db => type
	public $itemLibraryID;
	public $libraryID;
	public $title;

	public function addItemlibrary() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `itemlibrary`
				(
					`Description`,
					`File`,
					`Flag`,
					`ItemID`,
					`LibraryID`,
					`Title`
				)
				VALUES
				(
					:description,
					:file,
					:flag,
					:itemID,
					:libraryID,
					:title
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":description" => $this->description,
			":file" => $this->file,
			":flag" => $this->flag,
			":itemID" => $this->itemID,
			":libraryID" => $this->libraryID,
			":title" => $this->title));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->itemLibraryID = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function updateItemlibrary() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`itemlibrary`
				SET		`Description` = :description,
						`File` = :file,
						`Flag` = :flag,
						`ItemID` = :itemID,
						`LibraryID` = :libraryID,
						`Title` = :title
				WHERE	`ItemLibraryID` = :itemLibraryID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":description" => $this->description,
			":file" => $this->file,
			":flag" => $this->flag,
			":itemID" => $this->itemID,
			":itemLibraryID" => $this->itemLibraryID,
			":libraryID" => $this->libraryID,
			":title" => $this->title));

		// Close the database connection.
		$conn = NULL;
	}

	public static function deleteItemlibrary($itemLibraryID) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `itemlibrary`
				WHERE	`ItemLibraryID` = :itemLibraryID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":itemLibraryID" => $itemLibraryID));

		// Close the database connection.
		$conn = NULL;
	}

	public static function getItemlibrary($itemLibraryID) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`Description`,
						`File`,
						`Flag`,
						`ItemID`,
						`ItemLibraryID`,
						`LibraryID`,
						`Title`
				FROM	`itemlibrary`
				WHERE	`ItemLibraryID` = :itemLibraryID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":itemLibraryID" => $itemLibraryID));

		// Fetch record.
		$itemlibrary = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$itemlibrary = new Itemlibrary();
			$itemlibrary->description = $row["Description"];
			$itemlibrary->file = $row["File"];
			$itemlibrary->flag = $row["Flag"];
			$itemlibrary->itemID = $row["ItemID"];
			$itemlibrary->itemLibraryID = $row["ItemLibraryID"];
			$itemlibrary->libraryID = $row["LibraryID"];
			$itemlibrary->title = $row["Title"];
		}

		// Close the database connection.
		$conn = NULL;

		return $itemlibrary;
	}

	public static function getAllRecords($pageNo, $pageSize, &$totalRecords, $sortColumn, $sortOrder) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Validate sort column and order.
		$defaultSortColumn = "`ItemLibraryID`";
		$sortColumns = Array("DESCRIPTION", "FILE", "FLAG", "ITEMID", "ITEMLIBRARYID", "LIBRARYID", "TITLE");
		$sortColumn = in_array(strtoupper($sortColumn), $sortColumns) ? "`$sortColumn`" : $defaultSortColumn;
		$sortOrder = strcasecmp($sortOrder, "DESC") == 0 ? "DESC" : "ASC";

		$pageNo = (int)$pageNo;
		$pageSize = (int)$pageSize;

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`itemlibrary`;";

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
						`File`,
						`Flag`,
						`ItemID`,
						`ItemLibraryID`,
						`LibraryID`,
						`Title`
				FROM	`itemlibrary`
				ORDER BY $sortColumn $sortOrder
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$itemlibrary = new Itemlibrary();
			$itemlibrary->description = $row["Description"];
			$itemlibrary->file = $row["File"];
			$itemlibrary->flag = $row["Flag"];
			$itemlibrary->itemID = $row["ItemID"];
			$itemlibrary->itemLibraryID = $row["ItemLibraryID"];
			$itemlibrary->libraryID = $row["LibraryID"];
			$itemlibrary->title = $row["Title"];

			array_push($list, $itemlibrary);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}
}
?>