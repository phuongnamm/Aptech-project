<?php
session_start();
require_once '../PhpSetting/Itemlibrary.php';
require_once '../PhpSetting/News.php';
require_once '../PhpSetting/CategoryTour.php';
require_once '../PhpSetting/Common.php';
require_once '../PhpSetting/Service.php';
require_once '../PhpSetting/Category.php';
require_once '../PhpSetting/Member.php';
if (isset($_POST["logout"])) {
    $a = new Member();
    $a->Logout();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Website về leo núi,cắm trại,du lịch,đặt tour và các dịch vụ đi cùng chuyến du lịch.Cho bạn 1 nơi tha hồ lựa chọn các địa điểm du lịch và book tour dễ dàng thuận tiện cùng những khuyến mãi khủng." />
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

    <title>Blog</title>
    <!-- Reset CSS -->
    <link rel="stylesheet" href="./assets/css/reset.min.css" />
    <!-- bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="./assets/css/header-footer.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <!--favicon-->
    <link rel="icon" type="image/x-icon" href="./assets/image/favicon.png" />



    <!-- --------- Owl-Carousel ------------------->
    <link rel="stylesheet" href="./assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="./assets/css/owl.theme.default.min.css">

    <!-- ------------ AOS Library ------------------------- -->
    <link rel="stylesheet" href="./assets/css/aos.css">

    <!-- Custom Style   -->
    <link rel="stylesheet" href="./assets/css/blog.css">

</head>

<body>


    <div class="app">
<!--BEGIN nav -->
<nav class="navbar navbar-expand-lg position-fixed">
                <div class="container">
                    <a class="navbar-brand" href="../index.php">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 56.68 55.66" style="width: 50px; height: 50px;" xml:space="preserve">
                            <style type="text/css">
                                .st0 {
                                    fill: #D85F37;
                                    stroke: #E7DBBE;
                                    stroke-width: 5;
                                    stroke-miterlimit: 10;
                                }

                                .st1 {
                                    fill: #E7DBBE;
                                }

                                .st2 {
                                    fill: #203B2D;
                                }
                            </style>
                            <circle class="st0" cx="28.34" cy="27.59" r="24.05" />
                            <polygon class="st1" points="4.82,33.63 6.62,31.09 13.58,26.7 15.45,27.08 19.57,22.5 23.31,20.66 30.34,24.03 35.82,21.17 
                                    40.78,24.79 45.16,26.25 51.86,34.52 46.84,31.21 46.58,33.06 42.45,28.8 40.52,30.64 40.46,27.59 37.11,25.81 35.3,23.2 
                                    32.01,28.29 28.34,27.59 26.54,31.34 24.02,30.9 16.67,34.52 18.09,32.17 25.18,27.59 30.02,26.32 24.8,23.71 23.76,22.31 
                                    20.22,27.59 17.9,27.02 16.16,30.58 12.23,30.01 " />
                            <path class="st2" d="M28.45,27.33l-0.27,0.22c0.11,0.1,0.21,0.19,0.32,0.29C28.48,27.66,28.46,27.49,28.45,27.33z" />
                            <path class="st2" d="M28.5,27.84c-0.11-0.1-0.21-0.19-0.32-0.29l0.27-0.22C28.46,27.49,28.48,27.66,28.5,27.84z" />
                            <path class="st2" d="M40.83,42.06c-0.45-1.51-3.26-2.93-3.26-2.93l-1.16,0.86l1.03-2.22c-0.06-1.44-1.92-1.31-1.92-1.31
                                    c-1.4,0.47-1.72-0.32-1.72-0.32l3.88-14.8c0.27-0.2,0.39-0.44,0.42-0.61c0.04-0.18,0.07-0.55-0.04-0.88l0.64-2.46
                                    c0.43-0.67,0-1.14,0-1.14c-0.73-0.13-0.77,0.62-0.77,0.62l-0.63,2.35c-0.04,0-0.08-0.01-0.12-0.01c-1.05,0.02-1.31,0.72-1.31,0.72
                                    l-0.53,0.01c-0.43-0.8-1.21-0.19-1.21-0.19l-1.08,0.07l-2.41-2.5l0.02-0.63c1.03,0.17,1.36-0.17,1.36-0.17l0.02-0.93l0.67,0.02
                                    v-1.18l0.37-0.02v-0.62c1.03-0.39,0.15-0.86,0.15-0.86l-1.9-1.29v-1.29c-3.49-1.81-5.13-1.27-5.13-1.27
                                    c-1.55,0.15-1.25,3.64-1.25,3.64c-1.49-0.39-1.61,0.73-1.61,0.73l-2.65,8.16c-0.32,2.34,2.56,2.27,2.56,2.27
                                    c-1.67,1.67-0.75,3.68-0.75,3.68c0.26,0.11-0.06,5.37-0.06,5.37c-1.55,2.1-1.35,5-1.35,5c-0.06,1.26-0.78,1.69-0.78,1.69
                                    c-1,0.86-0.55,1.75-0.55,1.75l1.96,1.51c-0.31,0.15-0.47,0.28-0.47,0.28l-3.22-0.2c-2-1.35-2.59,1.32-2.59,1.32
                                    c-0.69,2.13,2.03,1.83,2.03,1.83c0.88,0.39,6.53-0.95,6.53-0.95c0.65,1.14,2.41,0.39,2.41,0.39c0.32-0.22,2.37-0.15,2.37-0.15
                                    c0.56-0.11,1.44-2.93,1.44-2.93c0.52,0.37,0,2.22,0,2.22l2.84,1.42c2.15-1.29,3.79-1.14,3.79-1.14c1.7-0.09,0.52-2.37,0.52-2.37
                                    c-0.59-0.36-0.86-1-0.99-1.52c2.11,2.02,2.78,4.35,2.78,4.35l1.26-0.32C42.16,44.89,40.83,42.06,40.83,42.06z M30.3,37.02
                                    c-0.1,1.1-2.32,1.53-2.32,1.53l0.14,2.27c-1.78-0.49-2.15,1.99-2.15,1.99c-0.61-0.21-1.17-0.32-1.67-0.36
                                    c-0.17-0.67-1.25-0.83-1.25-0.83c-0.69-1.29,0-3.13,0-3.13l2.41-5.72l0.72-1.95c0.4-2.04,1.85-1.97,1.85-1.97
                                    c2.74,0.17,2.14,1.03,2.14,1.03c-0.73,2.54-2.07,3.69-2.07,3.69c-0.86,1.32,0,1.69,0,1.69l2.26,1.7
                                    C30.32,37.01,30.3,37.02,30.3,37.02z M32.77,36.14c-0.08-0.07-0.17-0.1-0.28-0.12c-0.01-0.03-0.01-0.04-0.01-0.04
                                    c-0.75-0.04-0.83-0.5-0.83-0.5c-1.22-1.33-0.62-2.08-0.62-2.08l2.67-4.38c0.83-1.7-0.76-2.3-0.76-2.3l-3.71-1.51
                                    c-0.93-0.09-0.52-0.93-0.52-0.93l1.39-2.07l2.99,0.13c0.4,0.73,1.26,0.58,1.62,0.5c0.36-0.07,1.25-1.21,1.25-1.21
                                    c0.26,0.03,0.49,0.04,0.69,0.02L32.77,36.14z M36.27,40.49l0.05-0.04c0,0.03,0.01,0.06,0.01,0.09
                                    C36.3,40.52,36.28,40.51,36.27,40.49z" />
                            <line class="st2" x1="23.87" y1="26.06" x2="32.81" y2="29.12" />
                            <path class="st2" d="M28.5,27.84c-0.11-0.1-0.21-0.19-0.32-0.29l0.27-0.22C28.46,27.49,28.48,27.66,28.5,27.84z" />
                        </svg>
                    </a>
                    <a id="bg-show-mobile" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarmenu">
                        <i class="bi bi-plus-square-fill text-danger"></i>
                    </a>

                    <div class="collapse navbar-collapse justify-content-end" id="navbarmenu">
                        <ul class="navbar-nav">
                            <li class="nav-item ps-3 pe-3 mt-2 home">
                                <a class="nav-link fw-bold text-shadow" href="../index.php">Home</a>
                            </li>
                            <li class="nav-item ps-3 pe-3 mt-2 dropdown">
                                <div class="nav-link fw-bold text-shadow dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    Service
                                </div>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item nav-link ps-2" href="service.php">Service</a>
                                    </li>
                                    <?php
                                    $s = new Service();
                                    $arr = $s->getListServiceMenu();
                                    foreach ($arr as $value){
                                        echo "<li>
                                                <a class='dropdown-item nav-link ps-2' href='service.php'>$value->serviceName</a>
                                            </li>";
                                    }  
                                    ?>
                                </ul>
                            </li>
                            <li class="nav-item ps-3 pe-3 mt-2 dropdown">
                                <div class="nav-link fw-bold text-shadow dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    Tour
                                </div>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item nav-link ps-2" href="tour.php">Tour</a>
                                    </li>
                                    <?php
                                    $s = new CategoryTour();
                                    $list = $s->getListCategoryTour();
                                    foreach ($list as $value){
                                        echo "<li>
                                                <a class='dropdown-item nav-link ps-2' href='./listtourtocategory.php?id=$value->CategoryTourID'>$value->CategoryTourName</a>
                                            </li>";
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li class="nav-item ps-3 pe-3 mt-2 dropdown">
                                    <div class="nav-link fw-bold text-shadow dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        News
                                    </div>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item nav-link ps-2" href="news.php">News</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item nav-link ps-2" href="blog.php">Blog</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item nav-link ps-2" href="#">Sale</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item nav-link ps-2" href="history.php">History</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item nav-link ps-2" href="experiences.php">Experiences</a>
                                        </li>
                                    </ul>
                                </li>
                            <li class="nav-item ps-3 pe-3 mt-2 dropdown">
                                <a class="nav-link fw-bold text-shadow " href="experiences.php">Experience</a>
                            </li>
                            <li class="nav-item ps-3 pe-3 mt-2 disabled">
                                <a class="nav-link fw-bold text-shadow " href="contact.php">Contact</a>
                            </li>
                            <?php
                            $checkin = IsAuthen();
                            if ($checkin != 1) {
                                echo '<li class="nav-item ps-3 pe-3 mt-2 mb-2">
                                            <a class="nav-link text-center p-2 hv-box text-white fw-bold text-shadow bg-danger rounded-pill" href="login.php">
                                                Login
                                            </a>
                                        </li>
                                        <li class="nav-item ps-3 pe-3 mt-2 mb-2">
                                            <a class="nav-link text-center p-2 hv-box text-white fw-bold text-shadow bg-primary rounded-pill" href="register.php">
                                                Register
                                            </a>
                                        </li>';
                            } else {
                                echo '<li class="nav-item ps-3 pe-3 mt-2 mb-2">
                                            <form action="" method="POST">
                                                <button type="submit" name="logout" class="nav-link text-center p-2 hv-box text-white fw-bold text-shadow bg-danger rounded-pill">
                                                    Logout
                                                </button>
                                            </form>
                                        </li>';
                                //Show tên người dùng đã đăng nhập.
                                //    $s = new Member();
                                //    $s->MemberName = $member;
                                //    $list = $s->GetUserByUsername();
                                //    echo 'Hello :' . $list[0]->Firstname . ' ' . $list[0]->Middlename . ' ' . $list[0]->Lastname;
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
            <!--END nav -->



        <!----------------------------- Main Site Section ------------------------------>

        <main>

            <!------------------------ Site Title ---------------------->

            <section class="site-title" style="background-image: url('./assets/Background.jpg')">
                <div class="site-background" data-aos="fade-up" data-aos-delay="500">

                    <h1>Blog</h1>
                    <a title="click" href="#carousel""><i class=" fs-2 bi bi-arrow-down-circle"></i></a>
                </div>
            </section>

            <!------------x----------- Site Title ----------x----------->

            <!-- --------- ------------ Blog Carousel ----------------- -->

            <section class="container" id="carousel">
                <div class="blog">
                    <div class="container">
                        <h2 style="text-align: center;padding-top: 10vh;color:#3586b8;">Blog library</h2>
                        <div class="owl-carousel owl-theme blog-post">
                            <?php
                            $a = new Itemlibrary();
                            $a->libraryID = 3;
                            $arr = $a->getFileItemLibrary();
                            foreach ($arr as $val) {
                                echo "<div class='blog-content' data-aos='fade-right' data-aos-delay='200'>
                                        <img src='$val->file' alt='$val->alt'>
                                    </div>";
                            }
                            ?>
                        </div>
                        <div class="owl-navigation">
                            <span class="owl-nav-prev"><i class="bi bi-arrow-left"></i></span>
                            <span class="owl-nav-next"><i class="bi bi-arrow-right"></i></span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ----------x---------- Blog Carousel --------x-------- -->

            <!-- ---------------------- Site Content -------------------------->

            <section class="container">
                <!-- <div class="site-content"> -->
                <div class="posts">
                    <?php
                    $a = new News();
                    $a->categoryID = 1;
                    $arr = $a->getListExperiences();
                    foreach ($arr as $value) {
                        echo "
                                    <div class='container'>
                                        <div class='post-content' data-aos='zoom-in' data-aos-delay='200'>
                                            <div class='post-image'>
                                                <div>
                                                    <img src='$value->avatarNews' class='img' alt='blog'>
                                                </div>
                                                
                                            </div>
                                            <div class='post-title'>
                                                <a href='blog-single.php?id=$value->newsID'>$value->title</a>
                                                <p>$value->leadcontent
                                                </p>
                                                <a href='blog-single.php?id=$value->newsID' class='btn post-btn'>Read More &nbsp; <i class='bi bi-arrow-right'></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    ";
                    }

                    ?>

                </div>
                <!-- <aside class="sidebar">
                        <div class="category">
                            <h2>Category</h2>
                            <ul class="category-list">
                                <li class="list-items" data-aos="fade-left" data-aos-delay="100">
                                    <a href="#">Camping</a>
                                    <span>(05)</span>
                                </li>
                                <li class="list-items" data-aos="fade-left" data-aos-delay="200">
                                    <a href="#">Travel</a>
                                    <span>(02)</span>
                                </li>
                                <li class="list-items" data-aos="fade-left" data-aos-delay="300">
                                    <a href="#">Caving</a>
                                    <span>(07)</span>
                                </li>
                                <li class="list-items" data-aos="fade-left" data-aos-delay="400">
                                    <a href="#">Climb</a>
                                    <span>(01)</span>
                                </li>
                                <li class="list-items" data-aos="fade-left" data-aos-delay="500">
                                    <a href="#">Lifestyle</a>
                                    <span>(08)</span>
                                </li>
                            </ul>
                        </div>
                        <div class="popular-post">
                            <h2>Popular Post</h2>
                            <div class="post-content" data-aos="flip-up" data-aos-delay="200">
                                <div class="post-image">
                                    <div>
                                        <img src="./assets/popular-post/popularpost1.jpg" class="img" alt="blog1">
                                    </div>
                                    <div class="post-info flex-row">
                                        <span><i class="bi bi-calendar-check-fill text-gray"></i>&nbsp;&nbsp;January 14,
                                            2019</span>
                                            
                                    </div>
                                </div>
                                <div class="post-title">
                                    <a href="#">Leo núi Bạch Mộc Lương Tử khó không? Lịch trình leo núi trekking 3N2Đ</a>
                                </div>
                            </div>
                            <div class="post-content" data-aos="flip-up" data-aos-delay="300">
                                <div class="post-image">
                                    <div>
                                        <img src="./assets/popular-post/popularpost2.jpg" class="img" alt="blog1">
                                    </div>
                                    <div class="post-info flex-row">
                                        <span><i class="bi bi-calendar-check-fill text-gray"></i>&nbsp;&nbsp;January 14,
                                            2019</span>
                                    
                                    </div>
                                </div>
                                <div class="post-title">
                                    <a href="#">Kinh nghiệm leo núi Putaleng – Chinh phục đỉnh Putaleng cao 3.049m</a>
                                </div>
                            </div>
                            <div class="post-content" data-aos="flip-up" data-aos-delay="400">
                                <div class="post-image">
                                    <div>
                                        <img src="./assets/popular-post/popularpost3.jpg" class="img" alt="blog1">
                                    </div>
                                    <div class="post-info flex-row">
                                        <span><i class="bi bi-calendar-check-fill text-gray"></i>&nbsp;&nbsp;January 14,
                                            2019</span>
                                        
                                    </div>
                                </div>
                                <div class="post-title">
                                    <a href="#">Hướng dẫn leo núi Bà Đen đường cột điện, Ma Thiên Lãnh, đường chùa…</a>
                                </div>
                            </div>
                            <div class="post-content" data-aos="flip-up" data-aos-delay="500">
                                <div class="post-image">
                                    <div>
                                        <img src="./assets/popular-post/popularpost4.jpg" class="img" alt="blog1">
                                    </div>
                                    <div class="post-info flex-row">
                                        <span><i class="bi bi-calendar-check-fill text-gray"></i>&nbsp;&nbsp;January 14,
                                            2019</span>
                                        
                                    </div>
                                </div>
                                <div class="post-title">
                                    <a href="#">5 địa chỉ mua ván lướt sóng uy tín giá tốt nhất</a>
                                </div>
                            </div>
                            <div class="post-content" data-aos="flip-up" data-aos-delay="600">
                                <div class="post-image">
                                    <div>
                                        <img src="./assets/popular-post/popularpost4.jpg" class="img" alt="blog1">
                                    </div>
                                    <div class="post-info flex-row">
                                        <span><i class="bi bi-calendar-check-fill text-gray"></i>&nbsp;&nbsp;January 14,
                                            2019</span>
                                    
                                    </div>
                                </div>
                                <div class="post-title">
                                    <a href="#">5 địa chỉ mua ván lướt sóng uy tín giá tốt nhất</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="popular-tags">
                            <h2>Popular Tags</h2>
                            <div class="tags flex-row">
                                <span class="tag" data-aos="flip-up" data-aos-delay="100">Bạch Mộc</span>
                                <span class="tag" data-aos="flip-up" data-aos-delay="200">Himalaya</span>
                                <span class="tag" data-aos="flip-up" data-aos-delay="300">Leo núi</span>
                                <span class="tag" data-aos="flip-up" data-aos-delay="400">Kỳ quan</span>
                                <span class="tag" data-aos="flip-up" data-aos-delay="500">Ngũ Chỉ Sơn</span>
                                <span class="tag" data-aos="flip-up" data-aos-delay="600">Nhìu Cồ San</span>
                                <span class="tag" data-aos="flip-up" data-aos-delay="700">Trekking</span>
                                <span class="tag" data-aos="flip-up" data-aos-delay="800">Lảo Thẩn</span>
                            </div>
                        </div>
                    </aside> -->
                <!-- </div> -->
            </section>

            <!-- -----------x---------- Site Content -------------x------------>

        </main>

        <!---------------x------------- Main Site Section ---------------x-------------->




        <!--BEGIN Footer -->
        <div class="footer bg-dark text-white pt-5 pb-5">
            <div class="container">
                <div class="row g-5" style=" margin-right: 0 !important;">
                    <div class="col-12 col-lg-3">
                        <a href="../index.php" class="d-block mb-3">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 56.68 55.66" style="width: 50px; height: 50px;" xml:space="preserve">
                                <style type="text/css">
                                    .st0 {
                                        fill: #D85F37;
                                        stroke: #E7DBBE;
                                        stroke-width: 5;
                                        stroke-miterlimit: 10;
                                    }

                                    .st1 {
                                        fill: #E7DBBE;
                                    }

                                    .st2 {
                                        fill: #203B2D;
                                    }
                                </style>
                                <circle class="st0" cx="28.34" cy="27.59" r="24.05" />
                                <polygon class="st1" points="4.82,33.63 6.62,31.09 13.58,26.7 15.45,27.08 19.57,22.5 23.31,20.66 30.34,24.03 35.82,21.17 
                                    40.78,24.79 45.16,26.25 51.86,34.52 46.84,31.21 46.58,33.06 42.45,28.8 40.52,30.64 40.46,27.59 37.11,25.81 35.3,23.2 
                                    32.01,28.29 28.34,27.59 26.54,31.34 24.02,30.9 16.67,34.52 18.09,32.17 25.18,27.59 30.02,26.32 24.8,23.71 23.76,22.31 
                                    20.22,27.59 17.9,27.02 16.16,30.58 12.23,30.01 " />
                                <path class="st2" d="M28.45,27.33l-0.27,0.22c0.11,0.1,0.21,0.19,0.32,0.29C28.48,27.66,28.46,27.49,28.45,27.33z" />
                                <path class="st2" d="M28.5,27.84c-0.11-0.1-0.21-0.19-0.32-0.29l0.27-0.22C28.46,27.49,28.48,27.66,28.5,27.84z" />
                                <path class="st2" d="M40.83,42.06c-0.45-1.51-3.26-2.93-3.26-2.93l-1.16,0.86l1.03-2.22c-0.06-1.44-1.92-1.31-1.92-1.31
                                    c-1.4,0.47-1.72-0.32-1.72-0.32l3.88-14.8c0.27-0.2,0.39-0.44,0.42-0.61c0.04-0.18,0.07-0.55-0.04-0.88l0.64-2.46
                                    c0.43-0.67,0-1.14,0-1.14c-0.73-0.13-0.77,0.62-0.77,0.62l-0.63,2.35c-0.04,0-0.08-0.01-0.12-0.01c-1.05,0.02-1.31,0.72-1.31,0.72
                                    l-0.53,0.01c-0.43-0.8-1.21-0.19-1.21-0.19l-1.08,0.07l-2.41-2.5l0.02-0.63c1.03,0.17,1.36-0.17,1.36-0.17l0.02-0.93l0.67,0.02
                                    v-1.18l0.37-0.02v-0.62c1.03-0.39,0.15-0.86,0.15-0.86l-1.9-1.29v-1.29c-3.49-1.81-5.13-1.27-5.13-1.27
                                    c-1.55,0.15-1.25,3.64-1.25,3.64c-1.49-0.39-1.61,0.73-1.61,0.73l-2.65,8.16c-0.32,2.34,2.56,2.27,2.56,2.27
                                    c-1.67,1.67-0.75,3.68-0.75,3.68c0.26,0.11-0.06,5.37-0.06,5.37c-1.55,2.1-1.35,5-1.35,5c-0.06,1.26-0.78,1.69-0.78,1.69
                                    c-1,0.86-0.55,1.75-0.55,1.75l1.96,1.51c-0.31,0.15-0.47,0.28-0.47,0.28l-3.22-0.2c-2-1.35-2.59,1.32-2.59,1.32
                                    c-0.69,2.13,2.03,1.83,2.03,1.83c0.88,0.39,6.53-0.95,6.53-0.95c0.65,1.14,2.41,0.39,2.41,0.39c0.32-0.22,2.37-0.15,2.37-0.15
                                    c0.56-0.11,1.44-2.93,1.44-2.93c0.52,0.37,0,2.22,0,2.22l2.84,1.42c2.15-1.29,3.79-1.14,3.79-1.14c1.7-0.09,0.52-2.37,0.52-2.37
                                    c-0.59-0.36-0.86-1-0.99-1.52c2.11,2.02,2.78,4.35,2.78,4.35l1.26-0.32C42.16,44.89,40.83,42.06,40.83,42.06z M30.3,37.02
                                    c-0.1,1.1-2.32,1.53-2.32,1.53l0.14,2.27c-1.78-0.49-2.15,1.99-2.15,1.99c-0.61-0.21-1.17-0.32-1.67-0.36
                                    c-0.17-0.67-1.25-0.83-1.25-0.83c-0.69-1.29,0-3.13,0-3.13l2.41-5.72l0.72-1.95c0.4-2.04,1.85-1.97,1.85-1.97
                                    c2.74,0.17,2.14,1.03,2.14,1.03c-0.73,2.54-2.07,3.69-2.07,3.69c-0.86,1.32,0,1.69,0,1.69l2.26,1.7
                                    C30.32,37.01,30.3,37.02,30.3,37.02z M32.77,36.14c-0.08-0.07-0.17-0.1-0.28-0.12c-0.01-0.03-0.01-0.04-0.01-0.04
                                    c-0.75-0.04-0.83-0.5-0.83-0.5c-1.22-1.33-0.62-2.08-0.62-2.08l2.67-4.38c0.83-1.7-0.76-2.3-0.76-2.3l-3.71-1.51
                                    c-0.93-0.09-0.52-0.93-0.52-0.93l1.39-2.07l2.99,0.13c0.4,0.73,1.26,0.58,1.62,0.5c0.36-0.07,1.25-1.21,1.25-1.21
                                    c0.26,0.03,0.49,0.04,0.69,0.02L32.77,36.14z M36.27,40.49l0.05-0.04c0,0.03,0.01,0.06,0.01,0.09
                                    C36.3,40.52,36.28,40.51,36.27,40.49z" />
                                <line class="st2" x1="23.87" y1="26.06" x2="32.81" y2="29.12" />
                                <path class="st2" d="M28.5,27.84c-0.11-0.1-0.21-0.19-0.32-0.29l0.27-0.22C28.46,27.49,28.48,27.66,28.5,27.84z" />
                            </svg>
                        </a>
                        <p class="fs-6 mb-2">
                            Climbing inspires people and brings people closer together
                        </p>
                        <!-- list icon -->
                        <ul class="nav text-white align-items-center mb-2" style="margin: 0 -14px;">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="17" fill="none">
                                        <path fill="#fff" d="M6.318 2.8h1.391V.202A16.842 16.842 0 0 0 5.683.088c-2.006 0-3.38 1.353-3.38 3.837v2.287H.089v2.902h2.214v7.303h2.713V9.114H7.14l.338-2.902H5.016v-2c0-.839.21-1.413 1.302-1.413Z"></path>
                                    </svg>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="15" fill="none">
                                        <path fill="#fff" d="M19.687 2.485A2.472 2.472 0 0 0 17.953.73C16.423.313 10.29.313 10.29.313s-6.133 0-7.662.416A2.473 2.473 0 0 0 .895 2.485c-.41 1.55-.41 4.782-.41 4.782s0 3.233.41 4.782c.226.855.89 1.5 1.734 1.729 1.53.415 7.662.415 7.662.415s6.132 0 7.662-.415a2.435 2.435 0 0 0 1.734-1.729c.41-1.549.41-4.782.41-4.782s0-3.232-.41-4.782ZM8.285 10.203v-5.87l5.126 2.934-5.126 2.936Z"></path>
                                    </svg>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="none">
                                        <path fill="#fff" d="M17.477 4.484c.012.165.012.329.012.493 0 5.014-3.817 10.792-10.792 10.792-2.149 0-4.145-.623-5.824-1.703.305.035.599.047.916.047a7.596 7.596 0 0 0 4.709-1.62 3.8 3.8 0 0 1-3.547-2.63c.235.034.47.058.717.058.34 0 .68-.047.998-.13A3.793 3.793 0 0 1 1.625 6.07v-.047a3.82 3.82 0 0 0 1.714.482 3.79 3.79 0 0 1-1.691-3.159c0-.704.188-1.35.517-1.914a10.781 10.781 0 0 0 7.82 3.97 4.282 4.282 0 0 1-.094-.87c0-2.09 1.691-3.793 3.793-3.793 1.092 0 2.079.458 2.771 1.198a7.466 7.466 0 0 0 2.408-.916c-.282.88-.881 1.62-1.668 2.09a7.604 7.604 0 0 0 2.184-.587 8.153 8.153 0 0 1-1.902 1.961Z"></path>
                                    </svg>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="none">
                                        <path fill="#fff" d="M8.788 4.097C6.47 4.097 4.6 5.95 4.6 8.25c0 2.298 1.87 4.153 4.188 4.153 2.318 0 4.188-1.855 4.188-4.153 0-2.3-1.87-4.153-4.188-4.153Zm0 6.853c-1.498 0-2.723-1.211-2.723-2.7 0-1.49 1.221-2.7 2.723-2.7 1.502 0 2.723 1.21 2.723 2.7 0 1.489-1.225 2.7-2.723 2.7Zm5.336-7.023a.97.97 0 0 1-.977.968.97.97 0 0 1-.976-.968c0-.535.437-.969.976-.969.54 0 .977.434.977.969Zm2.774.983c-.062-1.298-.36-2.447-1.32-3.394C14.624.569 13.465.272 12.156.207c-1.349-.076-5.39-.076-6.74 0C4.113.27 2.954.565 1.995 1.512 1.035 2.46.74 3.61.674 4.906c-.076 1.338-.076 5.346 0 6.683.063 1.298.361 2.447 1.32 3.394.959.947 2.114 1.244 3.423 1.309 1.348.076 5.39.076 6.739 0 1.308-.062 2.468-.358 3.422-1.309.956-.947 1.254-2.096 1.32-3.394.076-1.337.076-5.342 0-6.68Zm-1.742 8.114a2.745 2.745 0 0 1-1.553 1.54c-1.075.423-3.627.325-4.815.325-1.188 0-3.743.095-4.815-.325a2.746 2.746 0 0 1-1.552-1.54c-.427-1.066-.329-3.596-.329-4.774 0-1.179-.094-3.712.329-4.775a2.745 2.745 0 0 1 1.552-1.54C5.048 1.512 7.6 1.61 8.788 1.61c1.188 0 3.743-.094 4.815.325a2.745 2.745 0 0 1 1.553 1.54c.426 1.066.328 3.596.328 4.775 0 1.178.098 3.712-.328 4.774Z"></path>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                        <p class="font-6 text-muted m-0">© 2022 Designed by ndd.</p>
                    </div>
                    <!-- menu footer -->
                    <div class="col-lg-9">
                        <div class="row">
                            <!-- column ẩn -->
                            <div class="col-lg-2 col-md-0">
                            </div>
                            <div class="col-lg-2 col-md-0">
                            </div>
                            <!-- column 1 -->
                            <div class="col-6 col-lg-2 col-md-2 p-2">
                                <h6 class="display-6 text-white mb-3">Services</h6>
                                <ul class="nav flex-column">
                                    <?php
                                    $s = new Service();
                                    $arr = $s->getListServiceMenu();
                                    foreach ($arr as $value) {
                                        echo "<li class='nav-item'>
                                                <a class='nav-link ps-0 text-muted' href='service.php'>$value->serviceName</a>
                                            </li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                            <!-- column 2 -->
                            <div class="col-6 col-lg-2 col-md-2 p-2">
                                <h6 class="display-6 text-white mb-3">Tour</h6>
                                <ul class="nav flex-column">
                                    <?php
                                    $s = new CategoryTour();
                                    $list = $s->getListCategoryTour();
                                    foreach ($list as $value) {
                                        echo "<li class='nav-item'>
                                                <a class='nav-link ps-0 text-muted' href='./listtourtocategory.php?id=$value->CategoryTourID'>$value->CategoryTourName</a>
                                            </li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                            <!-- column 3 -->
                            <div class="col-6 col-lg-2 col-md-2 p-2">
                                <h6 class="display-6 text-white mb-3">News</h6>
                                <ul class="nav flex-column">
                                    <?php
                                    $s = new Category();
                                    $arr = $s->getCategoryNameMenu();
                                    foreach ($arr as $value) {
                                        echo "<li class='nav-item'>
                                                <a class='nav-link ps-0 text-muted' href='$value->CategoryName.php'>$value->CategoryName</a>
                                            </li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                            <!-- column 4 -->
                            <div class="col-6 col-md-2 col-sm-2 p-2">
                                <h6 class="display-6 text-white mb-3">Contact</h6>
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link ps-0 text-muted" href="tel:0968590075">+84 968 590 075</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link ps-0 text-muted" href="mailto:nduydu66@gmail.com">nduydu66@gmail.com</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--END Footer -->


        <!-- top top -->
        <a id="totop" class="shadow">
            <i class="text-dark bi bi-arrow-up"></i>
        </a>
        <!-- en to top -->
        <!-- hotline -->
        <div class="hotline shadow">
            <a class="text-dark" href="tel:0968590075">
                <i class="fs-4 bi bi-telephone-forward"></i>
            </a>
        </div>
        <!-- end hotline -->
        <!--END Footer -->
    </div>


    <!-- Jquery Library file -->
    <script src="./assets/js/jquery.min.js"></script>

    <!-- --------- Owl-Carousel js ------------------->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <!-- js bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <!-- ------------ AOS js Library  ------------------------- -->
    <script src="./assets/js/aos.js"></script>
    <!-- js swiper -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <!-- Custom Javascript file -->
    <script src="./assets/js/blog.js"></script>
    <script src="./assets/js/header-footer.js"></script>
</body>

</html>