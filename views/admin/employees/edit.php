<?php
require_once "../shared/admin_header.php";
require_once "../../../db_connect.php";
require_once "../../../util.php";
unset($_SESSION['success']);
unset($_SESSION['failed']);
if (isset($_POST["btn_submit"])) {
    $flag = true;
    $conn = OpenCon();
    if (isset($_POST["txtFullName"]) && isset($_POST["txtEmail"]) && isset($_POST["txtPhone"])) {
        $id = $_POST["txtId"];
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
            $flag = false;
        }
        if (ctype_space($email) || trim($email) == "") {
            $_SESSION['failed'] = "Email cannot be null";
            $flag = false;
        }
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['failed'] = "Email invalid";
            $flag = false;
        }
        if ($flag) {
            $stmt = $conn->prepare("SELECT * FROM `employees` WHERE `email` = ? and `id` <> ?");
            $stmt->bind_param("si", $email, $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows) {
                $_SESSION['failed'] = "Email had already existed";
                $flag = false;
            }
            $stmt->close();
        }
        if ($flag) {
            $stmt = $conn->prepare("UPDATE `employees` SET `full_name` = ?, `email`= ?,`phone_number`=?,`dob`=?,`role_id`= ?,`department_id`=?,`status`=? WHERE `id` = ?");
            $stmt->bind_param("ssssiiii", $fullname, $email, $phone, $dob, $role, $deparment, $status, $id);
            $stmt->execute();
            if ($stmt->affected_rows >= 1) {
                $_SESSION['success'] = "Edit employee information successfully";
            } else {
                $_SESSION['failed'] = "Edit employee failed !";
                // echo $conn->error;
            }
            mysqli_free_result($result);
            $stmt->close();
        }
        CloseCon($conn);
        echo ("<script>location.href = '/eProject1/views/admin/employees/list.php';</script>");
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
                            <h3 class="card-title">Edit department</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <?php
                        if (isset($_GET["id"]) && !empty($_GET["id"])) {
                            $conn = OpenCon();
                            $stmt = $conn->prepare("SELECT * FROM `employees` WHERE `id` = ?");
                            $id = test_input($_GET["id"]);
                            $stmt->bind_param("i", $id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = mysqli_fetch_array($result);
                            mysqli_free_result($result);
                            CloseCon($conn);
                            if(!$row){
                                // redirect to error page
                                echo ("<script>location.href = '/eProject1/views/admin/shared/error.php';</script>");
                            }
                        }
                        ?>
                        <form class="form-horizontal" action="edit.php" method="POST">
                            <input type="hidden" name="txtId" id="txtId" value="<?php echo $row['id'] ?>">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="txtFullName" class="col-sm-2 col-form-label">Fullname</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="txtFullName" name="txtFullName" value="<?php echo $row['full_name'] ?>" placeholder="Department Name">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="txtDob" class="col-sm-2 col-form-label">Date of birth</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="txtDob" name="txtDob" value="<?php echo $row['dob'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="txtEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="txtEmail" name="txtEmail" value="<?php echo $row['email'] ?>" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="txtPhone" class="col-sm-2 col-form-label">Phone number</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="txtPhone" name="txtPhone" value="<?php echo $row['phone_number'] ?>" placeholder="Phone number">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ddlDepartment" class="col-sm-2 col-form-label">Department</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="ddlDepartment" id="ddlDepartment">
                                            <?php
                                            $conn = OpenCon();
                                            $sql = "SELECT * FROM departments";
                                            if ($result = mysqli_query($conn, $sql)) {
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row1 = mysqli_fetch_array($result)) {
                                            ?>
                                                        <option value="<?php echo $row1["id"]; ?>" <?php if ($row['department_id'] == $row1["id"]) echo "selected" ?>><?php echo $row1["dept_name"] ?></option>
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
                                    <label for="ddlRole" class="col-sm-2 col-form-label">Role</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="ddlRole" id="ddlRole">
                                            <?php
                                            $conn = OpenCon();
                                            $sql = "SELECT * FROM roles";
                                            if ($result = mysqli_query($conn, $sql)) {
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row1 = mysqli_fetch_array($result)) {
                                            ?>
                                                        <option value="<?php echo $row1["id"]; ?>" <?php if ($row['role_id'] == $row1["id"]) echo "selected" ?>><?php echo $row1["role"] ?></option>
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
                                            <option value="1" <?php if ($row['status']) echo "selected"; ?>>Available</option>
                                            <option value="0" <?php if (!$row['status']) echo "selected"; ?>>Disabled</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" name="btn_submit" class="btn btn-success">Save</button>
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