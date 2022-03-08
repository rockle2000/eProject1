<?php
require_once "../shared/admin_header.php";
require_once "../../../db_connect.php";
// unset($_SESSION['success']);
// unset($_SESSION['failed']);


$conn = OpenCon();
$stmt = $conn->prepare("SELECT * FROM `centers` WHERE `status` = 1");
$stmt->execute();
$result = $stmt->get_result();
$row = mysqli_fetch_array($result);
mysqli_free_result($result);
CloseCon($conn);

function add($conn)
{
    if (isset($_POST["btn_submit"])) {
        if (isset($_POST["txtDeptName"]) && isset($_POST["txtDescription"])) {
            $dept_name = $_POST["txtDeptName"];
            $description = $_POST["txtDescription"];
            $center_id = $_POST["ddlCenter"];
            $status = $_POST["ddlStatus"];
            if (ctype_space($dept_name) || trim($dept_name) == "") {
                $_SESSION['failed'] = "Department name cannot be null";
                return;
            }
            if (ctype_space($description) || trim($description) == "") {
                $_SESSION['failed'] = "Description cannot be null";
                return;
            }
            $stmt = $conn->prepare("SELECT * FROM `departments` WHERE `dept_name` = ?");
            $stmt->bind_param("s", $dept_name);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows) {
                $_SESSION['failed'] = "Deparment name had already existed";
                mysqli_free_result($result);
                return;
            }
            $stmt = $conn->prepare("INSERT INTO `departments` (`dept_name`,`center_id`, `description`,`status`) VALUES (?,?, ?,?)");
            $stmt->bind_param("sisi", $dept_name,$center_id, $description, $status);
            $stmt->execute();
            if ($stmt->affected_rows >= 1) {
                $_SESSION['success'] = "Add new service successfully";
                return;
            } else {
                $_SESSION['failed'] = "Add new service failed !";
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
                            <h3 class="card-title">Add new department</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" action="add.php" method="POST">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="txtDeptName" class="col-sm-2 col-form-label">Department Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="txtDeptName" name="txtDeptName" value="" placeholder="Department name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="txtDescription" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="txtDescription" name="txtDescription" value="" placeholder="Description">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ddlCenter" class="col-sm-2 col-form-label">Center</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="ddlCenter" id="ddlCenter">
                                            <?php
                                            $conn = OpenCon();
                                            $sql = "SELECT * FROM centers where `status` = 1";
                                            if ($result = mysqli_query($conn, $sql)) {
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                                        <option value="<?php echo $row["id"]; ?>"><?php echo $row["center_name"] ?></option>
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