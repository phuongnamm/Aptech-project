<?php

require_once 'DBinfoConfig.php';

class Itemlibrary {
	public $description;
	public $file;
	public $alt;
	public $flag;
	public $type; // db => itemID
	public $itemLibraryID;
	public $libraryID;
	public $title;

	public function addImglibrary() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `itemlibrary`
				(
					`Description`,
					`File`,
					`Type`,
					`Alt`,
					`LibraryID`,
					`Title`
				)
				VALUES
				(
					:description,
					:file,
					:type,
					:alt,
					:libraryID,
					:title
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":description" => $this->description,
			":file" => $this->file,
			":type" => $this->type,
			":alt" => $this->alt,
			":libraryID" => $this->libraryID,
			":title" => $this->title
		));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->itemLibraryID = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function addVideolibrary() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `itemlibrary`
				(
					`Description`,
					`File`,
					`Type`,
					`LibraryID`,
					`Title`
				)
				VALUES
				(
					:description,
					:file,
					:type,
					:libraryID,
					:title
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":description" => $this->description,
			":file" => $this->file,
			":type" => $this->type,
			":libraryID" => $this->libraryID,
			":title" => $this->title
		));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->itemLibraryID = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function getListItemLibrary() {
        // chuỗi kết nối đến DB
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);
        
        // câu lệnh sql
        $sql = "SELECT `L`.LibraryName,ItemLibraryID, `I`.LibraryID, Title, Alt, File, `I`.Description, `I`.Flag,
				CASE
					WHEN `I`.Type = 1 THEN 'Image'
					WHEN `I`.Type = 2 THEN 'Video'
					ELSE 'Erorr'
				END
				AS `Type`
				FROM `itemlibrary` `I`
				INNER JOIN `library` `L` ON `I`.LibraryID = `L`.LibraryID
				WHERE `I`.Flag IS NULL;";
        
        // chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);
        
        // thực hiện
        $stmt->execute();
        
        $list = Array();
        while($row = $stmt ->fetch(PDO::FETCH_ASSOC)) {
            $s = new Itemlibrary();
            $s->description = $row["Description"];
            $s->LibraryName = $row["LibraryName"];
			$s->file = $row["File"];
			$s->type = $row["Type"];
			$s->alt = $row["Alt"];
			$s->libraryID = $row["LibraryID"];
			$s->title = $row["Title"];
			$s->itemLibraryID = $row["ItemLibraryID"];
            
            array_push($list, $s);
        }
        
        // đóng kết nối
        $conn = NULL;
        
        return $list;
    }

	public function getFileItemLibrary() {
        // chuỗi kết nối đến DB
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);
        
        // câu lệnh sql
        $sql = "SELECT * FROM `itemlibrary` WHERE LibraryID = :LibraryID AND Flag IS NULL LIMIT 6;";
        
        // chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);
        
        // thực hiện
        $stmt->execute(array(
			":LibraryID" => $this->libraryID
		));
        
        $list = Array();
        while($row = $stmt ->fetch(PDO::FETCH_ASSOC)) {
            $s = new Itemlibrary();
			$s->file = $row["File"];
			$s->alt = $row["Alt"];
            
            array_push($list, $s);
        }
        
        // đóng kết nối
        $conn = NULL;
        
        return $list;
    }

	public function getTotalImglibrary() {
        // chuỗi kết nối đến DB
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);
        
        // câu lệnh sql
        $sql = "SELECT COUNT(ItemLibraryID) AS TotalItemLibrary FROM `itemlibrary` WHERE Flag IS NULL AND TYPE = 1;";
        
        // chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);
        
        // thực hiện
        $stmt->execute();
        
        $list = Array();
        while($row = $stmt ->fetch(PDO::FETCH_ASSOC)) {
            $s = new Itemlibrary();
            $s->TotalItemLibrary = $row["TotalItemLibrary"];
            
            array_push($list, $s);
        }
        
        // đóng kết nối
        $conn = NULL;
        
        return $list;
    }

	public function getTotalVideolibrary() {
        // chuỗi kết nối đến DB
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);
        
        // câu lệnh sql
        $sql = "SELECT COUNT(ItemLibraryID) AS TotalItemLibrary FROM `itemlibrary` WHERE Flag IS NULL AND TYPE = 2;";
        
        // chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);
        
        // thực hiện
        $stmt->execute();
        
        $list = Array();
        while($row = $stmt ->fetch(PDO::FETCH_ASSOC)) {
            $s = new Itemlibrary();
            $s->TotalItemLibrary = $row["TotalItemLibrary"];
            
            array_push($list, $s);
        }
        
        // đóng kết nối
        $conn = NULL;
        
        return $list;
    }

	public function updateImageItemlibrary() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`itemlibrary`
				SET		`Description` = :description,
						`Title` = :title,
						`Alt` = :alt
				WHERE	`ItemLibraryID` = :itemLibraryID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":itemLibraryID" => $this->itemLibraryID,
			":description" => $this->description,
			":title" => $this->title,
			":alt" => $this->alt
		));

		// Close the database connection.
		$conn = NULL;
	}

	public function updateVideoItemlibrary() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`itemlibrary`
				SET		`Description` = :description,
						`Title` = :title,
						`File` = :file
				WHERE	`ItemLibraryID` = :itemLibraryID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":itemLibraryID" => $this->itemLibraryID,
			":description" => $this->description,
			":title" => $this->title,
			":file" => $this->file
		));

		// Close the database connection.
		$conn = NULL;
	}

	public static function deleteItemlibrary($itemLibraryID) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

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
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`Description`,
						`Flag`,
						`ItemID`,
						`ItemLibraryID`,
						`LibraryID`
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
			$itemlibrary->flag = $row["Flag"];
			$itemlibrary->itemID = $row["ItemID"];
			$itemlibrary->itemLibraryID = $row["ItemLibraryID"];
			$itemlibrary->libraryID = $row["LibraryID"];
		}

		// Close the database connection.
		$conn = NULL;

		return $itemlibrary;
	}

	public static function getAllRecords($pageNo, $pageSize, &$totalRecords, $sortColumn, $sortOrder) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Validate sort column and order.
		$defaultSortColumn = "`ItemLibraryID`";
		$sortColumns = Array("DESCRIPTION", "FLAG", "ITEMID", "ITEMLIBRARYID", "LIBRARYID");
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
						`Flag`,
						`ItemID`,
						`ItemLibraryID`,
						`LibraryID`
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
			$itemlibrary->flag = $row["Flag"];
			$itemlibrary->itemID = $row["ItemID"];
			$itemlibrary->itemLibraryID = $row["ItemLibraryID"];
			$itemlibrary->libraryID = $row["LibraryID"];

			array_push($list, $itemlibrary);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}

	// function delete
	public function updateListItemlibrary() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Update query.
		$sql = "UPDATE `itemlibrary` SET `Flag` = :flag WHERE `ItemLibraryID` = :itemLibraryID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":itemLibraryID" => $this->itemLibraryID,
			":flag" => $this->flag
		));

		// Close the database connection.
		$conn = NULL;
	}
}
?>