<?php
// bắt đầu trên cùng
session_start();

require_once '../PhpSetting/Common.php';
require_once '../PhpSetting/Usersystem.php';
require_once '../PhpSetting/Mountaineering.php';
require_once '../PhpSetting/Service.php';
require_once '../PhpSetting/Tour.php';
require_once '../PhpSetting/Booktour.php';
require_once '../PhpSetting/News.php';
require_once '../PhpSetting/Library.php';
require_once '../PhpSetting/Category.php';
require_once '../PhpSetting/Contact.php';
require_once '../PhpSetting/Item.php';
require_once '../PhpSetting/Itemlibrary.php';
require_once '../PhpSetting/Locationandservice.php';

// check session
$checkss = IsAuthen_1();
if ($checkss != 1) {
    redirect("login.php");
}

if (!empty($_POST["flogout"])) {
    $a = new Usersystem();
    $a->logout();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Website về leo núi,cắm trại,du lịch,đặt tour và các dịch vụ đi cùng chuyến du lịch.Cho bạn 1 nơi tha hồ lựa chọn các địa điểm du lịch và book tour dễ dàng thuận tiện cùng những khuyến mãi khủng."/>
        <meta name="keywords" content="Leo núi,Moutaineering,Du lịch,Tour,Book Tour, Dịch vụ,Service,Lịch sử,History,Kĩ năng,Đồ leo núi,Sale hấp dẫn ." />
        <meta name="news_keywords" content="Leo núi,Moutaineering,Du lịch,Tour,Book Tour, Dịch vụ,Service,Lịch sử,History,Kĩ năng,Đồ leo núi,Sale hấp dẫn ." />
        <meta http-equiv="REFRESH" content="1800" />
        <meta name="copyright" content="Moutaineering" />
        <meta name="author" content="Moutaineering" />
        <meta name="robots" content="index,follow" />
        <meta name="geo.placename" content="Ha Noi, Viet Nam" />
        <meta name="geo.region" content="VN-HN" />
        <meta name="geo.position" content="21.030624;105.782431" />
        <!-- META FOR FACEBOOK -->
        <meta property="og:site_name" content="Moutaineering.com" />
        <meta property="og:rich_attachment" content="true" />
        <meta property="og:type" content="website" />
        <meta property="og:url" itemprop="url" content="https://Moutaineering.com" />
        <meta property="og:image:width" content="800" />
        <meta property="og:image:height" content="354" />
        <meta content="Moutaineering,Service,Tour,BookTour" itemprop="headline" property="og:title" />
        <meta content="Home" itemprop="description" property="og:description" />
        <!-- END META FOR FACEBOOK -->
        <!-- Reset CSS -->
        <link rel="stylesheet" href="../users/assets/css/reset.min.css">
        <!-- BOOTSTRAP ICON -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <!-- BOOTSTRAP 5.0.2 CSS -->
        <link rel="stylesheet" href="../users/assets/css/bootstrap.min.css">
        <!-- Icon -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
        <!-- CSS ME -->
        <link rel="stylesheet" href="./assets/css/admin.css" />
        <!--favicon-->
        <link rel="icon" type="image/x-icon" href="./assets/img/admin.ico">
        <title>Admin</title>
        <style>
            th{
                font-weight: bold;
            }

            .modal-dialog {
                max-width: 100%;
                margin: 1.75rem;
            }
        </style>
    </head>
    <body id="body-pd" class="body-pd">
        <div class="app">
            <!-- BEGIN HEADER -->
            <header class="header body-pd" id="header">
                <div class="header_toggle"><i class="bx bx-menu text-dark" id="header-toggle"></i></div>
                <form class="w-50"><input type="search" class="form-control" placeholder="Search..." aria-label="Search" /></form>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <input class="btn btn-danger" type="submit" name="flogout" value="Logout">
                </form>
            </header>

            <!-- END HEADER -->

            <!-- BEGIN NAV -->
            <div class="l-navbar showsidebar" id="nav-bar">
                <nav class="nav-sidebar" id="style-11">
                    <div class="">
                        <a href="#" class="nav_logo"> <i class="text-white bi bi-stack"></i> <span class="nav_logo-name">Manager</span> </a>
                        <ul class="nav_list nav">
                            <!-- showdashboard -->
                            <li class="showmenu1">
                                <a href="#dashboard" class="nav_link active" data-bs-toggle="tab" aria-selected="true"> <i class="bx bx-grid-alt nav_icon"></i> <span class="nav_name">Dashboard</span> </a>
                            </li>
                            <!-- profile -->
                            <li class="showmenu1">
                                <a href="#profile" class="nav_link" data-bs-toggle="tab" aria-selected="false"><i class="bi bi-person-bounding-box"></i><span class="nav_name">Profile</span> </a>
                            </li>
                            <!-- booktour -->
                            <li class="showmenu1">
                                <span data-bs-target="#booktour" data-bs-toggle="tab" aria-selected="false">
                                    <a href="#" class="nav_link collapsed rounded" data-bs-toggle="collapse" data-bs-target="#menu3">
                                        <i class="bx bi bi-stickies nav_icon"></i> <span class="nav_name float-start">Booktour <i class="bi bi-chevron-compact-down"></i></span>
                                    </a>
                                </span>
                            </li>
                            <!-- menu booktour -->
                            <div class="menu w-100 mb-0 pt-0 pb-0 collapse" id="menu3">
                                <ul class="btn-toggle-nav list-unstyled fw-normal small">
                                    <li><a class="dropdown-item cl-1" href="#">List Booktour</a></li>
                                </ul>
                            </div>
                            <!-- tour -->
                            <li class="showmenu1">
                                <span data-bs-target="#tour" data-bs-toggle="tab" aria-selected="false">
                                    <a href="#" class="nav_link collapsed rounded" data-bs-toggle="collapse" data-bs-target="#menu2">
                                        <i class="bx bi bi-stickies nav_icon"></i> <span class="nav_name float-start">Tour <i class="bi bi-chevron-compact-down"></i></span>
                                    </a>
                                </span>
                            </li>
                            <!-- menu tour -->
                            <div class="menu w-100 mb-0 pt-0 pb-0 collapse" id="menu2">
                                <ul class="btn-toggle-nav list-unstyled fw-normal small d-block nav">
                                    <li><a class="dropdown-item cl-1" href="#addtour" data-bs-toggle="tab" aria-selected="false">Add Tour</a></li>
                                    <li><a class="dropdown-item cl-1" href="#listtour" data-bs-toggle="tab" aria-selected="false">List Tour</a></li>
                                </ul>
                            </div>
                            <!-- mountaineering -->
                            <li class="showmenu1">
                                <span data-bs-target="#mountaineering" data-bs-toggle="tab" aria-selected="false">
                                    <a href="#" class="nav_link collapsed rounded" data-bs-toggle="collapse" data-bs-target="#menu0">
                                        <i class="bx bi bi-stickies nav_icon"></i> <span class="nav_name float-start">Mountaineering <i class="bi bi-chevron-compact-down"></i></span>
                                    </a>
                                </span>
                            </li>
                            <!-- menu mountaineering -->
                            <div class="menu w-100 mb-0 pt-0 pb-0 collapse" id="menu0">
                                <ul class="btn-toggle-nav list-unstyled fw-normal small d-block nav">
                                    <li><a class="dropdown-item cl-1" href="#addMountaineering" data-bs-toggle="tab" aria-selected="false">Add Mountaineering</a></li>
                                    <li><a class="dropdown-item cl-1" href="#listMountaineering" data-bs-toggle="tab" aria-selected="false">List Mountaineering</a></li>
                                </ul>
                            </div>
                            <!-- service -->
                            <li class="showmenu1">
                                <span data-bs-target="#service" data-bs-toggle="tab" aria-selected="false">
                                    <a href="#" class="nav_link collapsed rounded" data-bs-toggle="collapse" data-bs-target="#menu1">
                                        <i class="bx bi bi-stickies nav_icon"></i> <span class="nav_name float-start">Service <i class="bi bi-chevron-compact-down"></i></span>
                                    </a>
                                </span>
                            </li>
                            <!-- menu service -->
                            <div class="menu w-100 mb-0 pt-0 pb-0 collapse" id="menu1">
                                <ul class="btn-toggle-nav list-unstyled fw-normal small d-block nav">
                                    <li><a class="dropdown-item cl-1" href="#addservice" data-bs-toggle="tab" aria-selected="false">Add Service</a></li>
                                    <li><a class="dropdown-item cl-1" href="#listservice" data-bs-toggle="tab" aria-selected="false">List Service</a></li>
                                </ul>
                            </div>
                            <!-- news -->
                            <li class="showmenu1">
                                <span data-bs-target="#news" data-bs-toggle="tab" aria-selected="false">   
                                    <a href="#" class="nav_link collapsed rounded" data-bs-toggle="collapse" data-bs-target="#menu4">
                                        <i class="bx bi bi-stickies nav_icon"></i> <span class="nav_name float-start">News <i class="bi bi-chevron-compact-down"></i></span>
                                    </a>
                                </span>    
                            </li>
                            <!-- menu news -->
                            <div class="menu w-100 mb-0 pt-0 pb-0 collapse" id="menu4">
                                <ul class="btn-toggle-nav list-unstyled fw-normal small d-block nav">
                                    <li><a class="dropdown-item cl-1" href="#addNews" data-bs-toggle="tab" aria-selected="false">Add News</a></li>
                                    <li><a class="dropdown-item cl-1" href="#listNews" data-bs-toggle="tab" aria-selected="false">List News</a></li>
                                </ul>
                            </div>
                            <!-- library -->
                            <li class="showmenu1">
                                <span data-bs-target="#library" data-bs-toggle="tab" aria-selected="false">   
                                    <a href="#" class="nav_link collapsed rounded" data-bs-toggle="collapse" data-bs-target="#menu5">
                                        <i class="bx bi bi-stickies nav_icon"></i> <span class="nav_name float-start">Library <i class="bi bi-chevron-compact-down"></i></span>
                                    </a>
                                </span>
                            </li>
                            <!-- menu library -->
                            <div class="menu w-100 mb-0 pt-0 pb-0 collapse" id="menu5">
                                <ul class="btn-toggle-nav list-unstyled fw-normal small d-block nav">
                                    <li><a class="dropdown-item cl-1" href="#addlibrary" data-bs-toggle="tab" aria-selected="false">Add Library</a></li>
                                    <li><a class="dropdown-item cl-1" href="#listlibrary" data-bs-toggle="tab" aria-selected="false">List Library</a></li>
                                </ul>
                            </div>
                            <!-- itemlibrary -->
                            <li class="showmenu1">
                                <span data-bs-target="#itemlibrary" data-bs-toggle="tab" aria-selected="false">   
                                    <a href="#" class="nav_link collapsed rounded" data-bs-toggle="collapse" data-bs-target="#menu10">
                                        <i class="bx bi bi-stickies nav_icon"></i> <span class="nav_name float-start">Itemlibrary <i class="bi bi-chevron-compact-down"></i></span>
                                    </a>
                                </span>
                            </li>
                            <!-- menu itemlibrary -->
                            <div class="menu w-100 mb-0 pt-0 pb-0 collapse" id="menu10">
                                <ul class="btn-toggle-nav list-unstyled fw-normal small d-block nav">
                                    <li><a class="dropdown-item cl-1" href="#addItemlibrary" data-bs-toggle="tab" aria-selected="false">Add Itemlibrary</a></li>
                                    <li><a class="dropdown-item cl-1" href="#listItemlibrary" data-bs-toggle="tab" aria-selected="false">List Itemlibrary</a></li>
                                </ul>
                            </div>
                            <!-- category -->
                            <li class="showmenu1">
                                <span data-bs-target="#category" data-bs-toggle="tab" aria-selected="false">   
                                    <a href="#" class="nav_link collapsed rounded" data-bs-toggle="collapse" data-bs-target="#menu6">
                                        <i class="bx bi bi-stickies nav_icon"></i> <span class="nav_name float-start">Category <i class="bi bi-chevron-compact-down"></i></span>
                                    </a>
                                </span>
                            </li>
                            <!-- menu category -->
                            <div class="menu w-100 mb-0 pt-0 pb-0 collapse" id="menu6">
                                <ul class="btn-toggle-nav list-unstyled fw-normal small d-block nav">
                                    <li><a class="dropdown-item cl-1" href="#addCategory" data-bs-toggle="tab" aria-selected="false">Add Category</a></li>
                                    <li><a class="dropdown-item cl-1" href="#listcategory" data-bs-toggle="tab" aria-selected="false">List Category</a></li>
                                </ul>
                            </div>
                            <!-- categorytour -->
                            <li class="showmenu1">
                                <span data-bs-target="#categorytour" data-bs-toggle="tab" aria-selected="false">   
                                    <a href="#" class="nav_link collapsed rounded" data-bs-toggle="collapse" data-bs-target="#menu7">
                                        <i class="bx bi bi-stickies nav_icon"></i> <span class="nav_name float-start">Categorytour <i class="bi bi-chevron-compact-down"></i></span>
                                    </a>
                                </span>
                            </li>
                            <!-- menu categorytour -->
                            <div class="menu w-100 mb-0 pt-0 pb-0 collapse" id="menu7">
                                <ul class="btn-toggle-nav list-unstyled fw-normal small d-block nav">
                                    <li><a class="dropdown-item cl-1" href="#addCategorytour" data-bs-toggle="tab" aria-selected="false">Add Categorytour</a></li>
                                    <li><a class="dropdown-item cl-1" href="#listCategorytour" data-bs-toggle="tab" aria-selected="false">List Categorytour</a></li>
                                </ul>
                            </div>
                            <!-- contact -->
                            <li class="showmenu1">
                                <span data-bs-target="#contact" data-bs-toggle="tab" aria-selected="false">   
                                    <a href="#" class="nav_link collapsed rounded" data-bs-toggle="collapse" data-bs-target="#menu8">
                                        <i class="bx bi bi-stickies nav_icon"></i> <span class="nav_name float-start">Contact <i class="bi bi-chevron-compact-down"></i></span>
                                    </a>
                                </span>
                            </li>
                            <!-- menu contact -->
                            <div class="menu w-100 mb-0 pt-0 pb-0 collapse" id="menu8">
                                <ul class="btn-toggle-nav list-unstyled fw-normal small">
                                    <li><a class="dropdown-item cl-1" href="#">List contact</a></li>
                                </ul>
                            </div>
                            <!-- locationandservice -->
                            <li class="showmenu1">
                                <span data-bs-target="#locationandservice" data-bs-toggle="tab" aria-selected="false">   
                                    <a href="#" class="nav_link collapsed rounded" data-bs-toggle="collapse" data-bs-target="#menu11">
                                        <i class="bx bi bi-stickies nav_icon"></i> <span class="nav_name float-start">Locationandservice <i class="bi bi-chevron-compact-down"></i></span>
                                    </a>
                                </span>
                            </li>
                            <!-- menu locationandservice -->
                            <div class="menu w-100 mb-0 pt-0 pb-0 collapse" id="menu11">
                                <ul class="btn-toggle-nav list-unstyled fw-normal small d-block nav">
                                    <li><a class="dropdown-item cl-1" href="#addLocationandservice" data-bs-toggle="tab" aria-selected="false">Add Locationandservice</a></li>
                                    <li><a class="dropdown-item cl-1" href="#listlocationandservice" data-bs-toggle="tab" aria-selected="false">List Locationandservice</a></li>
                                </ul>
                            </div>
                        </ul>
                    </div>
                </nav>
            </div>
            <!-- END NAV -->

            <!-- BEGIN MAIN -->
            <main class="main">

                <div class="tab-content">
                    <!-- dashboard -->
                    <div class="tab-pane fade show active" id="dashboard">
                        <div class="container text-dark">
                            <div class="row mt-3 mb-3 g-3">
                                <!-- Box Total booktour -->
                                <div class="mt-3 col-md-6 col-xxl-3">
                                    <div class="bg-white shadow card h-100">
                                        <p class="p-2 pt-3 fs-6 fw-bold m-0">Total booktour</p>
                                        <div class="p-3 text-center border-top">
                                            <?php
                                            $a = new Booktour();
                                            $arr = $a->getUserBooktour();

                                            for ($i = 0; $i < count($arr); $i++) {
                                                $obj = $arr[$i];
                                                echo '<span class="m-3 fs-4 fw-bold text-secondary">' . $obj->totaluserbooktour . " " . 'User</span>';
                                            }
                                            ?>
                                            <i class="fs-3 bi bi-person text-info"></i>
                                        </div>
                                    </div>
                                </div>
                                <!-- Box amount Tour -->
                                <div class="mt-3 col-md-6 col-xxl-3">
                                    <div class="bg-white shadow card h-100">
                                        <p class="p-2 pt-3 fs-6 fw-bold m-0">Amount Tour</p>
                                        <div class="text-center border-top p-3">
                                            <?php
                                            // demo 
                                            $a = new Tour();
                                            $arr = $a->getTotalTour();
                                            for($i = 0; $i < count($arr); $i++) {
                                                $obj = $arr[$i];
                                                echo "<span class='fs-4 fw-bold text-secondary m-3'>$obj->totaltour Tour</span>";
                                            }
                                            ?>
                                            <i class="fs-3 text-warning bi bi-signpost-2"></i>
                                        </div>
                                    </div>
                                </div>
                                <!-- Box Item Library -->
                                <div class="mt-3 col-md-6 col-xxl-3">
                                    <div class="bg-white shadow card h-100">
                                        <p class="p-2 pt-3 fs-6 fw-bold m-0">Library Image / Video</p>
                                        <div class="p-3 text-center border-top d-flex justify-content-between">
                                            <div class="d-flex flex-column">
                                                <?php
                                                $a = new Itemlibrary();
                                                $img = $a->getTotalImglibrary();
                                                $video = $a->getTotalVideolibrary();
                                                for($i = 0; $i < count($img); $i++) {
                                                    $obj = $img[$i];
                                                    echo "<span class='m-1 fs-6 fw-bold m-0 text-secondary' id='now-clock'>$obj->TotalItemLibrary -> Image</span>";
                                                }
                                                for($i = 0; $i < count($video); $i++) {
                                                    $obj = $video[$i];
                                                    echo "<span class='m-1 fs-6 fw-bold m-0 text-secondary' id='now-clock'>$obj->TotalItemLibrary -> Video</span>";
                                                }
                                                ?>
                                            </div>
                                            <i class="fs-3 bi bi-folder text-danger"></i>
                                        </div>
                                    </div>
                                </div>
                                <!-- Box Service price -->
                                <div class="mt-3 col-md-6 col-xxl-3">
                                    <div class="bg-white shadow card h-100">
                                        <p class="p-2 pt-3 fs-6 fw-bold m-0">Service price</p>
                                        <div class="text-center border-top p-3 d-flex justify-content-between">
                                            <div class="d-flex flex-column">
                                                <?php
                                                $a = new Service();
                                                $arr = $a->getListServiceTraffic();
                                                if(count($arr) > 0) {
                                                    $stt=0;
                                                    for($i = 0; $i < count($arr); $i++) {
                                                        $stt++;
                                                        $obj = $arr[$i];
                                                        echo "<span class='fs fw-bold text-start text-secondary'>$stt. $obj->serviceName: $obj->price</span>";
                                                    }
                                                } else {
                                                    echo "<span class='m-3 fs-4 fw-bold text-secondary'>0 Service</span>";
                                                }
                                                ?>
                                            </div>
                                            <i class="fs-3 text-success bi bi-currency-dollar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row pb-5">

                                <div class="col-xxl-12 mb-3">
                                    <div class="p-2 card shadow" style="height: 100%;">
                                        <canvas id="myChart1"></canvas>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <!-- booktour -->
                    <div class="tab-pane fade" id="booktour">
                        <div class="container text-dark pb-5 pt-5">
                            <!-- table list booktour -->
                            <div id="listbooktour">
                                <div class="text-center">
                                    <h2>List Booktour</h2>
                                </div>
                                <div class="pb-5">
                                    <div style="overflow-x: auto;">

                                        <div id="tbl-kithi" class="mt-4 pb-5" >
                                            <table class="table table-striped table-hover">
                                                <tr>
                                                    <th scope="col">STT</th>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">TourID</th>
                                                    <th scope="col">UserBookTour</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Address</th>
                                                    <th scope="col">Phone</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Description</th>
                                                    <th class="text-center" scope="col">Action</th>
                                                </tr>
                                                <?php
                                                $a = new Booktour();
                                                $arr = $a->getListBooktour();
                                                $strTbl = "";

                                                $stt = 1;

                                                for ($i = 0; $i < count($arr); $i++) {
                                                    $obj = $arr[$i];

                                                    $strTbl .= "<tr>";
                                                    $strTbl .= "<th>" . $stt++ . "</th>";
                                                    $strTbl .= "<td id='BookTourID'>$obj->BookTourID</td>";
                                                    $strTbl .= "<td id='TourID'>$obj->TourID</td>";
                                                    $strTbl .= "<td id='AnonymousBookTour'>$obj->AnonymousBookTour</td>";
                                                    $strTbl .= "<td id='AnonymousEmail'>$obj->AnonymousEmail</td>";
                                                    $strTbl .= "<td id='AnonymousAddress'>$obj->AnonymousAddress</td>";
                                                    $strTbl .= "<td id='AnonymousPhone'>$obj->AnonymousPhone</td>";
                                                    $strTbl .= "<td id='Status'>$obj->Status</td>";
                                                    $strTbl .= "<td id='Description'>$obj->Description</td>";
                                                    $strTbl .= "<td>
                                                                        <div class='d-flex justify-content-center'>
                                                                            <form class='m-1' action='' method='POST'>
                                                                                <input type='hidden' name='fBookTourID' value='$obj->BookTourID'/>
                                                                                <input type='hidden' name='fvalDel' value='d'/>
                                                                                <input type='submit' class='btn btn-danger' name='fdelete' value='Delete'>
                                                                            </form>
                                                                            <input type='button' class='btn-editbooktour btn btn-primary m-1' name='feditbooktour' value='Edit'>
                                                                        </div>    
                                                                    </td>";
                                                    $strTbl .= "</tr>";
                                                }

                                                echo $strTbl;

                                                //delete => update
                                                if (isset($_POST["fdelete"])) {
                                                    $fBookTourID = $_POST["fBookTourID"];
                                                    $fvalDel = $_POST["fvalDel"];

                                                    $a = new Booktour();
                                                    $a->Flag = $fvalDel;
                                                    $a->BookTourID = $fBookTourID;
                                                    $a->updateListBooktour();
                                                }
                                                ?>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- edit list booktour -->
                            <div id="editbooktour" class="d-none">
                                <div class="pt-5 pb-5 d-flex justify-content-center">
                                    <div style="width: 650px;">
                                        <div class="text-center pb-3">
                                            <h2>Update</h2>
                                        </div>
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                            <?php
                                            $a = new Booktour();
                                            $arr = $a->getListBooktour();

                                            for ($i = 0; $i < count($arr); $i++) {
                                                $obj = $arr[$i];

                                                echo "<input type='hidden' name='fBookTourID' value='$obj->BookTourID'>";
                                            }
                                            ?>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">TourID:</label>
                                                <input type="text" id="TourID" name="fTourID" class="form-control" placeholder="TourID" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">AnonymousBookTour:</label>
                                                <input type="text" id="AnonymousBookTour" name="fAnonymousBookTour" class="form-control" placeholder="AnonymousBookTour" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">AnonymousEmail:</label>
                                                <input type="text" id="AnonymousEmail" name="fAnonymousEmail" class="form-control" placeholder="AnonymousEmail" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">AnonymousAddress:</label>
                                                <input type="text" id="AnonymousAddress" name="fAnonymousAddress" class="form-control" placeholder="AnonymousAddress" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">AnonymousPhone:</label>
                                                <input type="text" id="AnonymousPhone" name="fAnonymousPhone" class="form-control" placeholder="AnonymousPhone" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">Status:</label>
                                                <input type="text" id="Status" name="fStatus" class="form-control" placeholder="Status" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">Description:</label>
                                                <input type="text" id="Description" name="fDescription" class="form-control" placeholder="Description" />
                                            </div>
                                            <input type="submit" id="btnBookTour" name="fbtnBookTour" class="btn btn-primary" value="Save" />
                                            <div class="mb-3">
                                                <i class="text-warning bi bi-exclamation-triangle pe-1"></i><span class="text-danger">If you need to fix other fields, please contact admin for support: <a href="mailto:nduydu66@gmail.com">nduydu66@gmail.com</a></span>
                                            </div>
                                        </form>
                                        <?php if (isset($_POST["fbtnBookTour"])) {
                                            $fBookTourID = $_POST["fBookTourID"];
                                            $fTourID = $_POST["fTourID"];
                                            $fAnonymousBookTour = $_POST["fAnonymousBookTour"];
                                            $fAnonymousEmail = $_POST["fAnonymousEmail"];
                                            $fAnonymousAddress = $_POST["fAnonymousAddress"];
                                            $fAnonymousPhone = $_POST["fAnonymousPhone"];
                                            $fStatus = $_POST["fStatus"];
                                            $fDescription = $_POST["fDescription"];

                                            $a = new Booktour();
                                            $a->BookTourID = $fBookTourID;
                                            $a->TourID = $fTourID;
                                            $a->AnonymousBookTour = $fAnonymousBookTour;
                                            $a->AnonymousEmail = $fAnonymousEmail;
                                            $a->AnonymousAddress = $fAnonymousAddress;
                                            $a->AnonymousPhone = $fAnonymousPhone;
                                            $a->Status = $fStatus;
                                            $a->Description = $fDescription;
                                            $a->editListBootour();
                                        } ?>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>

                    <!-- tour -->
                    <div class="tab-pane fade" id="tour">
                        <div class="container pb-5">
                            <div class="tab-content">

                                <!-- form Add tour -->
                                <div class="tab-pane fade show active text-dark" id="addtour">
                                    <div class="pt-5 pb-5 d-flex justify-content-center">
                                        <div style="width: 650px;">
                                            <div class="text-center pb-3">
                                                <h2>Add Tour</h2>
                                            </div>
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">TourName:</label>
                                                    <input required type="text" id="TourName" name="fTourName" class="form-control" placeholder="TourName" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">CategoryTour:</label>
                                                    <select class="form-select" name="fCategoryTour" id="CategoryTour">
                                                        <?php
                                                        $a = new CategoryTour();
                                                        $arr = $a->getListCategoryTour();
                                                        for($i = 0; $i < count($arr); $i++) {
                                                            $obj = $arr[$i];
                                                            echo "<option value='$obj->CategoryTourID'>$obj->CategoryTourName</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3 d-flex w-100">
                                                    <div class="w-50 pe-2">
                                                        <label class="form-label fw-bold text-secondary">TimeStart:</label>
                                                        <input required type="date" id="TimeStart" name="fTimeStart" class="form-control" placeholder="TimeStart" />
                                                    </div>
                                                    <div class="w-50 ps-2">
                                                        <label class="form-label fw-bold text-secondary">TimeEnd:</label>
                                                        <input required type="date" id="TimeEnd" name="fTimeEnd" class="form-control" placeholder="TimeEnd" />
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">TourPrice:</label>
                                                    <div class="input-group">
                                                        <input required type="text" id="TourPrice" name="fTourPrice" class="form-control" placeholder="TourPrice" />
                                                        <span class="input-group-text">USD</span>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">TourPromotion:</label>
                                                    <div class="input-group">
                                                        <input required type="text" id="TourPromotion" name="fTourSale" class="form-control" placeholder="TourPromotion" />
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Location:</label>
                                                    <div class="input-group">
                                                        <input required type="text" id="Location" name="fLocation" class="form-control" placeholder="Location" />
                                                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">AvatarTour:</label>
                                                    <input required type="file" id="AvatarTour" name="fAvatarTour" class="form-control" placeholder="AvatarTour" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Status:</label>
                                                    <select class="form-select" id="Status" name="fStatus" required>
                                                        <option value="3">Not activated</option>
                                                        <option value="1">Active</option>
                                                        <option value="2">Stop working</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Leadcontent:</label>
                                                    <input required type="text" id="Leadcontent" name="fLeadcontent" class="form-control" placeholder="Leadcontent" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Description:</label>
                                                    <input required type="text" id="Description" name="fDescription" class="form-control" placeholder="Description" />
                                                </div>
                                                <input type="submit" id="btntour" name="ftour" class="btn btn-primary" value="Save" />
                                            </form>
                                            <?php
                                            $message = "";

                                            if (isset($_POST['ftour']) && $_POST['ftour'] == 'Save') {
                                                if (isset($_FILES['fAvatarTour']) && $_FILES['fAvatarTour']['error'] === UPLOAD_ERR_OK) {
                                                    // lưu vào thư mục tạm webserver
                                                    $fileTmpPath = $_FILES['fAvatarTour']['tmp_name'];
                                                    // echo $fileTmpPath;

                                                    // thông tin file
                                                    $fileName = $_FILES['fAvatarTour']['name'];
                                                    $fileSize = $_FILES['fAvatarTour']['size'];
                                                    $fileType = $_FILES['fAvatarTour']['type'];

                                                    // lấy tên file và đuôi file
                                                    $fileNameCmps = explode(".", $fileName);

                                                    // chuẩn hóa lại tên file
                                                    $fileExtension = strtolower(end($fileNameCmps));

                                                    // thiết đặt filename để k bị trùng nhau
                                                    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

                                                    // kiem tra phan mo rong cua file
                                                    $allowedfileExtensions = ['jpg', 'gif', 'png'];

                                                    // kiểm tra đuôi file
                                                    if (in_array($fileExtension, $allowedfileExtensions)) {
                                                        // thu muc file uploaded
                                                        $uploadFileDir = '../admin/assets/img/Tour/';
                                                        $dest_path = $uploadFileDir . $newFileName;

                                                        if (move_uploaded_file($fileTmpPath, $dest_path)) {
                                                            $message = "";
                                                        } else {
                                                            $message = 'Check if the directory has write permissions.';
                                                        }
                                                    } else {
                                                        $message = 'Only file types allowed: ' . implode(',', $allowedfileExtensions);
                                                    }
                                                }
                                            }

                                            echo $message;

                                            if (isset($_POST["ftour"])) {
                                                $fCategoryTour = $_POST["fCategoryTour"];
                                                $fTourName = $_POST["fTourName"];
                                                $fTimeStart = $_POST["fTimeStart"];
                                                $fTimeEnd = $_POST["fTimeEnd"];
                                                $fTourPrice = $_POST["fTourPrice"];
                                                $fTourSale = $_POST["fTourSale"];
                                                $fLocation = $_POST["fLocation"];
                                                // $fAvatarTour = $_POST["fAvatarTour"];
                                                $fStatus = $_POST["fStatus"];
                                                $fLeadcontent = $_POST["fLeadcontent"];
                                                $fDescription = $_POST["fDescription"];

                                                $a = new Tour();
                                                $a->CategoryTourID = $fCategoryTour;
                                                $a->TourName = $fTourName;
                                                $a->TimeStart = $fTimeStart;
                                                $a->TimeEnd = $fTimeEnd;
                                                $a->TourPrice = $fTourPrice;
                                                $a->TourSale = $fTourSale;
                                                $a->Location = $fLocation;
                                                $a->AvatarTour = $uploadFileDir . $newFileName;
                                                $a->Status = $fStatus;
                                                $a->Leadcontent = $fLeadcontent;
                                                $a->Description = $fDescription;
                                                $a->addTour();
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- table list tour -->
                                <div class="tab-pane fade show active text-dark" id="listtour">
                                    <div class="pt-5 pb-5">
                                        <div class="text-center">
                                            <h2>List Tour</h2>
                                        </div>
                                        <div class="pb-5">
                                            <div style="overflow-x: auto;">

                                                <div id="tbl-kithi" class="mt-4 pb-5" >
                                                    <table class="table table-striped table-hover">
                                                        <tr>
                                                            <th scope="col">STT</th>
                                                            <th scope="col">CategoryTourName</th>
                                                            <th scope="col">TourName</th>
                                                            <th scope="col">Location</th>
                                                            <th scope="col">Day</th>
                                                            <th scope="col">TourPrice</th>
                                                            <th scope="col">Action</th>
                                                            <th scope="col">More</th>
                                                        </tr>
                                                        <?php
                                                        $a = new Tour();
                                                        $arr = $a->getListTour();
                                                        $strTbl = "";

                                                        $stt = 1;

                                                        for ($i = 0; $i < count($arr); $i++) {
                                                            $obj = $arr[$i];

                                                            $strTbl .= "<tr>";
                                                            $strTbl .= "<th>" . $stt++ . "</th>";
                                                            $strTbl .= "<td>$obj->CategoryTourName</td>";
                                                            $strTbl .= "<td id='fTourName'>$obj->TourName</td>";
                                                            $strTbl .= "<td>$obj->Location</td>";
                                                            $strTbl .= "<td>$obj->Day</td>";
                                                            $strTbl .= "<td>$obj->TourPrice USD</td>";
                                                            $strTbl .= "<td>
                                                                            <div class='d-flex'>
                                                                                <form class='m-1' action='' method='POST'>
                                                                                    <input type='hidden' name='fTourID' value='$obj->TourID'/>
                                                                                    <input type='hidden' name='fvalDel' value='d'/>
                                                                                    <input type='submit' class='btn btn-danger' name='fdelete' value='Delete'>
                                                                                </form>
                                                                                <input type='button' class='btn btn-primary m-1' name='fedittour' value='Edit'>
                                                                            </div>    
                                                                        </td>";
                                                            $strTbl .= "<td>
                                                                        <button onclick='ShowTourById(this.value)' class='btn btn-secondary' data-bs-toggle='modal' data-bs-target='#modaltour' value='$obj->TourID'>More</button>
                                                                    </td>";

                                                            // các trường ẩn lấy vào form edit
                                                            $strTbl .= "<td class='d-none' id='TourID'>$obj->TourID</td>";
                                                            $strTbl .= "<td class='d-none' id='TimeStart'>$obj->TimeStart</td>";
                                                            $strTbl .= "<td class='d-none' id='TimeEnd'>$obj->TimeEnd</td>";
                                                            $strTbl .= "<td class='d-none' id='TourPrice'>$obj->TourPrice</td>";
                                                            $strTbl .= "<td class='d-none' id='TourSale'>$obj->TourSale</td>";
                                                            $strTbl .= "<td class='d-none' id='Location'>$obj->Location</td>";
                                                            $strTbl .= "<td class='d-none' id='Description'>$obj->Description</td>";
                                                            $strTbl .= "<td class='d-none' id='Leadcontent'>$obj->Leadcontent</td>";
                                                            $strTbl .= "</tr>";

                                                        }

                                                        echo $strTbl;

                                                        
                                                        //delete => update
                                                        if (isset($_POST["fdelete"])) {
                                                            $TourID = $_POST["fTourID"];
                                                            $fvalDel = $_POST["fvalDel"];

                                                            $a = new Tour();
                                                            $a->Flag = $fvalDel;
                                                            $a->TourID = $TourID;
                                                            $a->updateListTour();
                                                        }
                                                        ?>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            <!-- edit list tour -->
                            <div id="edittour" class="d-none text-dark">
                                <div class="pb-5 d-flex justify-content-center">
                                    <div style="width: 650px;">
                                        <div class="text-center pb-3">
                                            <h2>Edit</h2>
                                        </div>
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                            <input type="hidden" name="fTourID"/>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">TourName:</label>
                                                <input type="text" name="fTourName" class="form-control" placeholder="TourName"/>
                                            </div>
                                            <div class="mb-3 d-flex w-100">
                                                <div class="w-50 pe-2">
                                                    <label class="form-label fw-bold text-secondary">TimeStart:</label>
                                                    <input type="text" name="fTimeStart" class="form-control" placeholder="TimeStart" />
                                                </div>
                                                <div class="w-50 ps-2">
                                                    <label class="form-label fw-bold text-secondary">TimeEnd:</label>
                                                    <input type="text" name="fTimeEnd" class="form-control" placeholder="TimeEnd" />
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">TourPrice:</label>
                                                <div class="input-group">
                                                    <input type="text" name="fTourPrice" class="form-control" placeholder="TourPrice"/>
                                                    <span class="input-group-text">USD</span>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">TourPromotion:</label>
                                                <div class="input-group">
                                                    <input type="text" name="fTourSale" class="form-control" placeholder="TourPromotion"/>
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">Location:</label>
                                                <div class="input-group">
                                                    <input type="text" name="fLocation" class="form-control" placeholder="Location"/>
                                                    <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">Description:</label>
                                                <input type="text" name="fDescription" class="form-control" placeholder="Description"/>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">Leadcontent:</label>
                                                <input type="text" name="fLeadcontent" class="form-control" placeholder="Leadcontent"/>
                                            </div>
                                            <input type="submit" id="btntour" name="ftourEdit" class="btn btn-primary" value="Save" />
                                            <div class="mb-3">
                                                <i class="text-warning bi bi-exclamation-triangle pe-1"></i><span class="text-danger">If you need to fix other fields, please contact admin for support: <a href="mailto:nduydu66@gmail.com">nduydu66@gmail.com</a></span>
                                            </div>
                                        </form>
                                        <?php
                                        
                                        if (isset($_POST["ftourEdit"])) {
                                            $fTourID = $_POST["fTourID"];
                                            $fTourName = $_POST["fTourName"];
                                            $fTourPrice = $_POST["fTourPrice"];
                                            $fTourSale = $_POST["fTourSale"];
                                            $fLocation = $_POST["fLocation"];
                                            $fDescription = $_POST["fDescription"];
                                            $fTimeStart = $_POST["fTimeStart"];
                                            $fTimeEnd = $_POST["fTimeEnd"];
                                            $fLeadcontent = $_POST["fLeadcontent"];

                                            $a = new Tour();
                                            $a->TourID = $fTourID;
                                            $a->TourName = $fTourName;
                                            $a->TourPrice = $fTourPrice;
                                            $a->TourSale = $fTourSale;
                                            $a->Location = $fLocation;
                                            $a->Description = $fDescription;
                                            $a->TimeStart = $fTimeStart;
                                            $a->TimeEnd = $fTimeEnd;
                                            $a->Leadcontent = $fLeadcontent;
                                            $a->updateTour();
                                        }
                                        ?>
                                    </div>
                                </div> 
                            </div>

                        </div>
                    </div>

                    <!-- mountaineering -->
                    <div class="tab-pane fade" id="mountaineering">
                        <div class="container text-dark pb-5">
                            <div class="tab-content">

                                <!-- form Add Mountaineering -->
                                <div class="tab-pane fade show active text-dark" id="addMountaineering">
                                    <div class="pt-5 pb-5 d-flex justify-content-center">
                                        <div style="width: 650px;">
                                            <div class="text-center pb-3">
                                                <h2 class="">Add Mountaineering</h2>
                                            </div>
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">MountainName:</label>
                                                    <input required type="text" id="MountainName" name="fMountainName" class="form-control" placeholder="MountainName" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">LocationX:</label>
                                                    <input required type="text" id="LocationX" name="fLocationX" class="form-control" placeholder="LocationX" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">LocationY:</label>
                                                    <input required type="text" id="LocationY" name="fLocationY" class="form-control" placeholder="LocationY" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Banner:</label>
                                                    <input required type="file" id="Banner" name="fBanner" class="form-control" placeholder="Banner" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Type:</label>
                                                    <select class="form-select" id="Type" name="fType">
                                                        <option value="1">One leg</option>
                                                        <option value="2">Many leg</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Level:</label>
                                                    <select required class="form-select" id="Level" name="fLevel">
                                                        <option value="1">Easy</option>
                                                        <option value="2">Medium</option>
                                                        <option value="3">Difficult</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Sheltering (the abode of that mountain top):</label>
                                                    <input required type="text" id="Sheltering" name="fSheltering" class="form-control" placeholder="Sheltering" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Techniques (Mountain climbing techniques):</label>
                                                    <input required type="text" id="Techniques" name="fTechniques" class="form-control" placeholder="Techniques" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Description:</label>
                                                    <input type="text" id="Description" name="fDescription" class="form-control" placeholder="Description" />
                                                </div>
                                                <input type="submit" id="btnMountaineering" name="fMountaineering" class="btn btn-primary" value="Save" />
                                            </form>

                                            <?php
                                            $message = "";

                                            if (isset($_POST['fMountaineering']) && $_POST['fMountaineering'] == 'Save') {
                                                if (isset($_FILES['fBanner']) && $_FILES['fBanner']['error'] === UPLOAD_ERR_OK) {
                                                    // lưu vào thư mục tạm webserver
                                                    $fileTmpPath = $_FILES['fBanner']['tmp_name'];
                                                    // echo $fileTmpPath;

                                                    // thông tin file
                                                    $fileName = $_FILES['fBanner']['name'];
                                                    $fileSize = $_FILES['fBanner']['size'];
                                                    $fileType = $_FILES['fBanner']['type'];

                                                    // lấy tên file và đuôi file
                                                    $fileNameCmps = explode(".", $fileName);

                                                    // chuẩn hóa lại tên file
                                                    $fileExtension = strtolower(end($fileNameCmps));

                                                    // thiết đặt filename để k bị trùng nhau
                                                    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

                                                    // kiem tra phan mo rong cua file
                                                    $allowedfileExtensions = ['jpg', 'gif', 'png'];

                                                    // kiểm tra đuôi file
                                                    if (in_array($fileExtension, $allowedfileExtensions)) {
                                                        // thu muc file uploaded
                                                        $uploadFileDir = '../admin/assets/img/Mountaineering/';
                                                        $dest_path = $uploadFileDir . $newFileName;

                                                        if (move_uploaded_file($fileTmpPath, $dest_path)) {
                                                            $message = "";
                                                        } else {
                                                            $message = 'Check if the directory has write permissions.';
                                                        }
                                                    } else {
                                                        $message = 'Only file types allowed: ' . implode(',', $allowedfileExtensions);
                                                    }
                                                }
                                            }

                                            echo $message;

                                            if (isset($_POST["fMountaineering"])) {
                                                $fMountainName = $_POST["fMountainName"];
                                                $fLocationX = $_POST["fLocationX"];
                                                $fLocationY = $_POST["fLocationY"];
                                                // $fBanner = $_POST["fBanner"];
                                                $fType = $_POST["fType"];
                                                $fLevel = $_POST["fLevel"];
                                                $fSheltering = $_POST["fSheltering"];
                                                $fTechniques = $_POST["fTechniques"];
                                                $fDescription = $_POST["fDescription"];

                                                $a = new Mountaineering();
                                                $a->mountainName = $fMountainName;
                                                $a->locationX = $fLocationX;
                                                $a->locationY = $fLocationY;
                                                $a->banner = $uploadFileDir . $newFileName;
                                                $a->type = $fType;
                                                $a->level = $fLevel;
                                                $a->sheltering = $fSheltering;
                                                $a->techniques = $fTechniques;
                                                $a->description = $fDescription;
                                                $a->addMountaineering();
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- table list Mountaineering -->
                                <div class="tab-pane fade show active text-dark" id="listMountaineering">
                                    <div class="pt-5 pb-5">
                                        <div class="text-center">
                                            <h2>List Mountaineering</h2>
                                        </div>
                                        <div class="pb-5">
                                            <div style="overflow-x: auto;">
                                                <div id="tbl-kithi" class="mt-4 pb-5">
                                                <table class="table table-striped table-hover">
                                                        <tr>
                                                            <th scope="col">STT</th>
                                                            <th scope="col">ID</th>
                                                            <th scope="col">MountainName</th>
                                                            <th scope="col">LocationX</th>
                                                            <th scope="col">LocationY</th>
                                                            <th scope="col">Banner</th>
                                                            <th scope="col">Type</th>
                                                            <th scope="col">Level</th>
                                                            <th scope="col">Sheltering</th>
                                                            <th scope="col">Techniques</th>
                                                            <th scope="col">Description</th>
                                                            <th class="text-center" scope="col">Action</th>
                                                        </tr>
                                                        
                                                        <?php
                                                        $a = new Mountaineering();
                                                        $arr = $a->getListMountaineering();
                                                        $strTbl = "";

                                                        $stt = 1;

                                                        for ($i = 0; $i < count($arr); $i++) {
                                                            $obj = $arr[$i];

                                                            $strTbl .= "<tr>";
                                                            $strTbl .= "<th>" . $stt++ . "</th>";
                                                            $strTbl .= "<td id='mountaineeringID'>$obj->mountaineeringID</td>";
                                                            $strTbl .= "<td id='mountainName'>$obj->mountainName</td>";
                                                            $strTbl .= "<td id='locationX'>$obj->locationX</td>";
                                                            $strTbl .= "<td id='locationY'>$obj->locationY</td>";
                                                            $strTbl .= "<td><img src='$obj->banner' alt='banner' width='200' height='100'></td>";
                                                            $strTbl .= "<td>$obj->type</td>";
                                                            $strTbl .= "<td>$obj->level</td>";
                                                            $strTbl .= "<td id='sheltering'>$obj->sheltering</td>";
                                                            $strTbl .= "<td id='techniques'>$obj->techniques</td>";
                                                            $strTbl .= "<td id='description'>$obj->description</td>";
                                                            $strTbl .= "<td>
                                                                                <div class='d-flex'>
                                                                                    <form class='m-1' action='' method='POST'>
                                                                                        <input type='hidden' name='fmountaineeringID' value='$obj->mountaineeringID'/>
                                                                                        <input type='hidden' name='fvalDel' value='d'/>
                                                                                        <input type='submit' class='btn btn-danger' name='fdelete' value='Delete'>
                                                                                    </form>
                                                                                    <input type='submit' class='btn btn-primary m-1' name='feditMountaineering' value='Edit'>
                                                                                </div>    
                                                                            </td>";
                                                            $strTbl .= "</tr>";
                                                        }

                                                        echo $strTbl;

                                                        //delete => update
                                                        if (isset($_POST["fdelete"])) {
                                                            $fmountaineeringID = $_POST["fmountaineeringID"];
                                                            $fvalDel = $_POST["fvalDel"];

                                                            $a = new Mountaineering();
                                                            $a->flag = $fvalDel;
                                                            $a->mountaineeringID = $fmountaineeringID;
                                                            $a->updateListMountaineering();
                                                        }
                                                        ?>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- edit list Mountaineering -->
                            <div id="editMountaineering" class="d-none">
                                <div class="pb-5 d-flex justify-content-center">
                                    <div style="width: 650px;">
                                        <div class="text-center pb-3">
                                            <h2 class="">Edit</h2>
                                        </div>
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="fmountaineeringID">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">MountainName:</label>
                                                <input type="text" id="MountainName" name="fMountainName" class="form-control" placeholder="MountainName" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">LocationX:</label>
                                                <input type="text" id="LocationX" name="fLocationX" class="form-control" placeholder="LocationX" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">LocationY:</label>
                                                <input type="text" id="LocationY" name="fLocationY" class="form-control" placeholder="LocationY" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">Sheltering:</label>
                                                <input type="text" id="Sheltering" name="fSheltering" class="form-control" placeholder="Sheltering" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">Techniques:</label>
                                                <input type="text" id="Techniques" name="fTechniques" class="form-control" placeholder="Techniques" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">Description:</label>
                                                <input type="text" id="Description" name="fDescription" class="form-control" placeholder="Description" />
                                            </div>
                                            <input type="submit" id="btnMountaineering" name="fMountaineeringEdit" class="btn btn-primary" value="Save" />
                                            <div class="mb-3">
                                                <i class="text-warning bi bi-exclamation-triangle pe-1"></i><span class="text-danger">If you need to fix other fields, please contact admin for support: <a href="mailto:nduydu66@gmail.com">nduydu66@gmail.com</a></span>
                                            </div>
                                        </form>
                                        <?php
                                        
                                        if (isset($_POST["fMountaineeringEdit"])) {
                                            $fmountaineeringID = $_POST["fmountaineeringID"];
                                            $fMountainName = $_POST["fMountainName"];
                                            $fLocationX = $_POST["fLocationX"];
                                            $fLocationY = $_POST["fLocationY"];
                                            $fSheltering = $_POST["fSheltering"];
                                            $fTechniques = $_POST["fTechniques"];
                                            $fDescription = $_POST["fDescription"];

                                            $a = new Mountaineering();
                                            $a->mountaineeringID = $fmountaineeringID;
                                            $a->mountainName = $fMountainName;
                                            $a->locationX = $fLocationX;
                                            $a->locationY = $fLocationY;
                                            $a->sheltering = $fSheltering;
                                            $a->techniques = $fTechniques;
                                            $a->description = $fDescription;
                                            $a->updateMountaineering();
                                        }
                                        ?>
                                    </div>
                                </div> 
                            </div>

                        </div>
                    </div>

                    <!-- service -->
                    <div class="tab-pane fade" id="service">
                        <div class="container text-dark pb-5">
                            <div class="tab-content">

                                <!-- form Add service -->
                                <div class="tab-pane fade show active text-dark" id="addservice">
                                    <div class="pt-5 pb-5 d-flex justify-content-center">
                                        <div style="width: 650px;">
                                            <div class="text-center pb-3">
                                                <h2>Add Service</h2>
                                            </div>
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">ServiceName:</label>
                                                    <input required type="text" id="ServiceName" name="fServiceName" class="form-control" placeholder="ServiceName" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">AvatarService:</label>
                                                    <input required type="file" id="AvatarService" name="fAvatarService" class="form-control" placeholder="AvatarService" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Price:</label>
                                                    <div class="input-group">
                                                        <input required type="text" id="Price" name="fPrice" class="form-control" placeholder="Price" />
                                                        <span class="input-group-text">USD</span>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">TNTT(tax):</label>
                                                    <div class="input-group">
                                                        <input required type="text" id="VAT" name="fVAT" class="form-control" placeholder="VAT" value="10"/>
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Sale on service:</label>
                                                    <div class="input-group">
                                                        <input required type="text" id="Sale" name="fSale" class="form-control" placeholder="Sale" />
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Description:</label>
                                                    <input type="text" id="Description" name="fDescription" class="form-control" placeholder="Description" />
                                                </div>
                                                <input type="submit" id="btnservice" name="fservice" class="btn btn-primary" value="Save" />
                                            </form>
                                            <?php
                                            $message = "";

                                            if (isset($_POST['fservice']) && $_POST['fservice'] == 'Save') {
                                                if (isset($_FILES['fAvatarService']) && $_FILES['fAvatarService']['error'] === UPLOAD_ERR_OK) {
                                                    // lưu vào thư mục tạm webserver
                                                    $fileTmpPath = $_FILES['fAvatarService']['tmp_name'];
                                                    // echo $fileTmpPath;

                                                    // thông tin file
                                                    $fileName = $_FILES['fAvatarService']['name'];
                                                    $fileSize = $_FILES['fAvatarService']['size'];
                                                    $fileType = $_FILES['fAvatarService']['type'];

                                                    // lấy tên file và đuôi file
                                                    $fileNameCmps = explode(".", $fileName);

                                                    // chuẩn hóa lại tên file
                                                    $fileExtension = strtolower(end($fileNameCmps));

                                                    // thiết đặt filename để k bị trùng nhau
                                                    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

                                                    // kiem tra phan mo rong cua file
                                                    $allowedfileExtensions = ['jpg', 'gif', 'png'];

                                                    // kiểm tra đuôi file
                                                    if (in_array($fileExtension, $allowedfileExtensions)) {
                                                        // thu muc file uploaded
                                                        $uploadFileDir = '../admin/assets/img/Service/';
                                                        $dest_path = $uploadFileDir . $newFileName;

                                                        if (move_uploaded_file($fileTmpPath, $dest_path)) {
                                                            $message = "";
                                                        } else {
                                                            $message = 'Check if the directory has write permissions.';
                                                        }
                                                    } else {
                                                        $message = 'Only file types allowed: ' . implode(',', $allowedfileExtensions);
                                                    }
                                                }
                                            }

                                            echo $message;
                                            if (isset($_POST["fservice"])) {
                                                $fServiceName = $_POST["fServiceName"];
                                                $fPrice = $_POST["fPrice"];
                                                $fVAT = $_POST["fVAT"];
                                                $fSale = $_POST["fSale"];
                                                $fDescription = $_POST["fDescription"];

                                                $a = new Service();
                                                $a->serviceName = $fServiceName;
                                                $a->avatarService = $uploadFileDir . $newFileName;
                                                $a->price = $fPrice;
                                                $a->vAT = $fVAT;
                                                $a->sale = $fSale;
                                                $a->description = $fDescription;
                                                $a->addService();
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- table list service -->
                                <div class="tab-pane fade show active text-dark" id="listservice">
                                    <div class="pt-5 pb-5">
                                        <div class="text-center">
                                            <h2>List Service</h2>
                                        </div>
                                        <div class="pb-5">
                                            <div style="overflow-x: auto;">
                                                
                                                <div id="tbl-kithi" class="mt-4 pb-5">
                                                    <table class="table table-striped table-hover">
                                                        <tr>
                                                            <th scope="col">STT</th>
                                                            <th scope="col">ID</th>
                                                            <th scope="col">ServiceName</th>
                                                            <th scope="col">AvatarService</th>
                                                            <th scope="col">Price</th>
                                                            <th scope="col">TNTT(tax)</th>
                                                            <th scope="col">Sale</th>
                                                            <th scope="col">Description</th>
                                                            <th class="text-center" scope="col">Action</th>
                                                        </tr>
                                                        <?php
                                                        $a = new Service();
                                                        $arr = $a->getListService();
                                                        $strTbl = "";

                                                        $stt = 1;

                                                        for ($i = 0; $i < count($arr); $i++) {
                                                            $obj = $arr[$i];

                                                            $strTbl .= "<tr>";
                                                            $strTbl .= "<th>" . $stt++ . "</th>";
                                                            $strTbl .= "<td id='serviceID'>$obj->serviceID</td>";
                                                            $strTbl .= "<td id='serviceName'>$obj->serviceName</td>";
                                                            $strTbl .= "<td><img src='$obj->avatarService' alt='banner' width='200' height='100'></td>";
                                                            $strTbl .= "<td>$obj->price USD</td>";
                                                            $strTbl .= "<td>$obj->vAT %</td>";
                                                            $strTbl .= "<td>$obj->sale %</td>";
                                                            $strTbl .= "<td id='description'>$obj->description</td>";
                                                            $strTbl .= "<td>
                                                                                <div class='d-flex justify-content-center'>
                                                                                    <form class='m-1' action='' method='POST'>
                                                                                        <input type='hidden' name='fserviceID' value='$obj->serviceID'/>
                                                                                        <input type='hidden' name='fvalDel' value='d'/>
                                                                                        <input type='submit' class='btn btn-danger' name='fdelete' value='Delete'>
                                                                                    </form>
                                                                                    <input type='submit' class='btn btn-primary m-1' name='feditService' value='Edit'>
                                                                                </div>    
                                                                            </td>";

                                                            // trường ẩn để lấy value edit
                                                            $strTbl .= "<td class='d-none' id='price'>$obj->price</td>";
                                                            $strTbl .= "<td class='d-none' id='vAT'>$obj->vAT</td>";
                                                            $strTbl .= "<td class='d-none' id='sale'>$obj->sale</td>";

                                                            $strTbl .= "</tr>";

                                                        }

                                                        echo $strTbl;

                                                        //delete => update
                                                        if (isset($_POST["fdelete"])) {
                                                            $fserviceID = $_POST["fserviceID"];
                                                            $fvalDel = $_POST["fvalDel"];

                                                            $a = new Service();
                                                            $a->flag = $fvalDel;
                                                            $a->serviceID = $fserviceID;
                                                            $a->updateListService();
                                                        }
                                                        ?>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                            </div>

                            <!-- edit list service -->
                            <div id="editService" class="d-none">
                                <div class="pb-5 d-flex justify-content-center text-dark">
                                    <div style="width: 650px;">
                                        <div class="text-center pb-3">
                                            <h2>Edit</h2>
                                        </div>
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="fserviceID">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">ServiceName:</label>
                                                <input type="text" id="ServiceName" name="fServiceName" class="form-control" placeholder="ServiceName" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">Price:</label>
                                                <div class="input-group">
                                                    <input type="text" id="Price" name="fPrice" class="form-control" placeholder="Price" />
                                                    <span class="input-group-text">USD</span>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">TNTT(tax):</label>
                                                <div class="input-group">
                                                    <input type="text" id="VAT" name="fVAT" class="form-control" placeholder="VAT" value="10"/>
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">Sale on service:</label>
                                                <div class="input-group">
                                                    <input type="text" id="Sale" name="fSale" class="form-control" placeholder="Sale" />
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">Description:</label>
                                                <input type="text" id="Description" name="fDescription" class="form-control" placeholder="Description" />
                                            </div>
                                            <input type="submit" id="btnservice" name="fserviceEdit" class="btn btn-primary" value="Save" />
                                            <div class="mb-3">
                                                <i class="text-warning bi bi-exclamation-triangle pe-1"></i><span class="text-danger">If you need to fix other fields, please contact admin for support: <a href="mailto:nduydu66@gmail.com">nduydu66@gmail.com</a></span>
                                            </div>
                                        </form>
                                        <?php
                                        
                                        if (isset($_POST["fserviceEdit"])) {
                                            $fserviceID = $_POST["fserviceID"];
                                            $fServiceName = $_POST["fServiceName"];
                                            $fPrice = $_POST["fPrice"];
                                            $fVAT = $_POST["fVAT"];
                                            $fSale = $_POST["fSale"];
                                            $fDescription = $_POST["fDescription"];

                                            $a = new Service();
                                            $a->serviceID = $fserviceID;
                                            $a->serviceName = $fServiceName;
                                            $a->price = $fPrice;
                                            $a->vAT = $fVAT;
                                            $a->sale = $fSale;
                                            $a->description = $fDescription;
                                            $a->updateService();
                                        }
                                        ?>
                                    </div>
                                </div> 
                            </div>                    

                        </div>
                    </div>

                    <!-- News -->
                    <div class="tab-pane fade" id="news">
                        <div class="container text-dark pb-5">
                            <div class="tab-content">

                                <!-- form Add News -->
                                <div class="tab-pane fade show active text-dark" id="addNews">
                                    <div class="pt-5 pb-5 d-flex justify-content-center">
                                        <div style="width: 650px;">
                                            <div class="text-center pb-3">
                                                <h2>Add News</h2>
                                            </div>
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Title:</label>
                                                    <input required type="text" id="Title" name="fTitle" class="form-control" placeholder="Title" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Lead:</label>
                                                    <input required type="text" id="Lead" name="fLead" class="form-control" placeholder="Lead" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Category:</label>
                                                    <select required class="form-select" name="fCategory" id="CategoryID">
                                                        <?php
                                                        $a = new Category();
                                                        $arr = $a->getListCategory();
                                                        for($i = 0; $i < count($arr); $i++) {
                                                            $obj = $arr[$i];
                                                            echo "<option value='$obj->CategoryID'>$obj->CategoryName</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Content:</label>
                                                    <textarea required name="fContent" id="editor1" rows="10" cols="80" class="form-control">Content here...</textarea>
                                                </div> 
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">AvatarNews:</label>
                                                    <input required type="file" id="AvatarNews" name="fAvatarNews" class="form-control" placeholder="AvatarNews" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Author:</label>
                                                    <input required type="text" id="Author" name="fAuthor" class="form-control" placeholder="Author" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Description:</label>
                                                    <input type="text" id="Description" name="fDescription" class="form-control" placeholder="Description" />
                                                </div>
                                                <input type="submit" id="btnnews" name="fnews" class="btn btn-primary" value="Save" />
                                            </form>
                                            <?php
                                            $message = "";

                                            if (isset($_POST['fnews']) && $_POST['fnews'] == 'Save') {
                                                if (isset($_FILES['fAvatarNews']) && $_FILES['fAvatarNews']['error'] === UPLOAD_ERR_OK) {
                                                    // lưu vào thư mục tạm webserver
                                                    $fileTmpPath = $_FILES['fAvatarNews']['tmp_name'];
                                                    // echo $fileTmpPath;

                                                    // thông tin file
                                                    $fileName = $_FILES['fAvatarNews']['name'];
                                                    $fileSize = $_FILES['fAvatarNews']['size'];
                                                    $fileType = $_FILES['fAvatarNews']['type'];

                                                    // lấy tên file và đuôi file
                                                    $fileNameCmps = explode(".", $fileName);

                                                    // chuẩn hóa lại tên file
                                                    $fileExtension = strtolower(end($fileNameCmps));

                                                    // thiết đặt filename để k bị trùng nhau
                                                    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

                                                    // kiem tra phan mo rong cua file
                                                    $allowedfileExtensions = ['jpg', 'gif', 'png'];

                                                    // kiểm tra đuôi file
                                                    if (in_array($fileExtension, $allowedfileExtensions)) {
                                                        // thu muc file uploaded
                                                        $uploadFileDir = '../admin/assets/img/News/';
                                                        $dest_path = $uploadFileDir . $newFileName;

                                                        if (move_uploaded_file($fileTmpPath, $dest_path)) {
                                                            $message = "";
                                                        } else {
                                                            $message = 'Check if the directory has write permissions.';
                                                        }
                                                    } else {
                                                        $message = 'Only file types allowed: ' . implode(',', $allowedfileExtensions);
                                                    }
                                                }
                                            }

                                            echo $message;

                                            if (isset($_POST["fnews"])) {
                                                $fTitle = $_POST["fTitle"];
                                                $fLead = $_POST["fLead"];
                                                $fCategory = $_POST["fCategory"];
                                                $fContent = $_POST["fContent"];
                                                // $fAvatarNews = $_POST["fAvatarNews"];
                                                $fAuthor = $_POST["fAuthor"];
                                                $fDescription = $_POST["fDescription"];

                                                $a = new News();
                                                $a->title = $fTitle;
                                                $a->leadcontent = $fLead;
                                                $a->categoryID = $fCategory;
                                                $a->content = $fContent;
                                                $a->avatarNews = $uploadFileDir . $newFileName;
                                                $a->author = $fAuthor;
                                                $a->description = $fDescription;
                                                $a->addNews();
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- table list News -->
                                <div class="tab-pane fade show active text-dark" id="listNews">
                                    <div class="pt-5 pb-5">
                                        <div class="text-center">
                                            <h2>List News</h2>
                                        </div>
                                        <div class="pb-5">
                                            <div style="overflow-x: auto;">

                                                <div id="tbl-kithi" class="mt-4 pb-5" >
                                                    <table class="table table-striped table-hover">
                                                        <tr>
                                                            <th scope="col">STT</th>
                                                            <th scope="col">ID</th>
                                                            <th scope="col">Category</th>
                                                            <th scope="col">Title</th>
                                                            <th scope="col">LeadContent</th>
                                                            <th scope="col">Content</th>
                                                            <th scope="col">AvatarNews</th>
                                                            <th scope="col">Author</th>
                                                            <th scope="col">Description</th>
                                                            <th class="text-center" scope="col">Action</th>
                                                        </tr>
                                                        <?php
                                                        $a = new News();
                                                        $arr = $a->getListNewsTbl();
                                                        $strTbl = "";

                                                        $stt = 1;

                                                        for ($i = 0; $i < count($arr); $i++) {
                                                            $obj = $arr[$i];

                                                            $strTbl .= "<tr>";
                                                            $strTbl .= "<th>" . $stt++ . "</th>";
                                                            $strTbl .= "<td id='newsID'>$obj->newsID</td>";
                                                            $strTbl .= "<td>$obj->CategoryName</td>";
                                                            $strTbl .= "<td id='title'>$obj->title</td>";
                                                            $strTbl .= "<td id='leadcontent'>$obj->leadcontent</td>";
                                                            $strTbl .= "<td>$obj->content</td>";
                                                            $strTbl .= "<td><img src='$obj->avatarNews' alt='AvatarNews' width='200' height='100'></td>";
                                                            $strTbl .= "<td id='author'>$obj->author</td>";
                                                            $strTbl .= "<td id='description'>$obj->description</td>";
                                                            $strTbl .= "<td>
                                                                                <div class='d-flex'>
                                                                                    <form class='m-1' action='' method='POST'>
                                                                                        <input type='hidden' name='fnewsID' value='$obj->newsID'/>
                                                                                        <input type='hidden' name='fvalDel' value='d'/>
                                                                                        <input type='submit' class='btn btn-danger' name='fdelete' value='Delete'>
                                                                                    </form>
                                                                                    <input type='submit' class='btn btn-primary m-1' name='feditNews' value='Edit'>
                                                                                </div>    
                                                                            </td>";
                                                            $strTbl .= "</tr>";
                                                        }

                                                        echo $strTbl;

                                                        //delete => update
                                                        if (isset($_POST["fdelete"])) {
                                                            $fnewsID = $_POST["fnewsID"];
                                                            $fvalDel = $_POST["fvalDel"];

                                                            $a = new News();
                                                            $a->flag = $fvalDel;
                                                            $a->newsID = $fnewsID;
                                                            $a->updateListNews();
                                                        }
                                                        ?>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- edit list News -->
                            <div id="editNews" class="d-none">
                                <div class="pb-5 d-flex justify-content-center">
                                    <div style="width: 650px;">
                                        <div class="text-center pb-3">
                                            <h2>Edit</h2>
                                        </div>
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="fnewsID">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">Title:</label>
                                                <input type="text" id="Title" name="fTitle" class="form-control" placeholder="Title" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">Lead:</label>
                                                <input type="text" id="Lead" name="fLead" class="form-control" placeholder="Lead" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">Author:</label>
                                                <input type="text" id="Author" name="fAuthor" class="form-control" placeholder="Author" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">Description:</label>
                                                <input type="text" id="Description" name="fDescription" class="form-control" placeholder="Description" />
                                            </div>
                                            <input type="submit" id="btnnews" name="fnewsEdit" class="btn btn-primary" value="Save" />
                                            <div class="mb-3">
                                                <i class="text-warning bi bi-exclamation-triangle pe-1"></i><span class="text-danger">If you need to fix other fields, please contact admin for support: <a href="mailto:nduydu66@gmail.com">nduydu66@gmail.com</a></span>
                                            </div>
                                        </form>
                                        <?php
                                        
                                        if (isset($_POST["fnewsEdit"])) {
                                            $fnewsID = $_POST["fnewsID"];
                                            $fTitle = $_POST["fTitle"];
                                            $fLead = $_POST["fLead"];
                                            $fAuthor = $_POST["fAuthor"];
                                            $fDescription = $_POST["fDescription"];

                                            $a = new News();
                                            $a->newsID = $fnewsID;
                                            $a->title = $fTitle;
                                            $a->leadcontent = $fLead;
                                            $a->author = $fAuthor;
                                            $a->description = $fDescription;
                                            $a->updateNews();
                                        }
                                        ?>
                                    </div>
                                </div> 
                            </div>      

                        </div>
                    </div>

                    <!-- library -->
                    <div class="tab-pane fade" id="library">
                        <div class="container text-dark pb-5">
                            <div class="tab-content">

                                <!-- form Add library -->
                                <div class="tab-pane fade show active text-dark" id="addlibrary">
                                    <div class="pt-5 pb-5 d-flex justify-content-center">
                                        <div style="width: 650px;">
                                            <div class="text-center pb-3">
                                                <h2>Add Library</h2>
                                            </div>
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">LibraryName:</label>
                                                    <input required type="text" id="LibraryName" name="fLibraryName" class="form-control" placeholder="LibraryName" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Description:</label>
                                                    <input type="text" id="Description" name="fDescription" class="form-control" placeholder="Description" />
                                                </div>
                                                <input type="submit" id="btnlibrary" name="flibrary" class="btn btn-primary" value="Save" />
                                            </form>
                                            <?php if (isset($_POST["flibrary"])) {
                                                $fLibraryName = $_POST["fLibraryName"];
                                                $fDescription = $_POST["fDescription"];

                                                $a = new Library();
                                                $a->libraryName = $fLibraryName;
                                                $a->description = $fDescription;
                                                $a->addLibrary();
                                            } ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- table list library -->
                                <div class="tab-pane fade show active text-dark" id="listlibrary">
                                    <div class="pt-5 pb-5">
                                        <div class="text-center">
                                            <h2>List Library</h2>
                                        </div>
                                        <div class="pb-5">
                                            <div style="overflow-x: auto;">

                                                <div id="tbl-kithi" class="mt-4 pb-5" >
                                                    <table class="table table-striped table-hover">
                                                        <tr>
                                                            <th scope="col">STT</th>
                                                            <th scope="col">ID</th>
                                                            <th scope="col">LibraryName</th>
                                                            <th scope="col">Description</th>
                                                            <th class='text-center' scope="col">Action</th>
                                                            <th class='text-center' scope="col">Del - Edit</th>
                                                        </tr>
                                                        <?php
                                                        $a = new Library();
                                                        $arr = $a->getListLibrary();
                                                        $strTbl = "";

                                                        $stt = 1;

                                                        for ($i = 0; $i < count($arr); $i++) {
                                                            $obj = $arr[$i];

                                                            $strTbl .= "<tr>";
                                                            $strTbl .= "<th>" . $stt++ . "</th>";
                                                            $strTbl .= "<td id='libraryID'>$obj->libraryID</td>";
                                                            $strTbl .= "<td id='libraryName'>$obj->libraryName</td>";
                                                            $strTbl .= "<td id='description'>$obj->description</td>";
                                                            $strTbl .= "<td class='text-center'>
                                                                            <div class='nav d-block' id='myTab'>
                                                                                <button class='btn btn-primary' data-bs-target='#add-img' data-bs-toggle='tab' name='additemlibrary' aria-selected='false'>Add image</button>
                                                                                <button class='btn btn-primary' data-bs-target='#add-video' data-bs-toggle='tab' name='additemlibrary' aria-selected='false'>Add video</button>
                                                                            </div>
                                                                            </td>";
                                                            $strTbl .= "<td>
                                                                                <div class='d-flex justify-content-center'>
                                                                                    <form class='m-1' action='' method='POST'>
                                                                                        <input type='hidden' name='flibraryID' value='$obj->libraryID'/>
                                                                                        <input type='hidden' name='fvalDel' value='d'/>
                                                                                        <input type='submit' class='btn btn-danger' name='fdelete' value='Delete'>
                                                                                    </form>
                                                                                    <input type='submit' class='btn btn-primary m-1' name='feditLibraryID' value='Edit'>
                                                                                </div>    
                                                                            </td>";
                                                            $strTbl .= "</tr>";
                                                        }

                                                        echo $strTbl;

                                                        //delete => update
                                                        if (isset($_POST["fdelete"])) {
                                                            $flibraryID = $_POST["flibraryID"];
                                                            $fvalDel = $_POST["fvalDel"];

                                                            $a = new Library();
                                                            $a->flag = $fvalDel;
                                                            $a->libraryID = $flibraryID;
                                                            $a->updateListLibrary();
                                                        }
                                                        ?>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- 2 tab add img and video -->
                            <div class="tab-content" id="nav-tabContent">
                                <!-- add img -->
                                <div class="tab-pane fade" id="add-img" role="tabpanel">
                                    <div class="container text-dark pb-5">
                                        <div class="p-2 d-flex justify-content-center">
                                            <div style="width: 650px;">
                                                <div class="text-center pb-3">
                                                    <h2>Add</h2>
                                                </div>
                                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold text-secondary">Type:</label>
                                                        <select class="form-select" id="Type" name="fType">
                                                            <option value="1">Image</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold text-secondary">Title:</label>
                                                        <input type="text" id="title" name="ftitle" class="form-control" placeholder="Title"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold text-secondary">Upload img:</label>
                                                        <input type="file" id="File" name="fFile" class="form-control"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <?php
                                                        $a = new Library();
                                                        $arr = $a->getListLibrary();
                                                        for($i = 0; $i < count($arr); $i++) {
                                                            $obj = $arr[$i];
                                                            echo "<input type='hidden' value='$obj->libraryID' name='fLibraryID'/>";
                                                        }
                                                        ?>
                                                        
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold text-secondary">Alt:</label>
                                                        <input type="text" id="Alt" name="fAlt" class="form-control" placeholder="Alt" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold text-secondary">Description:</label>
                                                        <input type="text" id="Description" name="fDescription" class="form-control" placeholder="Description" />
                                                    </div>
                                                    <input type="submit" id="btnitemlibrary" name="fitemlibraryimg" class="btn btn-primary" value="Save" />
                                                </form>
                                                <?php
                                                $message = "";

                                                if (isset($_POST['fitemlibraryimg']) && $_POST['fitemlibraryimg'] == 'Save') {
                                                    if (isset($_FILES['fFile']) && $_FILES['fFile']['error'] === UPLOAD_ERR_OK) {
                                                        // lưu vào thư mục tạm webserver
                                                        $fileTmpPath = $_FILES['fFile']['tmp_name'];
                                                        // echo $fileTmpPath;
    
                                                        // thông tin file
                                                        $fileName = $_FILES['fFile']['name'];
                                                        $fileSize = $_FILES['fFile']['size'];
                                                        $fileType = $_FILES['fFile']['type'];
    
                                                        // lấy tên file và đuôi file
                                                        $fileNameCmps = explode(".", $fileName);
    
                                                        // chuẩn hóa lại tên file
                                                        $fileExtension = strtolower(end($fileNameCmps));
    
                                                        // thiết đặt filename để k bị trùng nhau
                                                        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    
                                                        // kiem tra phan mo rong cua file
                                                        $allowedfileExtensions = ['jpg', 'gif', 'png'];
    
                                                        // kiểm tra đuôi file
                                                        if (in_array($fileExtension, $allowedfileExtensions)) {
                                                            // thu muc file uploaded
                                                            $uploadFileDir = '../admin/assets/img/ItemLibrary/';
                                                            $dest_path = $uploadFileDir . $newFileName;
    
                                                            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                                                                $message = "";
                                                            } else {
                                                                $message = 'Check if the directory has write permissions.';
                                                            }
                                                        } else {
                                                            $message = 'Only file types allowed: ' . implode(',', $allowedfileExtensions);
                                                        }
                                                    }
                                                }
    
                                                echo $message;

                                                if (isset($_POST["fitemlibraryimg"])) {
                                                    $fType = $_POST["fType"];
                                                    $ftitle = $_POST["ftitle"];
                                                    // $fFile = $_POST["fFile"];
                                                    $fLibraryID = $_POST["fLibraryID"];
                                                    $fAlt = $_POST["fAlt"];
                                                    $fDescription = $_POST["fDescription"];

                                                    $a = new Itemlibrary();
                                                    $a->type = $fType;
                                                    $a->title = $ftitle;
                                                    $a->file = $uploadFileDir.$newFileName;
                                                    $a->libraryID = $fLibraryID;
                                                    $a->alt = $fAlt;
                                                    $a->description = $fDescription;
                                                    $a->addImglibrary();
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- add video -->
                                <div class="tab-pane fade" id="add-video" role="tabpanel">
                                    <div class="container text-dark pb-5">
                                        <div class="p-2 d-flex justify-content-center">
                                            <div style="width: 650px;">
                                                <div class="text-center pb-3">
                                                    <h2>Add</h2>
                                                </div>
                                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold text-secondary">Type:</label>
                                                        <select class="form-select" id="Type" name="fType">
                                                            <option value="2">Video</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <?php
                                                        require_once '../PhpSetting/Library.php';
                                                        $a = new Library();
                                                        $arr = $a->getListLibrary();
                                                        for($i = 0; $i < count($arr); $i++) {
                                                            $obj = $arr[$i];
                                                            echo "<input type='hidden' value='$obj->libraryID' name='fLibraryID'/>";
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold text-secondary">Title:</label>
                                                        <input type="text" id="title" name="ftitle" class="form-control" placeholder="Title"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold text-secondary">Id youtube:</label>
                                                        <input type="text" id="Alt" name="fFile" class="form-control" placeholder="id video youtube" />
                                                        Demo: <span class="text-primary">https://www.youtube.com/watch?v=<span class="text-danger">sGxw7ipTrq8 </span></span><= id color red
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold text-secondary">Description:</label>
                                                        <input type="text" id="Description" name="fDescription" class="form-control" placeholder="Description" />
                                                    </div>
                                                    <input type="submit" id="btnitemlibrary" name="fitemlibraryvideo" class="btn btn-primary" value="Save" />
                                                </form>
                                                <?php if (isset($_POST["fitemlibraryvideo"])) {
                                                    $fType = $_POST["fType"];
                                                    $fLibraryID = $_POST["fLibraryID"];
                                                    $fFile = $_POST["fFile"];
                                                    $ftitle = $_POST["ftitle"];
                                                    $fDescription = $_POST["fDescription"];

                                                    $a = new Itemlibrary();
                                                    $a->type = $fType;
                                                    $a->libraryID = $fLibraryID;
                                                    $a->file = $fFile;
                                                    $a->title = $ftitle;
                                                    $a->description = $fDescription;
                                                    $a->addVideolibrary();
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- edit list library -->
                            <div id="editlibrary" class="d-none">
                                <div class="pb-5 d-flex justify-content-center">
                                    <div style="width: 650px;">
                                        <div class="text-center pb-3">
                                            <h2>Edit</h2>
                                        </div>
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                            <input type="hidden" name="fLibraryID">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">LibraryName:</label>
                                                <input type="text" id="LibraryName" name="fLibraryName" class="form-control" placeholder="LibraryName" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">Description:</label>
                                                <input type="text" id="Description" name="fDescription" class="form-control" placeholder="Description" />
                                            </div>
                                            <input type="submit" id="btnlibrary" name="flibraryEdit" class="btn btn-primary" value="Save" />
                                            <div class="mb-3">
                                                <i class="text-warning bi bi-exclamation-triangle pe-1"></i><span class="text-danger">If you need to fix other fields, please contact admin for support: <a href="mailto:nduydu66@gmail.com">nduydu66@gmail.com</a></span>
                                            </div>
                                        </form>
                                        <?php
                                        
                                        if (isset($_POST["flibraryEdit"])) {
                                            $fLibraryID = $_POST["fLibraryID"];
                                            $fLibraryName = $_POST["fLibraryName"];
                                            $fDescription = $_POST["fDescription"];

                                            $a = new Library();
                                            $a->libraryID = $fLibraryID;
                                            $a->libraryName = $fLibraryName;
                                            $a->description = $fDescription;
                                            $a->updateLibrary();
                                        }
                                        ?>
                                    </div>
                                </div> 
                            </div>  
                        </div>
                    </div>

                    <!-- itemlibrary -->
                    <div class="tab-pane fade" id="itemlibrary">
                        <div class="container text-dark pb-5">
                            <div class="tab-content">
                                
                                <!-- form Add Itemlibrary -->
                                <div class="tab-pane fade show active text-dark" id="addItemlibrary">
                                    <div class="pt-5 pb-5 d-flex justify-content-center">
                                        <div style="width: 650px;">
                                            <div class="text-center pb-3">
                                                <h2>Add Itemlibrary</h2>
                                            </div>
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Type:</label>
                                                    <select required class="form-select" id="ValueType" name="fType" onchange="showByType(this.value);">
                                                        <option value="0" selected>Select</option>
                                                        <option value="1">Image</option>
                                                        <option value="2">Video</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Library:</label>
                                                    <select required class="form-select" id="LibraryID" name="fLibraryID">
                                                        <option value="0">Select</option>
                                                        <?php
                                                        $a = new Library();
                                                        $arr = $a->getListLibrary();
                                                        
                                                        for ($i = 0; $i < count($arr); $i++) {
                                                            $obj = $arr[$i];
                                                            
                                                            echo "<option value='$obj->libraryID'>" . $obj->libraryName . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Title:</label>
                                                    <input required type="text" id="Title" name="fTitle" class="form-control" placeholder="Title" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Description:</label>
                                                    <input type="text" id="Description" name="fDescription" class="form-control" placeholder="Description" />
                                                </div>
                                                <div id="hintitemlibraryitem"></div>
                                            </form>
                                            <?php
                                            // add img
                                            $message = "";
                                            if (isset($_POST['fitemimg']) && $_POST['fitemimg'] == 'Save') {
                                                if (isset($_FILES['fUpload']) && $_FILES['fUpload']['error'] === UPLOAD_ERR_OK) {
                                                    // lưu vào thư mục tạm webserver
                                                    $fileTmpPath = $_FILES['fUpload']['tmp_name'];
                                                    // echo $fileTmpPath;

                                                    // thông tin file
                                                    $fileName = $_FILES['fUpload']['name'];
                                                    $fileSize = $_FILES['fUpload']['size'];
                                                    $fileType = $_FILES['fUpload']['type'];

                                                    // lấy tên file và đuôi file
                                                    $fileNameCmps = explode(".", $fileName);

                                                    // chuẩn hóa lại tên file
                                                    $fileExtension = strtolower(end($fileNameCmps));

                                                    // thiết đặt filename để k bị trùng nhau
                                                    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

                                                    // kiem tra phan mo rong cua file
                                                    $allowedfileExtensions = ['jpg', 'gif', 'png'];

                                                    // kiểm tra đuôi file
                                                    if (in_array($fileExtension, $allowedfileExtensions)) {
                                                        // thu muc file uploaded
                                                        $uploadFileDir = '../admin/assets/img/ItemLibrary/';
                                                        $dest_path = $uploadFileDir . $newFileName;

                                                        if (move_uploaded_file($fileTmpPath, $dest_path)) {
                                                            $message = "";
                                                        } else {
                                                            $message = 'Check if the directory has write permissions.';
                                                        }
                                                    } else {
                                                        $message = 'Only file types allowed: ' . implode(',', $allowedfileExtensions);
                                                    }
                                                }
                                            }
                                            echo $message;
                                            if (isset($_POST["fitemimg"])) {
                                                $fType = $_POST["fType"];
                                                $fLibraryID = $_POST["fLibraryID"];
                                                $fTitle = $_POST["fTitle"];
                                                // $fFile = $_POST["fFile"];
                                                $fDescription = $_POST["fDescription"];
                                                $fAlt = $_POST["fAlt"];

                                                $a = new Itemlibrary();
                                                $a->type = $fType;
                                                $a->libraryID = $fLibraryID;
                                                $a->title = $fTitle;
                                                $a->description = $fDescription;
                                                $a->alt = $fAlt;
                                                $a->file = $dest_path;
                                                $a->addImglibrary();
                                            }


                                            // add video
                                            if (isset($_POST["fitemvideo"])) {
                                                $fType = $_POST["fType"];
                                                $fLibraryID = $_POST["fLibraryID"];
                                                $fTitle = $_POST["fTitle"];
                                                $fFile = $_POST["fFile"];
                                                $fDescription = $_POST["fDescription"];

                                                $a = new Itemlibrary();
                                                $a->type = $fType;
                                                $a->libraryID = $fLibraryID;
                                                $a->title = $fTitle;
                                                $a->file = $fFile;
                                                $a->description = $fDescription;
                                                $a->addVideolibrary();
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- table list Itemlibrary -->
                                <div class="tab-pane fade show active text-dark" id="listItemlibrary">
                                    <div class="pt-5 pb-5">
                                        <div class="text-center">
                                            <h2>List Itemlibrary</h2>
                                        </div>
                                        <div class="pb-5">
                                            <div style="overflow-x: auto;">

                                                <div id="tbl-kithi" class="mt-4 pb-5" >
                                                    <table class="table table-striped table-hover">
                                                        <tr>
                                                            <th scope="col">STT</th>
                                                            <th scope="col">ID</th>
                                                            <th scope="col">Type</th>
                                                            <th scope="col">LibraryID</th>
                                                            <th scope="col">Title</th>
                                                            <th scope="col">Alt</th>
                                                            <th scope="col">File</th>
                                                            <th scope="col">Description</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                        <?php
                                                        $a = new Itemlibrary();
                                                        $arr = $a->getListItemLibrary();
                                                        $strTbl = "";

                                                        $stt = 1;

                                                        for ($i = 0; $i < count($arr); $i++) {
                                                            $obj = $arr[$i];

                                                            $strTbl .= "<tr>";
                                                            $strTbl .= "<th>" . $stt++ . "</th>";
                                                            $strTbl .= "<td id='itemLibraryID'>$obj->itemLibraryID</td>";
                                                            $strTbl .= "<td>$obj->type</td>";
                                                            $strTbl .= "<td>$obj->LibraryName</td>";
                                                            $strTbl .= "<td id='title'>$obj->title</td>";
                                                            $strTbl .= "<td id='alt'>$obj->alt</td>";
                                                            if($obj->type == "Image") {
                                                                $strTbl .= "<td>
                                                                            <img src='$obj->file' alt='$obj->alt' width='200' height='100'>
                                                                        </td>";
                                                            } else {
                                                                $strTbl .= "<td>
                                                                                <iframe style='padding-top: 5%;' src='https://www.youtube.com/embed/$obj->file' title='$obj->title'></iframe>
                                                                            </td>";
                                                            }
                                                            $strTbl .= "<td id='description'>$obj->description</td>";
                                                            $strTbl .= "<td>";
                                                            $strTbl .=      "<div class='d-flex'>
                                                                                <form class='m-1' action='' method='POST'>
                                                                                    <input type='hidden' name='fitemLibraryID' value='$obj->itemLibraryID'/>
                                                                                    <input type='hidden' name='fvalDel' value='d'/>
                                                                                    <input type='submit' class='btn btn-danger' name='fdelete' value='Delete'>
                                                                                </form>";
                                                            if ($obj->type == "Image" ){
                                                                $strTbl .= "<button class='btn btn-primary m-1' name='feditimglibrary' onclick='showByTypeEdit(this.value)' value='1'>Edit</button>";
                                                            } else {
                                                                $strTbl .= "<button class='btn btn-primary m-1' name='feditvideolibrary' onclick='showByTypeEdit(this.value)' value='2'>Edit</button>";
                                                            }
                                                            $strTbl .=      "</div>"; 
                                                            $strTbl .= "</td>";

                                                            // các trường ẩn lấy vào form edit
                                                            $strTbl .= "<td class='d-none' id='file'>$obj->file</td>";

                                                            $strTbl .= "</tr>";

                                                        }

                                                        echo $strTbl;

                                                        //delete => update
                                                        if (isset($_POST["fdelete"])) {
                                                            $fitemLibraryID = $_POST["fitemLibraryID"];
                                                            $fvalDel = $_POST["fvalDel"];

                                                            $a = new Itemlibrary();
                                                            $a->flag = $fvalDel;
                                                            $a->itemLibraryID = $fitemLibraryID;
                                                            $a->updateListItemlibrary();
                                                        }
                                                        ?>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- edit list Itemlibrary -->
                            <div class="editItemlibrary d-none">
                                <div class="pb-5 d-flex justify-content-center">
                                    <div style="width: 650px;">
                                        <div class="text-center pb-3">
                                            <h2>Edit</h2>
                                        </div>
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="fItemlibraryID">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">Title:</label>
                                                <input type="text" id="Title" name="fTitle" class="form-control" placeholder="Title" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">Description:</label>
                                                <input type="text" id="Description" name="fDescription" class="form-control" placeholder="Description" />
                                            </div>
                                            <div id="hintedititem"></div>
                                        </form>
                                        <?php
                                        // edit img
                                        if (isset($_POST["fitemimgEdit"])) {
                                            $fItemlibraryID = $_POST["fItemlibraryID"];
                                            $fTitle = $_POST["fTitle"];
                                            $fDescription = $_POST["fDescription"];
                                            $fAlt = $_POST["fAlt"];

                                            $a = new Itemlibrary();
                                            $a->itemLibraryID = $fItemlibraryID;
                                            $a->title = $fTitle;
                                            $a->description = $fDescription;
                                            $a->alt = $fAlt;
                                            $a->updateImageItemlibrary();
                                        }

                                        // edit video
                                        if (isset($_POST["fitemvideoEdit"])) {
                                            $fItemlibraryID = $_POST["fItemlibraryID"];
                                            $fTitle = $_POST["fTitle"];
                                            $fFile = $_POST["fFileEdit"];
                                            $fDescription = $_POST["fDescription"];

                                            $a = new Itemlibrary();
                                            $a->itemLibraryID = $fItemlibraryID;
                                            $a->title = $fTitle;
                                            $a->file = $fFile;
                                            $a->description = $fDescription;
                                            $a->updateVideoItemlibrary();
                                        }
                                        ?>
                                    </div>
                                </div> 
                            </div>  

                        </div>
                    </div>

                    <!-- category -->
                    <div class="tab-pane fade" id="category">
                        <div class="container text-dark pb-5">
                            <div class="tab-content">

                                <!-- form Add Category -->
                                <div class="tab-pane fade show active text-dark" id="addCategory">
                                    <div class="pt-5 pb-5 d-flex justify-content-center">
                                        <div style="width: 650px;">
                                            <div class="text-center pb-3">
                                                <h2>Add Category</h2>
                                            </div>
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">CategoryName:</label>
                                                    <input required type="text" id="CategoryName" name="fCategoryName" class="form-control" placeholder="CategoryName" />
                                                </div>
                                                <div class="mb-3 w-50">
                                                    <label class="form-label fw-bold text-secondary">ParentID:</label>
                                                    <select required class="form-select" id="ParentID" name="fParentID">
                                                        <option value="0">Select</option>
                                                        <?php
                                                        $a = new Category();
                                                        $arr = $a->getListCategory();
                                                        for($i = 0; $i < count($arr); $i++) {
                                                            $obj = $arr[$i];
                                                            echo "<option value='$obj->CategoryID'>$obj->CategoryName</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Description:</label>
                                                    <input type="text" id="Description" name="fDescription" class="form-control" placeholder="Description" />
                                                </div>
                                                <input type="submit" id="btncategory" name="fcategory" class="btn btn-primary" value="Save" />
                                            </form>
                                            <?php if (isset($_POST["fcategory"])) {
                                                $fCategoryName = $_POST["fCategoryName"];
                                                $fParentID = $_POST["fParentID"];
                                                $fDescription = $_POST["fDescription"];

                                                $a = new Category();
                                                $a->CategoryName = $fCategoryName;
                                                $a->ParentID = $fParentID;
                                                $a->Description = $fDescription;
                                                $a->addCategory();
                                            } ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- table list category -->
                                <div class="tab-pane fade show active text-dark" id="listcategory">
                                    <div class="pt-5 pb-5">
                                        <div class="text-center">
                                            <h2>List Category</h2>
                                        </div>
                                        <div class="pb-5">
                                            <div style="overflow-x: auto;">

                                                <div id="tbl-kithi" class="mt-4 pb-5" >
                                                    <table class="table table-striped table-hover">
                                                        <tr>
                                                            <th scope="col">STT</th>
                                                            <th scope="col">ID</th>
                                                            <th scope="col">CategoryName</th>
                                                            <th scope="col">ParentID</th>
                                                            <th scope="col">Description</th>
                                                            <th class="text-center" scope="col">Action</th>
                                                        </tr>
                                                        <?php
                                                        $a = new Category();
                                                        $arr = $a->getListCategory();
                                                        $strTbl = "";

                                                        $stt = 1;

                                                        for ($i = 0; $i < count($arr); $i++) {
                                                            $obj = $arr[$i];

                                                            $strTbl .= "<tr>";
                                                            $strTbl .= "<th>" . $stt++ . "</th>";
                                                            $strTbl .= "<td id='CategoryID'>$obj->CategoryID</td>";
                                                            $strTbl .= "<td id='CategoryName'>$obj->CategoryName</td>";
                                                            $strTbl .= "<td>$obj->ParentID</td>";
                                                            $strTbl .= "<td id='Description'>$obj->Description</td>";
                                                            $strTbl .= "<td>
                                                                                <div class='d-flex justify-content-center'>
                                                                                    <form class='m-1' action='' method='POST'>
                                                                                        <input type='hidden' name='fCategoryID' value='$obj->CategoryID'/>
                                                                                        <input type='hidden' name='fvalDel' value='d'/>
                                                                                        <input type='submit' class='btn btn-danger' name='fdelete' value='Delete'>
                                                                                    </form>
                                                                                    <input type='submit' class='btn btn-primary m-1' name='feditCategory' value='Edit'>
                                                                                </div>    
                                                                            </td>";
                                                            $strTbl .= "</tr>";
                                                        }

                                                        echo $strTbl;

                                                        //delete => update
                                                        if (isset($_POST["fdelete"])) {
                                                            $fCategoryID = $_POST["fCategoryID"];
                                                            $fvalDel = $_POST["fvalDel"];

                                                            $a = new Category();
                                                            $a->Flag = $fvalDel;
                                                            $a->CategoryID = $fCategoryID;
                                                            $a->updateListCategory();
                                                        }
                                                        ?>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- edit list category -->
                            <div id="editcategory" class="d-none">
                                <div class="pb-5 d-flex justify-content-center">
                                    <div style="width: 650px;">
                                        <div class="text-center pb-3">
                                            <h2>Edit</h2>
                                        </div>
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                            <input type="hidden" name="fCategoryID">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">CategoryName:</label>
                                                <input type="text" name="fCategoryName" class="form-control" placeholder="CategoryName" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">Description:</label>
                                                <input type="text" name="fDescription" class="form-control" placeholder="Description" />
                                            </div>
                                            <input type="submit" name="fcategoryEdit" class="btn btn-primary" value="Save" />
                                            <div class="mb-3">
                                                <i class="text-warning bi bi-exclamation-triangle pe-1"></i><span class="text-danger">If you need to fix other fields, please contact admin for support: <a href="mailto:nduydu66@gmail.com">nduydu66@gmail.com</a></span>
                                            </div>
                                        </form>
                                        <?php
                                        
                                        if (isset($_POST["fcategoryEdit"])) {
                                            $fCategoryID = $_POST["fCategoryID"];
                                            $fCategoryName = $_POST["fCategoryName"];
                                            $fDescription = $_POST["fDescription"];

                                            $a = new Category();
                                            $a->CategoryID = $fCategoryID;
                                            $a->CategoryName = $fCategoryName;
                                            $a->Description = $fDescription;
                                            $a->updateCategory();
                                        }
                                        ?>
                                    </div>
                                </div> 
                            </div>  

                        </div>
                    </div>

                    <!-- categorytour -->
                    <div class="tab-pane fade" id="categorytour">
                        <div class="container text-dark pb-5">
                            <div class="tab-content">

                                <!-- form Add Categorytour -->
                                <div class="tab-pane fade show active text-dark" id="addCategorytour">
                                    <div class="pt-5 pb-5 d-flex justify-content-center">
                                        <div style="width: 650px;">
                                            <div class="text-center pb-3">
                                                <h2>Add Categorytour</h2>
                                            </div>
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">CategoryTourName:</label>
                                                    <input required type="text" id="CategoryTourName" name="fCategoryTourName" class="form-control" placeholder="CategoryTourName" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Status:</label>
                                                    <select required class="form-select" id="Status" name="fStatus" >
                                                        <option value="3">Not activated</option>
                                                        <option value="1">Active</option>
                                                        <option value="2">Stop working</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Description:</label>
                                                    <input type="text" id="Description" name="fDescription" class="form-control" placeholder="Description" />
                                                </div>
                                                <input type="submit" id="btncategorytour" name="fcategorytour" class="btn btn-primary" value="Save" />
                                            </form>
                                            <?php if (isset($_POST["fcategorytour"])) {
                                                $fCategoryTourName = $_POST["fCategoryTourName"];
                                                $fStatus = $_POST["fStatus"];
                                                $fDescription = $_POST["fDescription"];

                                                $a = new CategoryTour();
                                                $a->CategoryTourName = $fCategoryTourName;
                                                $a->Status = $fStatus;
                                                $a->Description = $fDescription;
                                                $a->addCategoryTour();
                                            } ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- table list categorytour -->
                                <div class="tab-pane fade show active text-dark" id="listCategorytour">
                                    <div class="pt-5 pb-5">
                                        <div class="text-center">
                                            <h2>List Categorytour</h2>
                                        </div>
                                        <div class="pb-5">
                                            <div style="overflow-x: auto;">

                                                <div id="tbl-kithi" class="mt-4 pb-5" >
                                                    <table class="table table-striped table-hover">
                                                        <tr>
                                                            <th scope="col">STT</th>
                                                            <th scope="col">ID</th>
                                                            <th scope="col">CategoryTourName</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Description</th>
                                                            <th class="text-center" scope="col">Action</th>
                                                        </tr>
                                                        <?php
                                                        $a = new CategoryTour();
                                                        $arr = $a->getListCategoryTour();
                                                        $strTbl = "";

                                                        $stt = 1;

                                                        for ($i = 0; $i < count($arr); $i++) {
                                                            $obj = $arr[$i];

                                                            $strTbl .= "<tr>";
                                                            $strTbl .= "<th>" . $stt++ . "</th>";
                                                            $strTbl .= "<td id='CategoryTourID'>$obj->CategoryTourID</td>";
                                                            $strTbl .= "<td id='CategoryTourName'>$obj->CategoryTourName</td>";
                                                            $strTbl .= "<td>$obj->Status</td>";
                                                            $strTbl .= "<td id='Description'>$obj->Description</td>";
                                                            $strTbl .= "<td>
                                                                                <div class='d-flex'>
                                                                                    <form class='m-1' action='' method='POST'>
                                                                                        <input type='hidden' name='fCategoryTourID' value='$obj->CategoryTourID'/>
                                                                                        <input type='hidden' name='fvalDel' value='d'/>
                                                                                        <input type='submit' class='btn btn-danger' name='fdelete' value='Delete'>
                                                                                    </form>
                                                                                    <input type='submit' class='btn btn-primary m-1' name='feditCategorytour' value='Edit'>
                                                                                </div>    
                                                                            </td>";
                                                            $strTbl .= "</tr>";
                                                        }

                                                        echo $strTbl;

                                                        //delete => update
                                                        if (isset($_POST["fdelete"])) {
                                                            $fCategoryTourID = $_POST["fCategoryTourID"];
                                                            $fvalDel = $_POST["fvalDel"];

                                                            $a = new CategoryTour();
                                                            $a->Flag = $fvalDel;
                                                            $a->CategoryTourID = $fCategoryTourID;
                                                            $a->updateListCategoryTour();
                                                        }
                                                        ?>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- edit list categorytour -->
                            <div id="editcategorytour" class="d-none">
                                <div class="pb-5 d-flex justify-content-center">
                                    <div style="width: 650px;">
                                        <div class="text-center pb-3">
                                            <h2>Edit</h2>
                                        </div>
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                            <input type="hidden" name="fCategorytourID">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">CategoryTourName:</label>
                                                <input type="text" id="CategoryTourName" name="fCategoryTourName" class="form-control" placeholder="CategoryTourName" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">Description:</label>
                                                <input type="text" id="Description" name="fDescription" class="form-control" placeholder="Description" />
                                            </div>
                                            <input type="submit" id="btncategorytour" name="fcategorytourEdit" class="btn btn-primary" value="Save" />
                                            <div class="mb-3">
                                                <i class="text-warning bi bi-exclamation-triangle pe-1"></i><span class="text-danger">If you need to fix other fields, please contact admin for support: <a href="mailto:nduydu66@gmail.com">nduydu66@gmail.com</a></span>
                                            </div>
                                        </form>
                                        <?php
                                        
                                        if (isset($_POST["fcategorytourEdit"])) {
                                            $fCategorytourID = $_POST["fCategorytourID"];
                                            $fCategoryTourName = $_POST["fCategoryTourName"];
                                            $fDescription = $_POST["fDescription"];

                                            $a = new CategoryTour();
                                            $a->CategoryTourID = $fCategorytourID;
                                            $a->CategoryTourName = $fCategoryTourName;
                                            $a->Description = $fDescription;
                                            $a->updateCategorytour();
                                        }
                                        ?>
                                    </div>
                                </div> 
                            </div>  

                        </div>
                    </div>

                    <!-- contact -->
                    <div class="tab-pane fade" id="contact">
                        <div class="container text-dark pb-5 pt-5">
                            <!-- table list categorytour -->
                            <div id="listCategorytour">
                                <div class="text-center">
                                    <h2>List Contact</h2>
                                </div>
                                <div class="pb-5">
                                    <div style="overflow-x: auto;">

                                        <div id="tbl-kithi" class="mt-4 pb-5" >
                                            <table class="table table-striped table-hover">
                                                <tr>
                                                    <th scope="col">STT</th>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Fullname</th>
                                                    <th scope="col">Address</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Telephone</th>
                                                    <th scope="col">Message</th>
                                                    <th scope="col">Description</th>
                                                </tr>
                                                <?php
                                                $a = new Contact();
                                                $arr = $a->getListContact();
                                                $strTbl = "";

                                                $stt = 1;

                                                for ($i = 0; $i < count($arr); $i++) {
                                                    $obj = $arr[$i];

                                                    $strTbl .= "<tr>";
                                                    $strTbl .= "<th>" . $stt++ . "</th>";
                                                    $strTbl .= "<td>$obj->contactID</td>";
                                                    $strTbl .= "<td>$obj->fullname</td>";
                                                    $strTbl .= "<td>$obj->address</td>";
                                                    $strTbl .= "<td>$obj->email</td>";
                                                    $strTbl .= "<td>$obj->telephone</td>";
                                                    $strTbl .= "<td>$obj->message</td>";
                                                    $strTbl .= "<td>$obj->description</td>";
                                                }

                                                echo $strTbl;
                                                ?>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- locationandservice -->
                    <div class="tab-pane fade" id="locationandservice">
                        <div class="container text-dark pb-5">
                            <div class="tab-content">

                                <!-- form Add Locationandservice -->
                                <div class="tab-pane fade show active text-dark" id="addLocationandservice">
                                    <div class="pt-5 pb-5 d-flex justify-content-center">
                                        <div style="width: 650px;">
                                            <div class="text-center pb-3">
                                                <h2>Add Locationandservice</h2>
                                            </div>
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Mountaineering:</label>
                                                    <select required id="Mountaineering" name="fMountaineeringID" class="form-select">
                                                        <option value="0">Select</option>
                                                        <?php
                                                        $a = new Mountaineering();
                                                        $arr = $a->getListMountaineering();

                                                        for ($i = 0; $i < count($arr); $i++) {
                                                            $obj = $arr[$i];

                                                            echo "<option value='$obj->mountaineeringID'>" . $obj->mountainName . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Service:</label>
                                                    <select required id="Service" name="fServiceID" class="form-select">
                                                        <option value="0">Select</option>
                                                        <?php
                                                        $a = new Service();
                                                        $arr = $a->getListService();

                                                        for ($i = 0; $i < count($arr); $i++) {
                                                            $obj = $arr[$i];

                                                            echo "<option value='$obj->serviceID'>" . $obj->serviceName . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold text-secondary">Description:</label>
                                                    <input type="text" id="Description" name="fDescription" class="form-control" placeholder="Description" />
                                                </div>
                                                <input type="submit" id="btnlocationandservice" name="flocationandservice" class="btn btn-primary" value="Save" />
                                            </form>
                                            <?php if (isset($_POST["flocationandservice"])) {
                                                $fMountaineeringID = $_POST["fMountaineeringID"];
                                                $fServiceID = $_POST["fServiceID"];
                                                $fDescription = $_POST["fDescription"];

                                                $a = new Locationandservice();
                                                $a->mountaineeringID = $fMountaineeringID;
                                                $a->serviceID = $fServiceID;
                                                $a->description = $fDescription;
                                                $a->addLocationandservice();
                                            } ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- table list locationandservice -->
                                <div class="tab-pane fade show active text-dark" id="listlocationandservice">
                                    <div class="pt-5 pb-5">
                                        <div class="text-center">
                                            <h2>List Locationandservice</h2>
                                        </div>
                                        <div class="pb-5">
                                            <div style="overflow-x: auto;">

                                                <div id="tbl-kithi" class="mt-4 pb-5" >
                                                    <table class="table table-striped table-hover">
                                                        <tr>
                                                            <th scope="col">STT</th>
                                                            <th scope="col">ID</th>
                                                            <th scope="col">MountainName</th>
                                                            <th scope="col">ServiceName</th>
                                                            <th scope="col">Description</th>
                                                            <th class="text-center" scope="col">Action</th>
                                                        </tr>
                                                        <?php
                                                        $a = new Locationandservice();
                                                        $arr = $a->getListLocationandservice();
                                                        $strTbl = "";

                                                        $stt = 1;

                                                        for ($i = 0; $i < count($arr); $i++) {
                                                            $obj = $arr[$i];

                                                            $strTbl .= "<tr>";
                                                            $strTbl .= "<th>" . $stt++ . "</th>";
                                                            $strTbl .= "<td id='locationAndServiceID'>$obj->locationAndServiceID</td>";
                                                            $strTbl .= "<td>$obj->MountainName</td>";
                                                            $strTbl .= "<td>$obj->ServiceName</td>";
                                                            $strTbl .= "<td id='description'>$obj->description</td>";
                                                            $strTbl .= "<td>
                                                                            <div class='d-flex'>
                                                                                <form class='m-1' action='' method='POST'>
                                                                                    <input type='hidden' name='flocationAndServiceID' value='$obj->locationAndServiceID'/>
                                                                                    <input type='hidden' name='fvalDel' value='d'/>
                                                                                    <input type='submit' class='btn btn-danger' name='fdelete' value='Delete'>
                                                                                </form>
                                                                                <input type='submit' class='btn btn-primary m-1' name='feditlocationandservice' value='Edit'>
                                                                            </div>    
                                                                        </td>";
                                                            $strTbl .= "</tr>";
                                                        }

                                                        echo $strTbl;
                                                        //delete => update
                                                        if (isset($_POST["fdelete"])) {
                                                            $flocationAndServiceID = $_POST["flocationAndServiceID"];
                                                            $fvalDel = $_POST["fvalDel"];

                                                            $a = new Locationandservice();
                                                            $a->flag = $fvalDel;
                                                            $a->locationAndServiceID = $flocationAndServiceID;
                                                            $a->updateListLocationandservice();
                                                        }
                                                        ?>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- edit list locationandservice -->
                            <div id="editlocationandservice" class="d-none">
                                <div class="pb-5 d-flex justify-content-center">
                                    <div style="width: 650px;">
                                        <div class="text-center pb-3">
                                            <h2>Edit</h2>
                                        </div>
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                            <input type="hidden" name="flocationandserviceID">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-secondary">Description:</label>
                                                <input type="text" id="Description" name="fDescription" class="form-control" placeholder="Description" />
                                            </div>
                                            <input type="submit" id="btnlocationandservice" name="flocationandserviceEdit" class="btn btn-primary" value="Save" />
                                            <div class="mb-3">
                                                <i class="text-warning bi bi-exclamation-triangle pe-1"></i><span class="text-danger">If you need to fix other fields, please contact admin for support: <a href="mailto:nduydu66@gmail.com">nduydu66@gmail.com</a></span>
                                            </div>
                                        </form>
                                        <?php
                                        
                                        if (isset($_POST["flocationandserviceEdit"])) {
                                            $flocationandserviceID = $_POST["flocationandserviceID"];
                                            $fDescription = $_POST["fDescription"];

                                            $a = new Locationandservice();
                                            $a->locationAndServiceID = $flocationandserviceID;
                                            $a->description = $fDescription;
                                            $a->updateLocationandservice();
                                        }
                                        ?>
                                    </div>
                                </div> 
                            </div>  

                        </div>
                    </div>

                    <!-- profile -->
                    <div class="tab-pane fade" id="profile">
                        <div class="container pt-5 pb-5 text-dark">
                            <div>
                                <h2 class="text-center">Account Information</h2> 
                            </div>
                            <div class="d-flex justify-content-center">
                                <div style="width: 650px;">
                                    <div class="p-3">
                                        <?php
                                        $a = new Usersystem();
                                        $list = $a->getProfile();

                                        for ($i = 0; $i < count($list); $i++) {
                                            $obj = $list[$i];

                                            $name = $obj->UserName;
                                            $role = ucfirst($obj->Role);

                                            echo "  <div class='mt-2 mb-2 d-flex justify-content-between border-bottom'>
                                                        <strong class='text-secondary'>Username:</strong><span class='text-primary'> $name</span>
                                                    </div>
                                                    <div class='mt-2 mb-2 d-flex justify-content-between border-bottom'>
                                                        <strong class='text-secondary'>Role:</strong><span class='text-primary'> $role</span>
                                                    </div>
                                                    ";
                                        }
                                        ?>
                                        
                                    </div>
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                        <div class="p-3">
                                            <div>
                                                <h4>Reset password:</h3>
                                            </div>
                                            <?php
                                            $a = new Usersystem();
                                            $list = $a->getProfile();

                                            for ($i = 0; $i < count($list); $i++) {
                                                $obj = $list[$i];
                                                echo '<input type="hidden" name="userID" value="' . $obj->UserSystemID . '"/>';
                                            }
                                            ?>
                                            <div class="mt-3 mb-3">
                                                <label class="form-label fw-bold text-secondary">Current password:</label>
                                                <input required type="password" id="crpass" name="fcrpass" class="form-control" placeholder="Pass" />
                                            </div>
                                            <div class="mt-3 mb-3">
                                                <label class="form-label fw-bold text-secondary">New password:</label>
                                                <input required type="password" id="newpass" name="fnewpass" class="form-control" placeholder="Create pass" />
                                            </div>
                                            <div class="mt-3 mb-3">
                                                <label class="form-label fw-bold text-secondary">Confirm password:</label>
                                                <input required type="password" id="cfpass" name="cfpass" class="form-control" placeholder="Confirm pass" />
                                            </div>
                                            <div class="mt-3 mb-3">
                                                <input type="submit" class="btn btn-primary" name="fresetpass" value="Reset"/>
                                            </div>
                                        </div>
                                    </form>
                                    <?php if (isset($_POST["fresetpass"])) {
                                        $fcrpass = $_POST["fcrpass"];
                                        $fnewpass = $_POST["fnewpass"];
                                        $cfpass = $_POST["cfpass"];
                                        $userID = $_POST["userID"];

                                        $fnewpass = md5($fnewpass);
                                        $cfpass = md5($cfpass);

                                        if ($fnewpass === $cfpass) {
                                            $a = new Usersystem();
                                            $a->Password = $cfpass;
                                            $a->UserSystemID = $userID;
                                            $a->updatePass();
                                            echo '<div class="d-flex justify-content-center">
                                                        <p class="p-2 text-success m-0">Done !</p>
                                                    </div>';
                                        } else {
                                            echo '  <div class="d-flex justify-content-center">
                                                                <p class="p-2 text-danger m-0">Passwords must match !</p>
                                                            </div>';
                                        }
                                    } ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                <div>
                
            </main>
            <!-- END MAIN -->

            <!-- BEGIN FOOTER -->
            <footer class="footer body-pd" id="footer"></footer>
            <!-- END FOOTER -->

            <!-- BEGIN MODAL -->

            <!-- modal tour -->
            <div class="modal fade" id="modaltour">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Full info tour</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div style="overflow-x: auto;">

                                <div id="tbl-kithi" class="mt-4 pb-5" >
                                    <div id="HintTour"></div>
                                </div>
                                
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- END MODAL -->
        </div>

        <!-- JQUERY 3.6.1 -->
        <script src="../users/assets/js/jquery.min.js"></script>
        <!-- JS BOOTSTRAP -->
        <script src="../users/assets/js/bootstrap.bundle.min.js"></script>
        <!-- chart js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- JS ME -->
        <script src="./assets/js/loadMenu.js"></script>
        <script src="./assets/js/admin.js"></script>
        <script src="../users/assets/js/ckeditor/ckeditor.js"></script>
        <script type="text/javascript">
            // ck editer
            CKEDITOR.replace( 'editor1' );

            // check select itemlibraryitem
            function showByType(str) {
                if (str == "0") {
                    document.querySelector("#hintitemlibraryitem").innerHTML = "";
                    return;
                } else if (str == 1) {
                    document.querySelector("#hintitemlibraryitem").innerHTML = `<div class="mb-3">
                                                                                    <label class="form-label fw-bold text-secondary">Upload img:</label>
                                                                                    <input type="file" id="Upload" name="fUpload" class="form-control"/>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label class="form-label fw-bold text-secondary">Alt:</label>
                                                                                    <input type="text" id="Alt" name="fAlt" class="form-control" placeholder="Alt" />
                                                                                </div>
                                                                                <input type="submit" name="fitemimg" class="btn btn-primary" value="Save" />`;
                    return;
                } else {
                    document.querySelector("#hintitemlibraryitem").innerHTML = `<div class="mb-3">
                                                                                    <label class="form-label fw-bold text-secondary">Id youtube:</label>
                                                                                    <input type="text" id="Alt" name="fFile" class="form-control" placeholder="id video youtube" />
                                                                                    Demo: <span class="text-primary">https://www.youtube.com/watch?v=<span class="text-danger">sGxw7ipTrq8 </span></span><= id color red
                                                                                </div>
                                                                                <input type="submit" name="fitemvideo" class="btn btn-primary" value="Save" />`;
                }

            }

            // check select itemlirary edit
            function showByTypeEdit(str) {
                if (str == "0") {
                    document.querySelector("#hintedititem").innerHTML = "";
                    return;
                } else if (str == 1) {
                    document.querySelector("#hintedititem").innerHTML = `<div class="mb-3">
                                                                                    <label class="form-label fw-bold text-secondary">Alt:</label>
                                                                                    <input type="text" name="fAlt" class="form-control" placeholder="Alt" />
                                                                                </div>
                                                                                <input type="submit" name="fitemimgEdit" class="btn btn-primary" value="Save" />`;
                    return;
                } else {
                    document.querySelector("#hintedititem").innerHTML = `<div class="mb-3">
                                                                                    <label class="form-label fw-bold text-secondary">Id youtube:</label>
                                                                                    <input type="text" name="fFileEdit" class="form-control" placeholder="id video youtube"/>
                                                                                    Demo: <span class="text-primary">https://www.youtube.com/watch?v=<span class="text-danger">sGxw7ipTrq8 </span></span><= id color red
                                                                                </div>
                                                                                <input type="submit" name="fitemvideoEdit" class="btn btn-primary" value="Save" />`;
                }

            }

            // show data tour theo id
            function ShowTourById(str)
            {
                if (str == "") {
                    document.querySelector("#HintTour").innerHTML = "";
                    return;
                } else {
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                            document.querySelector("#HintTour").innerHTML = xmlhttp.responseText;
                        }
                    };
                    xmlhttp.open("GET", "ListTour.php?id=" + str, true);
                    xmlhttp.send();
                }

            }
        </script>
    </body> 
</html>
