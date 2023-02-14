<?php
require_once("dbInfo.php");

class Usersystem {
	public $description;
	public $flag;
	public $password;
	public $role;
	public $status;
	public $userName;
	public $userSystemID;

	public function addUsersystem() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `usersystem`
				(
					`Description`,
					`Flag`,
					`Password`,
					`Role`,
					`Status`,
					`UserName`
				)
				VALUES
				(
					:description,
					:flag,
					:password,
					:role,
					:status,
					:userName
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":description" => $this->description,
			":flag" => $this->flag,
			":password" => $this->password,
			":role" => $this->role,
			":status" => $this->status,
			":userName" => $this->userName));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->userSystemID = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function updateUsersystem() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`usersystem`
				SET		`Description` = :description,
						`Flag` = :flag,
						`Password` = :password,
						`Role` = :role,
						`Status` = :status,
						`UserName` = :userName
				WHERE	`UserSystemID` = :userSystemID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":description" => $this->description,
			":flag" => $this->flag,
			":password" => $this->password,
			":role" => $this->role,
			":status" => $this->status,
			":userName" => $this->userName,
			":userSystemID" => $this->userSystemID));

		// Close the database connection.
		$conn = NULL;
	}

	public static function deleteUsersystem($userSystemID) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `usersystem`
				WHERE	`UserSystemID` = :userSystemID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":userSystemID" => $userSystemID));

		// Close the database connection.
		$conn = NULL;
	}

	public static function getUsersystem($userSystemID) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`Description`,
						`Flag`,
						`Password`,
						`Role`,
						`Status`,
						`UserName`,
						`UserSystemID`
				FROM	`usersystem`
				WHERE	`UserSystemID` = :userSystemID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":userSystemID" => $userSystemID));

		// Fetch record.
		$usersystem = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$usersystem = new Usersystem();
			$usersystem->description = $row["Description"];
			$usersystem->flag = $row["Flag"];
			$usersystem->password = $row["Password"];
			$usersystem->role = $row["Role"];
			$usersystem->status = $row["Status"];
			$usersystem->userName = $row["UserName"];
			$usersystem->userSystemID = $row["UserSystemID"];
		}

		// Close the database connection.
		$conn = NULL;

		return $usersystem;
	}

	public static function getAllRecords($pageNo, $pageSize, &$totalRecords, $sortColumn, $sortOrder) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Validate sort column and order.
		$defaultSortColumn = "`UserSystemID`";
		$sortColumns = Array("DESCRIPTION", "FLAG", "PASSWORD", "ROLE", "STATUS", "USERNAME", "USERSYSTEMID");
		$sortColumn = in_array(strtoupper($sortColumn), $sortColumns) ? "`$sortColumn`" : $defaultSortColumn;
		$sortOrder = strcasecmp($sortOrder, "DESC") == 0 ? "DESC" : "ASC";

		$pageNo = (int)$pageNo;
		$pageSize = (int)$pageSize;

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`usersystem`;";

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
						`Password`,
						`Role`,
						`Status`,
						`UserName`,
						`UserSystemID`
				FROM	`usersystem`
				ORDER BY $sortColumn $sortOrder
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$usersystem = new Usersystem();
			$usersystem->description = $row["Description"];
			$usersystem->flag = $row["Flag"];
			$usersystem->password = $row["Password"];
			$usersystem->role = $row["Role"];
			$usersystem->status = $row["Status"];
			$usersystem->userName = $row["UserName"];
			$usersystem->userSystemID = $row["UserSystemID"];

			array_push($list, $usersystem);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}
}
?>