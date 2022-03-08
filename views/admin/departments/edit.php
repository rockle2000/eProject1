<?php
require_once "../shared/admin_header.php";
require_once "../../../db_connect.php";
unset($_SESSION['success']);
unset($_SESSION['failed']);

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $conn = OpenCon();
    $stmt = $conn->prepare("SELECT * FROM `departments` WHERE `id` = ?");
    $stmt->bind_param("i", $_GET["id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = mysqli_fetch_array($result);
    mysqli_free_result($result);
    CloseCon($conn);
}
if (isset($_POST["btn_submit"])) {
    $flag = true;
    $conn = OpenCon();
    if (isset($_POST["txtDeptName"]) && isset($_POST["txtDescription"])) {
        $id = $_POST["txtId"];
        $dept_name = $_POST["txtDeptName"];
        $description = $_POST["txtDescription"];
        $center_id = $_POST["ddlCenter"];
        $status = $_POST["ddlStatus"];
        if (ctype_space($dept_name) || trim($dept_name) == "") {
            $_SESSION['failed'] = "Department name cannot be null";
            $flag = false;
        }
        if (ctype_space($description) || trim($description) == "") {
            $_SESSION['failed'] = "Description cannot be null";
            $flag = false;
        }
        if ($flag) {
            $stmt = $conn->prepare("SELECT * FROM `departments` WHERE `dept_name` = ? and `id` <> ?");
            $stmt->bind_param("si", $dept_name, $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows) {
                $_SESSION['failed'] = "Department name had already existed";
                $flag = false;
            }
            $stmt->close();
        }
        if ($flag) {
            $stmt = $conn->prepare("UPDATE `departments` SET `dept_name` = ?, `description`= ?,`status`=?,`center_id`=? WHERE `id` = ?");
            $stmt->bind_param("ssiii", $dept_name, $description, $status,$center_id, $id);
            $stmt->execute();
            if ($stmt->affected_rows >= 1) {
                $_SESSION['success'] = "Edit department successfully";
            } else {
                $_SESSION['failed'] = "Edit department failed !";
                // echo $conn->error;
            }
            mysqli_free_result($result);
            $stmt->close();
        }
        CloseCon($conn);
        echo ("<script>location.href = '/eProject1/views/admin/departments/list.php';</script>");
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
                        <form class="form-horizontal" action="edit.php" method="POST">
                            <input type="hidden" name="txtId" id="txtId" value="<?php echo $row['id'] ?>">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="txtDeptName" class="col-sm-2 col-form-label">Deparment Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="txtDeptName" name="txtDeptName" value="<?php echo $row['dept_name'] ?>" placeholder="Service name">

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="txtDescription" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="txtDescription" name="txtDescription" value="<?php echo $row['description'] ?>" placeholder="Description">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ddlStatus" class="col-sm-2 col-form-label">Center</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="ddlCenter" id="ddlCenter">
                                            <?php
                                            $conn = OpenCon();
                                            $sql = "SELECT * FROM centers";
                                            if ($result = mysqli_query($conn, $sql)) {
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row1 = mysqli_fetch_array($result)) {
                                            ?>
                                                        <option value="<?php echo $row1["id"]; ?>" <?php if ($row['center_id'] == $row1["id"]) echo "selected" ?>><?php echo $row1["center_name"] ?></option>
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