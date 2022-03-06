<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login V14</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="../../admin_login/images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../../admin_login/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../../admin_login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../../admin_login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../../admin_login/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../../admin_login/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../../admin_login/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../../admin_login/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../../admin_login/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../../admin_login/css/util.css">
    <link rel="stylesheet" type="text/css" href="../../admin_login/css/main.css">
    <!--===============================================================================================-->
</head>

<body>
    <?php
    //Gọi file connection.php ở bài trước
    require_once("../../db_connect.php");
    // Kiểm tra nếu người dùng đã ân nút đăng nhập thì mới xử lý
    if (isset($_POST["btn_submit"])) {
        // lấy thông tin người dùng
        $conn = OpenCon();
        $email = $_POST["email"];
        $password = $_POST["password"];
        //làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
        //mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
        $email = strip_tags($email);
        $email = addslashes($email);
        $password = strip_tags($password);
        $password = addslashes($password);
        $sql = "SELECT email,`password` FROM `admin` WHERE email=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        echo $password;
        echo $row['password'];
        if (password_verify($password, $row['password'])) {
            $_SESSION['email'] = $email;
            header('location: departments/list.php');
        } else {
            $_SESSION['err_login'] = "Invalid username or password";
        }
        $stmt->close();
        CloseCon($conn);
    }
    ?>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
                <form class="login100-form validate-form flex-sb flex-w" action="login.php" method="POST">


                    <?php if (isset($_SESSION['err_login'])) { ?>
                        <div class="alert alert-danger" style="width: 100%;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $_SESSION['err_login']; ?>
                        </div>
                    <?php } ?>
                    <span class="login100-form-title p-b-32 text-center">
                        Admin Login
                    </span>
                    <span class="txt1 p-b-11">
                        Username
                    </span>
                    <div class="wrap-input100 validate-input m-b-36" data-validate="Email is required">
                        <input class="input100" type="text" name="email">
                        <span class="focus-input100"></span>
                    </div>

                    <span class="txt1 p-b-11">
                        Password
                    </span>
                    <div class="wrap-input100 validate-input m-b-12" data-validate="Password is required">
                        <span class="btn-show-pass">
                            <i class="fa fa-eye"></i>
                        </span>
                        <input class="input100" type="password" name="password">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="flex-sb-m w-full p-b-48">
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                            <label class="label-checkbox100" for="ckb1">
                                Remember me
                            </label>
                        </div>

                        <div>
                            <a href="#" class="txt3">
                                Forgot Password?
                            </a>
                        </div>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" name="btn_submit">
                            Login
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="../../admin_login/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="../../admin_login/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="../../admin_login/vendor/bootstrap/js/popper.js"></script>
    <script src="../../admin_login/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="../../admin_login/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="../../admin_login/vendor/daterangepicker/moment.min.js"></script>
    <script src="../../admin_login/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="../../admin_login/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="../../admin_login/js/main.js"></script>

</body>

</html>