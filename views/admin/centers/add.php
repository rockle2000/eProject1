<?php
require_once "../shared/admin_header.php";
require_once "../../../db_connect.php";
// unset($_SESSION['success']);
// unset($_SESSION['failed']);
function add($conn)
{
    if (isset($_POST["btn_submit"])) {
        if (isset($_POST["txtCenterName"]) && isset($_POST["txtDescription"])) {
            $center_name = $_POST["txtCenterName"];
            $description = $_POST["txtDescription"];
            $status = $_POST["ddlStatus"];
            if (ctype_space($center_name) || trim($center_name) == "") {
                $_SESSION['failed'] = "Center name cannot be null";
                return;
            }
            if (ctype_space($description) || trim($description) == "") {
                $_SESSION['failed'] = "Description cannot be null";
                return;
            }
            $stmt = $conn->prepare("SELECT * FROM `centers` WHERE `center_name` = ?");
            $stmt->bind_param("s", $center_name);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows) {
                $_SESSION['failed'] = "Center name had already existed";
                mysqli_free_result($result);
                return;
            }
            $stmt = $conn->prepare("INSERT INTO `centers` (`center_name`, `description`,`status`) VALUES (?,?,?)");
            $stmt->bind_param("ssi", $center_name, $description, $status);
            $stmt->execute();
            if ($stmt->affected_rows >= 1) {
                $_SESSION['success'] = "Add new center successfully";
            } else {
                $_SESSION['failed'] = "Add new center failed !";
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
                            <h3 class="card-title">Add new center</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" action="add.php" method="POST">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="txtCenterName" class="col-sm-2 col-form-label">Center Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="txtCenterName" name="txtCenterName" value="" placeholder="Center Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="txtDescription" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="txtDescription" name="txtDescription" value="" placeholder="Description">
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