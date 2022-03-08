<?php
require_once "../shared/admin_header.php";
require_once "../../../db_connect.php";
unset($_SESSION['success']);
unset($_SESSION['failed']);

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $conn = OpenCon();
    $stmt = $conn->prepare("SELECT * FROM `centers` WHERE `id` = ?");
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
    if (isset($_POST["txtCenterName"]) && isset($_POST["txtDescription"])) {
        $id = $_POST["txtId"];
        $center_name = $_POST["txtCenterName"];
        $description = $_POST["txtDescription"];
        $status = $_POST["ddlStatus"];
        if (ctype_space($center_name) || trim($center_name) == "") {
            $_SESSION['failed'] = "Department name cannot be null";
            $flag = false;
        }
        if (ctype_space($description) || trim($description) == "") {
            $_SESSION['failed'] = "Description cannot be null";
            $flag = false;
        }
        if ($flag) {
            $stmt = $conn->prepare("SELECT * FROM `centers` WHERE `center_name` = ? and `id` <> ?");
            $stmt->bind_param("si", $center_name, $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows) {
                $_SESSION['failed'] = "Center name had already existed";
                $flag = false;
            }
            $stmt->close();
        }
        if ($flag) {
            $stmt = $conn->prepare("UPDATE `centers` SET `center_name` = ?, `description`= ?,`status`=? WHERE `id` = ?");
            $stmt->bind_param("ssii", $center_name, $description, $status, $id);
            $stmt->execute();
            if ($stmt->affected_rows >= 1) {
                $_SESSION['success'] = "Edit center successfully";
            } else {
                $_SESSION['failed'] = "Edit center failed !";
                // echo $conn->error;
            }
            mysqli_free_result($result);
            $stmt->close();
        }
        CloseCon($conn);
        echo ("<script>location.href = '/eProject1/views/admin/centers/list.php';</script>");
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
                            <h3 class="card-title">Edit center</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" action="edit.php" method="POST">
                            <input type="hidden" name="txtId" id="txtId" value="<?php echo $row['id'] ?>">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="txtCenterName" class="col-sm-2 col-form-label">Center Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="txtCenterName" name="txtCenterName" value="<?php echo $row['center_name'] ?>" placeholder="Service name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="txtDescription" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="txtDescription" name="txtDescription" value="<?php echo $row['description'] ?>" placeholder="Description">
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