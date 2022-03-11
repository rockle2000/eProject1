<?php
require_once "../shared/admin_header.php";
require_once "../../../db_connect.php";
require_once "../../../util.php";
// unset($_SESSION['success']);
// unset($_SESSION['failed']);

function add($conn)
{
    if (isset($_POST["btn_submit"])) {
        if (isset($_POST["txtFullName"]) && isset($_POST["txtEmail"]) && isset($_POST["txtPhone"])) {
            $fullname = test_input($_POST["txtFullName"]);
            $email = test_input($_POST["txtEmail"]);
            $phone = test_input($_POST["txtPhone"]);
            $time = strtotime($_POST["txtDob"]);
            $dob = date('Y-m-d H:i:s', $time);
            $deparment = test_input($_POST["ddlDepartment"]);
            $role = test_input($_POST["ddlRole"]);
            $status = test_input($_POST["ddlStatus"]);
            if (ctype_space($fullname) || trim($fullname) == "") {
                $_SESSION['failed'] = "Fullname cannot be null";
                return;
            }
            if (ctype_space($email) || trim($email) == "") {
                $_SESSION['failed'] = "Email cannot be null";
                return;
            }
            if (!preg_match("/^(([+]{0,1}\d{2})|\d?)[\s-]?[0-9]{2}[\s-]?[0-9]{3}[\s-]?[0-9]{4}$/", $phone)) {
                $_SESSION['failed'] = "Phone is invalid";
                return;
            }
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['failed'] = "Email is invalid";
                return;
            }
            $stmt = $conn->prepare("SELECT * FROM `employees` WHERE `email` = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows) {
                $_SESSION['failed'] = "Email had already existed";
                mysqli_free_result($result);
                return;
            }
            $stmt = $conn->prepare("INSERT INTO `employees` (`full_name`,`dob`,`email`,`phone_number`,`department_id`,`role_id`,`status`) VALUES (?,?,?,?,?,?,?)");
            $stmt->bind_param("ssssiii", $fullname, $dob, $email, $phone, $deparment, $role, $status);
            $stmt->execute();
            if ($stmt->affected_rows >= 1) {
                $_SESSION['success'] = "Add new employee successfully";
            } else {
                $_SESSION['failed'] = "Add new employee failed !";
            }
            mysqli_free_result($result);
            $stmt->close();
        }
    }
}
$conn = OpenCon();
add($conn);
CloseCon($conn);
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
                            <h3 class="card-title">Add new employee</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" action="add.php" method="POST">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="txtFullName" class="col-sm-2 col-form-label">FullName</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="txtFullName" name="txtFullName" value="" placeholder="Fullname">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="txtDob" class="col-sm-2 col-form-label">Date of birth</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="txtDob" name="txtDob" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="txtEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="txtEmail" name="txtEmail" value="" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="txtPhone" class="col-sm-2 col-form-label">Phone number</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="txtPhone" name="txtPhone" value="" placeholder="Phone number">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ddlRole" class="col-sm-2 col-form-label">Role</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="ddlRole" id="ddlRole">
                                            <?php
                                            $conn = OpenCon();
                                            $sql = "SELECT * FROM roles where `status` = 1";
                                            if ($result = mysqli_query($conn, $sql)) {
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                                        <option value="<?php echo $row["id"]; ?>"><?php echo $row["role"] ?></option>
                                            <?php
                                                    }
                                                    mysqli_free_result($result);
                                                }
                                            } else {
                                                echo "ERROR: Không thể thực thi câu lệnh $sql. " . mysqli_error($conn);
                                            }
                                            CloseCon($conn);
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="ddlDepartment" class="col-sm-2 col-form-label">Department</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="ddlDepartment" id="ddlDepartment">
                                            <?php
                                            $conn = OpenCon();
                                            $sql = "SELECT * FROM departments where `status` = 1";
                                            if ($result = mysqli_query($conn, $sql)) {
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                                        <option value="<?php echo $row["id"]; ?>"><?php echo $row["dept_name"] ?></option>
                                            <?php
                                                    }
                                                    mysqli_free_result($result);
                                                }
                                            } else {
                                                echo "ERROR: Không thể thực thi câu lệnh $sql. " . mysqli_error($conn);
                                            }
                                            CloseCon($conn);
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="ddlStatus" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="ddlStatus" id="ddlStatus">
                                            <option value="1">Available</option>
                                            <option value="0">Disabled</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <a href="list.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to list</a>
                                <button type="submit" name="btn_submit" class="btn btn-success">Add</button>
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
require_once "../shared/admin_footer.html";
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
    unset($_SESSION['success']);
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
    unset($_SESSION['failed']);
    ?>
</script>