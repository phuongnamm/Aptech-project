<?php

require_once 'DBinfoConfig.php';

class News {
	public $author;
	public $avatarNews;
	public $categoryID;
	public $content;
	public $description;
	public $flag;
	public $leadcontent;
	public $newsID;
	public $title;

	public function addNews() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `news`
				(
					`author`,
					`avatarNews`,
					`categoryID`,
					`content`,
					`description`,
					`flag`,
					`leadcontent`,
					`newsID`,
					`title`
				)
				VALUES
				(
					:author,
					:avatarNews,
					:categoryID,
					:content,
					:description,
					:flag,
					:leadcontent,
					:newsID,
					:title
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":author" => $this->author,
			":avatarNews" => $this->avatarNews,
			":categoryID" => $this->categoryID,
			":content" => $this->content,
			":description" => $this->description,
			":flag" => $this->flag,
			":leadcontent" => $this->leadcontent,
			":newsID" => $this->newsID,
			":title" => $this->title));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->newsID = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	// admin tbl
	public function getListNewsTbl() {
        // chuỗi kết nối đến DB
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);
        
        // câu lệnh sql
		$sql = "SELECT * FROM `news` `N`
				INNER JOIN `category` `C` ON `N`.CategoryID = `C`.CategoryID
				WHERE `N`.Flag IS NULL;";
        
        // chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);
        
        // thực hiện
        $stmt->execute();
        
        $list = Array();
        while($row = $stmt ->fetch(PDO::FETCH_ASSOC)) {
            $s = new News();
            $s->author = $row["Author"];
            $s->avatarNews = $row["AvatarNews"];
			$s->categoryID = $row["CategoryID"];
			$s->CategoryName = $row["CategoryName"];
			$s->content = $row["Content"];
			$s->description = $row["Description"];
			$s->flag = $row["Flag"];
			$s->leadcontent = $row["LeadContent"];
			$s->newsID = $row["NewsID"];
			$s->title = $row["Title"];
            
            array_push($list, $s);
        }
        
        // đóng kết nối
        $conn = NULL;
        
        return $list;
    }

	public function getListNews($CategoryID) {
        // chuỗi kết nối đến DB
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);
        
        // câu lệnh sql
		$sql = "SELECT * FROM `news` WHERE CategoryID = $CategoryID AND Flag IS NULL;";
        
        // chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);
        
        // thực hiện
        $stmt->execute();
        
        $list = Array();
        while($row = $stmt ->fetch(PDO::FETCH_ASSOC)) {
            $s = new News();
            $s->author = $row["Author"];
            $s->avatarNews = $row["AvatarNews"];
			$s->categoryID = $row["CategoryID"];
			$s->content = $row["Content"];
			$s->description = $row["Description"];
			$s->flag = $row["Flag"];
			$s->leadcontent = $row["LeadContent"];
			$s->newsID = $row["NewsID"];
			$s->title = $row["Title"];
            
            array_push($list, $s);
        }
        
        // đóng kết nối
        $conn = NULL;
        
        return $list;
    }

	// experiences.php
	public function getListExperiences() {
        // chuỗi kết nối đến DB
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);
        
        // câu lệnh sql
        $sql = "SELECT * FROM `news` WHERE Flag IS NULL AND CategoryID = :categoryID;";
        
        // chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);
        
        // Execute the statement.
		$stmt->execute(array(
			":categoryID" => $this->categoryID
		));
        
        $list = Array();
        while($row = $stmt ->fetch(PDO::FETCH_ASSOC)) {
            $s = new News();
            $s->author = $row["Author"];
            $s->avatarNews = $row["AvatarNews"];
			$s->categoryID = $row["CategoryID"];
			$s->content = $row["Content"];
			$s->description = $row["Description"];
			$s->flag = $row["Flag"];
			$s->leadcontent = $row["LeadContent"];
			$s->newsID = $row["NewsID"];
			$s->title = $row["Title"];
            
            array_push($list, $s);
        }
        
        // đóng kết nối
        $conn = NULL;
        
        return $list;
    }

	// getListHistoryIdx
	public function getListHistoryIdx() {
        // chuỗi kết nối đến DB
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);
        
        // câu lệnh sql
        $sql = "SELECT * FROM `news` WHERE Flag IS NULL AND CategoryID = :categoryID LIMIT 4;";
        
        // chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);
        
        // Execute the statement.
		$stmt->execute(array(
			":categoryID" => $this->categoryID
		));
        
        $list = Array();
        while($row = $stmt ->fetch(PDO::FETCH_ASSOC)) {
            $s = new News();
            $s->author = $row["Author"];
            $s->avatarNews = $row["AvatarNews"];
			$s->categoryID = $row["CategoryID"];
			$s->content = $row["Content"];
			$s->description = $row["Description"];
			$s->flag = $row["Flag"];
			$s->leadcontent = $row["LeadContent"];
			$s->newsID = $row["NewsID"];
			$s->title = $row["Title"];
            
            array_push($list, $s);
        }
        
        // đóng kết nối
        $conn = NULL;
        
        return $list;
    }

	// get new index.php
	public function getListNewsIdx() {
        // chuỗi kết nối đến DB
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);
        
        // câu lệnh sql
        $sql = "SELECT * FROM `news` WHERE Flag IS NULL LIMIT 4;";
        
        // chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);
        
        // Execute the statement.
		$stmt->execute();
        
        $list = Array();
        while($row = $stmt ->fetch(PDO::FETCH_ASSOC)) {
            $s = new News();
            $s->author = $row["Author"];
            $s->avatarNews = $row["AvatarNews"];
			$s->categoryID = $row["CategoryID"];
			$s->content = $row["Content"];
			$s->description = $row["Description"];
			$s->flag = $row["Flag"];
			$s->leadcontent = $row["LeadContent"];
			$s->newsID = $row["NewsID"];
			$s->title = $row["Title"];
            
            array_push($list, $s);
        }
        
        // đóng kết nối
        $conn = NULL;
        
        return $list;
    }

	// get image news
	public function getNewsBanner() {
        // chuỗi kết nối đến DB
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);
        
        // câu lệnh sql
        $sql = "SELECT * FROM `news` WHERE Flag IS NULL AND NewsID = :newsID;";
        
        // chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);
        
        // Execute the statement.
		$stmt->execute(array(
			":newsID" => $this->newsID
		));
        
        $list = Array();
        while($row = $stmt ->fetch(PDO::FETCH_ASSOC)) {
            $s = new News();
            $s->avatarNews = $row["AvatarNews"];
			$s->newsID = $row["NewsID"];
            
            array_push($list, $s);
        }
        
        // đóng kết nối
        $conn = NULL;
        
        return $list;
    }

	// blog-single.php
	public function getBlogSingleById() {
        // chuỗi kết nối đến DB
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);
        
        // câu lệnh sql
        $sql = "SELECT * FROM `news` WHERE Flag IS NULL AND NewsID = :NewsID;";
        
        // chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);
        
        // Execute the statement.
		$stmt->execute(array(
			":NewsID" => $this->newsID
		));
        
        $list = Array();
        while($row = $stmt ->fetch(PDO::FETCH_ASSOC)) {
            $s = new News();
            $s->author = $row["Author"];
            $s->avatarNews = $row["AvatarNews"];
			$s->categoryID = $row["CategoryID"];
			$s->content = $row["Content"];
			$s->description = $row["Description"];
			$s->flag = $row["Flag"];
			$s->leadcontent = $row["LeadContent"];
			$s->newsID = $row["NewsID"];
			$s->title = $row["Title"];
            
            array_push($list, $s);
        }
        
        // đóng kết nối
        $conn = NULL;
        
        return $list;
    }

	// function delete
	public function updateListNews() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Update query.
		$sql = "UPDATE `news` SET `Flag` = :Flag WHERE `NewsID` = :NewsID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":NewsID" => $this->newsID,
			":Flag" => $this->flag
		));

		// Close the database connection.
		$conn = NULL;
	}

	// function edit
	public function updateNews() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`news`
				SET		`Author` = :author,
						`Description` = :description,
						`LeadContent` = :leadcontent,
						`Title` = :title
				WHERE	`NewsID` = :newsID;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":author" => $this->author,
			":description" => $this->description,
			":leadcontent" => $this->leadcontent,
			":newsID" => $this->newsID,
			":title" => $this->title));

		// Close the database connection.
		$conn = NULL;
	}

	//lấy ra từng hạng mục trong new
	public function getListNewsID() {
        // chuỗi kết nối đến DB
        $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DBinfoConfig::getServer() . ";dbname=" . DBinfoConfig::getDBname() . ";charset=utf8";
		$conn = new PDO($dsn, DBinfoConfig::getUserName(), DBinfoConfig::getPassword(), $options);
        
        // câu lệnh sql
		$sql = "SELECT * FROM `news` WHERE CategoryID = :CategoryID AND Flag IS NULL;";
        
        // chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);
        
        // thực hiện
        $stmt->execute(array(":CategoryID" => $this->categoryID));
        
        $list = Array();
        while($row = $stmt ->fetch(PDO::FETCH_ASSOC)) {
            $s = new News();
            $s->author = $row["Author"];
            $s->avatarNews = $row["AvatarNews"];
			$s->categoryID = $row["CategoryID"];
			$s->content = $row["Content"];
			$s->description = $row["Description"];
			$s->flag = $row["Flag"];
			$s->leadcontent = $row["LeadContent"];
			$s->newsID = $row["NewsID"];
			$s->title = $row["Title"];
            
            array_push($list, $s);
        }
        
        // đóng kết nối
        $conn = NULL;
        
        return $list;
    }
}
?>