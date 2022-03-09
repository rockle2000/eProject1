<?php
require_once "../shared/admin_header.php";
require_once "../../../db_connect.php";
unset($_SESSION['success']);
unset($_SESSION['failed']);
if (isset($_POST["btn_submit"])) {
    $conn = OpenCon();
    if (isset($_POST["txtEmail"]) && isset($_POST["txtPassword"]) && isset($_POST["txtFullname"])) {
        $email = $_POST["txtEmail"];
        $password = $_POST["txtPassword"];
        $fullname = $_POST["txtFullname"];
        //làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
        //mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
        $email = strip_tags($email);
        $email = addslashes($email);
        $password = strip_tags($password);
        $password = addslashes($password);
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("SELECT * FROM `admin` WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows) {
            $_SESSION['failed'] = "Email had already existed";
        } else {
            $stmt = $conn->prepare("INSERT INTO `admin` (email, `password`, full_name) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $email, $password_hash, $fullname);
            $stmt->execute();
            if ($stmt->affected_rows >= 1) {
                $_SESSION['success'] = "Add new account successfully";
            } else {
                $_SESSION['failed'] = "Error";
            }
        }
        $stmt->close();
        CloseCon($conn);
    } else {
        $_SESSION['failed'] = "Invalid input";
    }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid ">
            <div class="row">
                <!-- <div class="col-md-2"></div>  -->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Add new account for admin</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" action="register.php" method="POST">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="txtEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="txtEmail" name="txtEmail" value="" placeholder=" Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="txtFullname" class="col-sm-2 col-form-label">Fullname</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="txtFullname" name="txtFullname" value="" placeholder="Fullname">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="txtPassword" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="txtPassword" name="txtPassword" value="" placeholder="Password">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button class="btn btn-success" name="btn_submit">Add</button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    <!-- /.card -->
                    <!-- <div class="col-md-2"></div>  -->
                </div>
                <!--/.col (left) -->
            </div>
        </div>
    </div>
</div>
<?php
require_once "../shared/admin_footer.html"

?>
<script type="text/javascript">
    <?php
    if (isset($_SESSION['success'])) {
    ?>
        toastr.options = {
            "timeOut": 3000,
            "progressBar": true
        }
        var message = "<?php echo $_SESSION['success'] ?>";
        toastr.success(message);
    <?php
    }
    ?>

    <?php
    if (isset($_SESSION['failed'])) {
    ?>
        toastr.options = {
            "timeOut": 3000,
            "progressBar": true
        }
        var message = '<?php echo $_SESSION["failed"] ?>';
        toastr.error(message);
    <?php
    }

    ?>
</script>