<?php
require_once("dbInfo.php");

class Member {
	public $birthday;
	public $description;
	public $email;
	public $firstname;
	public $flag;
	public $lastname;
	public $memberID;
	public $memberName;
	public $middlename;
	public $password;
	public $role;
	public $sex;
	public $status;
	public $telephone;

	public function addMember() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `member`
				(
					`Birthday`,
					`Description`,
					`Email`,
					`Firstname`,
					`Flag`,
					`Lastname`,
					`MemberName`,
					`Middlename`,
					`Password`,
					`Role`,
					`Sex`,
					`Status`,
					`Telephone`
				)
				VALUES
				(
					STR_TO_DATE(:birthday, '%m/%d/%Y %h:%i %p'),
					:description,
					:email,
					:firstname,
					:flag,
					:lastname,
					:memberName,
					:middlename,
					:password,
					:role,
					:sex,
					:status,
					:telephone
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":birthday" => $this->birthday,
			":description" => $this->description,
			":email" => $this->email,
			":firstname" => $this->firstname,
			":flag" => $this->flag,
			":lastname" => $this->lastname,
			":memberName" => $this->memberName,
			":middlename" => $this->middlename,
			":password" => $this->password,
			":role" => $this->role,
			":sex" => $this->sex,
			":status" => $this->status,
			":telephone" => $this->telephone));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->memberID = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function updateMember() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`member`
				SET		`Birthday` = STR_TO_DATE(:birthday, '%m/%d/%Y %h:%i %p'),
						`Description` = :description,
						`Email` = :email,
						`Firstname` = :firstname,
						`Flag` = :flag,
						`Lastname` = :lastname,
						`MemberName` = :memberName,
						`Middlename` = :middlename,
						`Password` = :password,
						`Role` = :role,
						`Sex` = :sex,
						`Status` = :status,
						`Telephone` = :telephone
				WHERE	`MemberID` = :memberID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":birthday" => $this->birthday,
			":description" => $this->description,
			":email" => $this->email,
			":firstname" => $this->firstname,
			":flag" => $this->flag,
			":lastname" => $this->lastname,
			":memberID" => $this->memberID,
			":memberName" => $this->memberName,
			":middlename" => $this->middlename,
			":password" => $this->password,
			":role" => $this->role,
			":sex" => $this->sex,
			":status" => $this->status,
			":telephone" => $this->telephone));

		// Close the database connection.
		$conn = NULL;
	}

	public static function deleteMember($memberID) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `member`
				WHERE	`MemberID` = :memberID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":memberID" => $memberID));

		// Close the database connection.
		$conn = NULL;
	}

	public static function getMember($memberID) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	DATE_FORMAT(`Birthday`, '%m/%d/%Y %h:%i %p') AS Birthday,
						`Description`,
						`Email`,
						`Firstname`,
						`Flag`,
						`Lastname`,
						`MemberID`,
						`MemberName`,
						`Middlename`,
						`Password`,
						`Role`,
						`Sex`,
						`Status`,
						`Telephone`
				FROM	`member`
				WHERE	`MemberID` = :memberID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":memberID" => $memberID));

		// Fetch record.
		$member = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$member = new Member();
			$member->birthday = $row["Birthday"];
			$member->description = $row["Description"];
			$member->email = $row["Email"];
			$member->firstname = $row["Firstname"];
			$member->flag = $row["Flag"];
			$member->lastname = $row["Lastname"];
			$member->memberID = $row["MemberID"];
			$member->memberName = $row["MemberName"];
			$member->middlename = $row["Middlename"];
			$member->password = $row["Password"];
			$member->role = $row["Role"];
			$member->sex = $row["Sex"];
			$member->status = $row["Status"];
			$member->telephone = $row["Telephone"];
		}

		// Close the database connection.
		$conn = NULL;

		return $member;
	}

	public static function getAllRecords($pageNo, $pageSize, &$totalRecords, $sortColumn, $sortOrder) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Validate sort column and order.
		$defaultSortColumn = "`MemberID`";
		$sortColumns = Array("BIRTHDAY", "DESCRIPTION", "EMAIL", "FIRSTNAME", "FLAG", "LASTNAME", "MEMBERID", "MEMBERNAME", "MIDDLENAME", "PASSWORD", "ROLE", "SEX", "STATUS", "TELEPHONE");
		$sortColumn = in_array(strtoupper($sortColumn), $sortColumns) ? "`$sortColumn`" : $defaultSortColumn;
		$sortOrder = strcasecmp($sortOrder, "DESC") == 0 ? "DESC" : "ASC";

		$pageNo = (int)$pageNo;
		$pageSize = (int)$pageSize;

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`member`;";

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

		$sql = "SELECT	DATE_FORMAT(`Birthday`, '%m/%d/%Y %h:%i %p') AS Birthday,
						`Description`,
						`Email`,
						`Firstname`,
						`Flag`,
						`Lastname`,
						`MemberID`,
						`MemberName`,
						`Middlename`,
						`Password`,
						`Role`,
						`Sex`,
						`Status`,
						`Telephone`
				FROM	`member`
				ORDER BY $sortColumn $sortOrder
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$member = new Member();
			$member->birthday = $row["Birthday"];
			$member->description = $row["Description"];
			$member->email = $row["Email"];
			$member->firstname = $row["Firstname"];
			$member->flag = $row["Flag"];
			$member->lastname = $row["Lastname"];
			$member->memberID = $row["MemberID"];
			$member->memberName = $row["MemberName"];
			$member->middlename = $row["Middlename"];
			$member->password = $row["Password"];
			$member->role = $row["Role"];
			$member->sex = $row["Sex"];
			$member->status = $row["Status"];
			$member->telephone = $row["Telephone"];

			array_push($list, $member);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}
}
?>