<?php
require_once("dbInfo.php");

class Category {
	public $categoryID;
	public $categoryName;
	public $description;
	public $flag;
	public $parentID;

	public function addCategory() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `category`
				(
					`CategoryName`,
					`Description`,
					`Flag`,
					`ParentID`
				)
				VALUES
				(
					:categoryName,
					:description,
					:flag,
					:parentID
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":categoryName" => $this->categoryName,
			":description" => $this->description,
			":flag" => $this->flag,
			":parentID" => $this->parentID));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->categoryID = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function updateCategory() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`category`
				SET		`CategoryName` = :categoryName,
						`Description` = :description,
						`Flag` = :flag,
						`ParentID` = :parentID
				WHERE	`CategoryID` = :categoryID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":categoryID" => $this->categoryID,
			":categoryName" => $this->categoryName,
			":description" => $this->description,
			":flag" => $this->flag,
			":parentID" => $this->parentID));

		// Close the database connection.
		$conn = NULL;
	}

	public static function deleteCategory($categoryID) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `category`
				WHERE	`CategoryID` = :categoryID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":categoryID" => $categoryID));

		// Close the database connection.
		$conn = NULL;
	}

	public static function getCategory($categoryID) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`CategoryID`,
						`CategoryName`,
						`Description`,
						`Flag`,
						`ParentID`
				FROM	`category`
				WHERE	`CategoryID` = :categoryID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":categoryID" => $categoryID));

		// Fetch record.
		$category = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$category = new Category();
			$category->categoryID = $row["CategoryID"];
			$category->categoryName = $row["CategoryName"];
			$category->description = $row["Description"];
			$category->flag = $row["Flag"];
			$category->parentID = $row["ParentID"];
		}

		// Close the database connection.
		$conn = NULL;

		return $category;
	}

	public static function getAllRecords($pageNo, $pageSize, &$totalRecords, $sortColumn, $sortOrder) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Validate sort column and order.
		$defaultSortColumn = "`CategoryID`";
		$sortColumns = Array("CATEGORYID", "CATEGORYNAME", "DESCRIPTION", "FLAG", "PARENTID");
		$sortColumn = in_array(strtoupper($sortColumn), $sortColumns) ? "`$sortColumn`" : $defaultSortColumn;
		$sortOrder = strcasecmp($sortOrder, "DESC") == 0 ? "DESC" : "ASC";

		$pageNo = (int)$pageNo;
		$pageSize = (int)$pageSize;

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`category`;";

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

		$sql = "SELECT	`CategoryID`,
						`CategoryName`,
						`Description`,
						`Flag`,
						`ParentID`
				FROM	`category`
				ORDER BY $sortColumn $sortOrder
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$category = new Category();
			$category->categoryID = $row["CategoryID"];
			$category->categoryName = $row["CategoryName"];
			$category->description = $row["Description"];
			$category->flag = $row["Flag"];
			$category->parentID = $row["ParentID"];

			array_push($list, $category);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}
}
?>