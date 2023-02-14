<?php
require_once("dbInfo.php");

class Contact {
	public $address;
	public $contactID;
	public $description;
	public $email;
	public $flag;
	public $fullname;
	public $memberID;
	public $message;
	public $telephone;

	public function addContact() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `contact`
				(
					`address`,
					`description`,
					`email`,
					`flag`,
					`fullname`,
					`MemberID`,
					`message`,
					`telephone`
				)
				VALUES
				(
					:address,
					:description,
					:email,
					:flag,
					:fullname,
					:memberID,
					:message,
					:telephone
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":address" => $this->address,
			":description" => $this->description,
			":email" => $this->email,
			":flag" => $this->flag,
			":fullname" => $this->fullname,
			":memberID" => $this->memberID,
			":message" => $this->message,
			":telephone" => $this->telephone));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->contactID = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function updateContact() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`contact`
				SET		`address` = :address,
						`description` = :description,
						`email` = :email,
						`flag` = :flag,
						`fullname` = :fullname,
						`MemberID` = :memberID,
						`message` = :message,
						`telephone` = :telephone
				WHERE	`contactID` = :contactID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":address" => $this->address,
			":contactID" => $this->contactID,
			":description" => $this->description,
			":email" => $this->email,
			":flag" => $this->flag,
			":fullname" => $this->fullname,
			":memberID" => $this->memberID,
			":message" => $this->message,
			":telephone" => $this->telephone));

		// Close the database connection.
		$conn = NULL;
	}

	public static function deleteContact($contactID) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `contact`
				WHERE	`contactID` = :contactID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":contactID" => $contactID));

		// Close the database connection.
		$conn = NULL;
	}

	public static function getContact($contactID) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`address`,
						`contactID`,
						`description`,
						`email`,
						`flag`,
						`fullname`,
						`MemberID`,
						`message`,
						`telephone`
				FROM	`contact`
				WHERE	`contactID` = :contactID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":contactID" => $contactID));

		// Fetch record.
		$contact = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$contact = new Contact();
			$contact->address = $row["address"];
			$contact->contactID = $row["contactID"];
			$contact->description = $row["description"];
			$contact->email = $row["email"];
			$contact->flag = $row["flag"];
			$contact->fullname = $row["fullname"];
			$contact->memberID = $row["MemberID"];
			$contact->message = $row["message"];
			$contact->telephone = $row["telephone"];
		}

		// Close the database connection.
		$conn = NULL;

		return $contact;
	}

	public static function getAllRecords($pageNo, $pageSize, &$totalRecords, $sortColumn, $sortOrder) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Validate sort column and order.
		$defaultSortColumn = "`contactID`";
		$sortColumns = Array("ADDRESS", "CONTACTID", "DESCRIPTION", "EMAIL", "FLAG", "FULLNAME", "MEMBERID", "MESSAGE", "TELEPHONE");
		$sortColumn = in_array(strtoupper($sortColumn), $sortColumns) ? "`$sortColumn`" : $defaultSortColumn;
		$sortOrder = strcasecmp($sortOrder, "DESC") == 0 ? "DESC" : "ASC";

		$pageNo = (int)$pageNo;
		$pageSize = (int)$pageSize;

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`contact`;";

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

		$sql = "SELECT	`address`,
						`contactID`,
						`description`,
						`email`,
						`flag`,
						`fullname`,
						`MemberID`,
						`message`,
						`telephone`
				FROM	`contact`
				ORDER BY $sortColumn $sortOrder
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$contact = new Contact();
			$contact->address = $row["address"];
			$contact->contactID = $row["contactID"];
			$contact->description = $row["description"];
			$contact->email = $row["email"];
			$contact->flag = $row["flag"];
			$contact->fullname = $row["fullname"];
			$contact->memberID = $row["MemberID"];
			$contact->message = $row["message"];
			$contact->telephone = $row["telephone"];

			array_push($list, $contact);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}
}
?>