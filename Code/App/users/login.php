<?php

require_once '../PhpSetting/Member.php';
require_once '../PhpSetting/Common.php';

if (!empty($_POST["flogin"])) {
    
    if (isset($_POST["fmember"]) && isset($_POST["fpassword"])) {
        $member = $_POST["fmember"];
        $password = $_POST["fpassword"];
        
        
        $a = new Member();
        $a->MemberName=$member;
        $a->Password=md5($password);
        $arr = $a->login();
        
        if(count($arr) > 0) {
            // sử dụng ss
            session_start();
            // tạo ra ss
            $_SESSION["MemberName"] = $member;
            setcookie("MemberName",$member,time()+86400 *30);
            redirect('../index.php');
            
        } else {
            echo '<script>alert("Login Faild !" + "\n" + "Review username & password")</script>';
        }
    }
    
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
        <link rel="stylesheet" href="./assets/css/reset.min.css">
        <!-- BOOTSTRAP 5.0.2 CSS -->
        <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
        <!-- BOOTSTRAP ICON -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <!-- CSS ME -->
        <link rel="stylesheet" href="./assets/css/log.reg.css">
        <link rel="stylesheet" href="./assets/css/base.css">
        <!--favicon-->
        <link rel="icon" type="image/x-icon" href="./assets/image/favicon.png">
        <title>Login</title>
    </head>
    <body>
        <!--BEGIN App -->
        <div class="app">

            <!--BEGIN Main -->
            <div class="main">
                
                <div class="m-5" style="width: 500px;">
                    <div class="mb-4 d-flex justify-content-between">
                        <h2 class="h1 text-shadow text-white">Login</h2>
                        <h2 class="h1 text-shadow text-white">
                            <a onclick="alert('You will still go to the homepage but anonymously !!!')" href="../index.php">Home</a>
                        </h2>
                    </div>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
                        <div class="input-group d-flex flex-column pt-2 mb-3 position-relative">
                            <input type="text" class="form-control rounded" id="logusername" name="fmember" required>
                            <label class="text-shadow text-white">Username</label>
                        </div>
                        <div class="input-group d-flex flex-column pt-2 mb-3 position-relative">
                            <input type="password" class="form-control rounded" id="logpassword" name="fpassword" required>
                            <label class="text-shadow text-white">Password</label>
                        </div>
                        <div class="mb-3 d-flex align-items-center justify-content-between">
                            <div>
                                <a href="#" class="text-white rounded text-shadow">Reset password</a>
                            </div>
                        </div>
                        <div class="input-group d-flex justify-content-center mb-3">
                            <input class="p-2 rounded text-shadow bg-primary w-50" type="submit" id="btnpass" name="flogin" value="Login" >
                        </div>
                    </form>
                    <div class="mb-3 d-flex justify-content-center">
                        <span class="text-shadow text-white">No account?</span>
                        <a href="register.php" class=" text-shadow text-white">Register</a>
                    </div>
                </div>
            </div>
            <!--END Main -->

        </div>
        <!--END App -->

        <!-- JQUERY 3.6.1 -->
        <script src="./assets/js/jquery.min.js"></script>
        <!-- JS BOOTSTRAP -->
        <script src="./assets/js/bootstrap.bundle.min.js"></script>
        <!-- JS ME -->
        <script src="./assets/js/log.reg.js"></script>
    </body>
</html>
