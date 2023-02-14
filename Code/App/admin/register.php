<?php 

require_once '../PhpSetting/Usersystem.php';

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Icon bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- CSS ME -->
        <link rel="stylesheet" href="./assets/css/login.css">
        <!-- favicon -->
        <link rel="icon" type="image/x-icon" href="./assets/img/admin.ico">
        <title>Register</title>
    </head>
    <body>
        <main class="main" id="top">
            <div class="container d-flex justify-content-center">
                <div class="m-1" style="width: 500px;">
                    <div class="pd-0 col-lg-12 col-md-12 col-sm-12 shadow-lg rounded">
                        <div class="box-login">
                            <div class="mt-4 mb-4 p-4">
                                <div class="box-login-title">
                                    <span class="h3 text-secondary">Register</span>
                                    <a href="#"><i class="fs-3 float-end text-primary bi bi-incognito"></i></a>
                                </div>
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="mt-4">
                                    <div class="mt-2 box-login-user">
                                        <p class="mb-1 fs-5">
                                            Username:
                                        </p>
                                        <div class="input-group mb-3">
                                            <input type="text" name="fusername" class="form-control" placeholder="Username">
                                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        </div>
                                    </div>
                                    <div class="mt-2 box-login-pass">
                                        <p class="mb-1 fs-5">
                                            Password:
                                        </p>
                                        <div class="input-group mb-3">
                                            <input type="password" name="fpassword" class="form-control" placeholder="********">
                                            <span class="input-group-text"><i class="bi bi-key"></i></span>
                                        </div>
                                    </div>
                                    <div class="mt-2 box-login-pass">
                                        <p class="mb-1 fs-5">
                                            Confirm Password:
                                        </p>
                                        <div class="input-group mb-3">
                                            <input type="password" name="fconfirmpass" class="form-control" placeholder="********">
                                            <span class="input-group-text"><i class="bi bi-key"></i></span>
                                        </div>
                                    </div>
                                    <div class="mt-3 btn-login">
                                        <div class="d-flex justify-content-center">
                                            <input type="submit" name="fregister" class="btn btn-primary w-100" value="Register">
                                        </div>
                                    </div>
                                    <div class="mt-3 btn-login text-center d-flex justify-content-center">
                                        <a class="m-2" href="login.php">Login Now</a>
                                    </div>

                                    <?php 
                                
                                    if (!empty($_POST["fregister"])) {
                                            $fuser = $_POST["fusername"];
                                            $fpass = $_POST["fpassword"];
                                            $fpassconfirm = $_POST["fconfirmpass"];

                                            $fpass = md5($fpass);
                                            $fpassconfirm = md5($fpassconfirm);

                                            if ($fuser != '' && $fpass != '' && $fpassconfirm != '') {
                                                $sql = $conn->query("SELECT * FROM `usersystem` WHERE UserName = '$fuser';");
                                                
                                                if ($sql->fetchColumn() > 0) {
                                                    echo "<div class='text-danger text-center'>User name has been register.</div>";
                                                }else{
                                                    // check pass giống nhau
                                                    if($fpass === $fpassconfirm) {
                                                        $ins = $conn->query("INSERT INTO `usersystem` (username, PASSWORD) VALUES('$fuser', '$fpassconfirm');");

                                                        if ($ins) {
                                                        echo '<script>alert("Register success!")</script>';
                                                        echo "<script>
                                                                window.location = 'login.php';
                                                            </script>";
                                                        }
                                                    } else {
                                                        echo '  <div class="mt-2 d-flex justify-content-center">
                                                                    <p class="p-2 text-danger m-0">Passwords must match !</p>
                                                                </div>';
                                                    }

                                                }
                                            }
                                        }

                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Bootstrap với Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="./assets/js/login.js"></script>
    </body>
</html>