<?php

require_once 'DBinfoConfig.php';

class Service {
	public $description;
	public $flag;
	public $sale;
	public $price;
	public $serviceID;
	public $serviceName;
	public $avatarService;
	public $vAT;

	public function addService() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `service`
				(
					`Description`,
					`Flag`,
					`Sale`,
					`Price`,
					`ServiceName`,
					`AvatarService`,
					`VAT`
				)
				VALUES
				(
					:description,
					:flag,
					:sale,
					:price,
					:serviceName,
					:avatarService,
					:vAT
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":description" => $this->description,
			":flag" => $this->flag,
			":sale" => $this->sale,
			":price" => $this->price,
			":serviceName" => $this->serviceName,
			":avatarService" => $this->avatarService,
			":vAT" => $this->vAT));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->serviceID = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function getListService() {
        // chuỗi kết nối đến DB
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);
        
        // câu lệnh sql
        $sql = "SELECT * FROM `service` WHERE Flag IS NULL;";
        
        // chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);
        
        // thực hiện
        $stmt->execute();
        
        $list = Array();
        while($row = $stmt ->fetch(PDO::FETCH_ASSOC)) {
            $s = new Service();
            $s->description = $row["Description"];
            $s->flag = $row["Flag"];
			$s->sale = $row["Sale"];
			$s->price = $row["Price"];
			$s->serviceID = $row["ServiceID"];
			$s->serviceName = $row["ServiceName"];
			$s->avatarService = $row["AvatarService"];
			$s->vAT = $row["VAT"];
            
            array_push($list, $s);
        }
        
        // đóng kết nối
        $conn = NULL;
        
        return $list;
    }

	// get menu
	public function getListServiceMenu() {
        // chuỗi kết nối đến DB
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);
        
        // câu lệnh sql
        $sql = "SELECT * FROM `service` WHERE Flag IS NULL LIMIT 4;";
        
        // chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);
        
        // thực hiện
        $stmt->execute();
        
        $list = Array();
        while($row = $stmt ->fetch(PDO::FETCH_ASSOC)) {
            $s = new Service();
            $s->description = $row["Description"];
            $s->flag = $row["Flag"];
			$s->sale = $row["Sale"];
			$s->price = $row["Price"];
			$s->serviceID = $row["ServiceID"];
			$s->serviceName = $row["ServiceName"];
			$s->avatarService = $row["AvatarService"];
			$s->vAT = $row["VAT"];
            
            array_push($list, $s);
        }
        
        // đóng kết nối
        $conn = NULL;
        
        return $list;
    }

	// Outstanding service
	public function getListOutstandingservice() {
        // chuỗi kết nối đến DB
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);
        
        // câu lệnh sql
        $sql = "SELECT * FROM `service` WHERE Flag IS NULL LIMIT 6;";
        
        // chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);
        
        // thực hiện
        $stmt->execute();
        
        $list = Array();
        while($row = $stmt ->fetch(PDO::FETCH_ASSOC)) {
            $s = new Service();
            $s->description = $row["Description"];
            $s->flag = $row["Flag"];
			$s->sale = $row["Sale"];
			$s->price = $row["Price"];
			$s->serviceID = $row["ServiceID"];
			$s->serviceName = $row["ServiceName"];
			$s->avatarService = $row["AvatarService"];
			$s->vAT = $row["VAT"];
            
            array_push($list, $s);
        }
        
        // đóng kết nối
        $conn = NULL;
        
        return $list;
    }

	public function getListServiceTraffic() {
        // chuỗi kết nối đến DB
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);
        
        // câu lệnh sql
        $sql = "SELECT * FROM `service` WHERE Flag IS NULL ORDER BY Price DESC LIMIT 3;";
        
        // chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);
        
        // thực hiện
        $stmt->execute();
        
        $list = Array();
        while($row = $stmt ->fetch(PDO::FETCH_ASSOC)) {
            $s = new Service();
            $s->description = $row["Description"];
            $s->flag = $row["Flag"];
			$s->sale = $row["Sale"];
			$s->price = $row["Price"];
			$s->serviceID = $row["ServiceID"];
			$s->serviceName = $row["ServiceName"];
			$s->avatarService = $row["AvatarService"];
			$s->vAT = $row["VAT"];
            
            array_push($list, $s);
        }
        
        // đóng kết nối
        $conn = NULL;
        
        return $list;
    }

	// function edit
	public function updateService() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`service`
				SET		`Description` = :description,
						`Price` = :price,
						`Sale` = :sale,
						`ServiceName` = :serviceName,
						`VAT` = :vAT
				WHERE	`ServiceID` = :serviceID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":description" => $this->description,
			":price" => $this->price,
			":sale" => $this->sale,
			":serviceName" => $this->serviceName,
			":vAT" => $this->vAT,
			":serviceID" => $this->serviceID
		));

		// Close the database connection.
		$conn = NULL;
	}

	public static function deleteService($serviceID) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `service`
				WHERE	`ServiceID` = :serviceID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":serviceID" => $serviceID));

		// Close the database connection.
		$conn = NULL;
	}

	public static function getService($serviceID) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`Description`,
						`Flag`,
						`Price`,
						`ServiceID`,
						`ServiceName`,
						`VAT`
				FROM	`service`
				WHERE	`ServiceID` = :serviceID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":serviceID" => $serviceID));

		// Fetch record.
		$service = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$service = new Service();
			$service->description = $row["Description"];
			$service->flag = $row["Flag"];
			$service->price = $row["Price"];
			$service->serviceID = $row["ServiceID"];
			$service->serviceName = $row["ServiceName"];
			$service->vAT = $row["VAT"];
		}

		// Close the database connection.
		$conn = NULL;

		return $service;
	}

	public static function getAllRecords($pageNo, $pageSize, &$totalRecords, $sortColumn, $sortOrder) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Validate sort column and order.
		$defaultSortColumn = "`ServiceID`";
		$sortColumns = Array("DESCRIPTION", "FLAG", "PRICE", "SERVICEID", "SERVICENAME", "VAT");
		$sortColumn = in_array(strtoupper($sortColumn), $sortColumns) ? "`$sortColumn`" : $defaultSortColumn;
		$sortOrder = strcasecmp($sortOrder, "DESC") == 0 ? "DESC" : "ASC";

		$pageNo = (int)$pageNo;
		$pageSize = (int)$pageSize;

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`service`;";

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
						`Price`,
						`ServiceID`,
						`ServiceName`,
						`VAT`
				FROM	`service`
				ORDER BY $sortColumn $sortOrder
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$service = new Service();
			$service->description = $row["Description"];
			$service->flag = $row["Flag"];
			$service->price = $row["Price"];
			$service->serviceID = $row["ServiceID"];
			$service->serviceName = $row["ServiceName"];
			$service->vAT = $row["VAT"];

			array_push($list, $service);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}

	// function delete
	public function updateListService() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Update query.
		$sql = "UPDATE `service` SET `Flag` = :Flag WHERE `ServiceID` = :ServiceID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":ServiceID" => $this->serviceID,
			":Flag" => $this->flag
		));

		// Close the database connection.
		$conn = NULL;
	}
}
?>