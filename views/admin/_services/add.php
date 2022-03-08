<?php
require_once "../shared/admin_header.php";
require_once "../../../db_connect.php";
unset($_SESSION['success']);
unset($_SESSION['failed']);
function add($conn)
{
    if (isset($_POST["btn_submit"])) {
        if (isset($_POST["txtServiceName"]) && isset($_POST["txtDescription"])) {
            $service_name = $_POST["txtServiceName"];
            $description = $_POST["txtDescription"];
            $status = $_POST["ddlStatus"];
            if (ctype_space($service_name) || trim($service_name) == "") {
                $_SESSION['failed'] = "Service name cannot be null";
                return;
            }
            if (ctype_space($description) || trim($description) == "") {
                $_SESSION['failed'] = "Description cannot be null";
                return;
            }
            if ($_FILES["fileupload"]["error"] == 4) {
                $_SESSION['failed'] = "Image file cannot be null";
                return;
            }
            // Kiểm tra dữ liệu có bị lỗi không
            if ($_FILES["fileupload"]['error'] != 0) {
                $_SESSION['failed'] = "Error while uploading file";
                return;
            }
            $stmt = $conn->prepare("SELECT * FROM `services` WHERE `service_name` = ?");
            $stmt->bind_param("s", $service_name);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows) {
                $_SESSION['failed'] = "Service name had already existed";
                return;
            }
            // Đã có dữ liệu upload, thực hiện xử lý file upload
            //Thư mục bạn sẽ lưu file upload
            $target_dir    = "../../../upload/services_img/";
            //Vị trí file lưu tạm trong server (file sẽ lưu trong uploads, với tên giống tên ban đầu)
            $target_file   = round(microtime(true) * 1000) . basename($_FILES["fileupload"]["name"]);
            $allowUpload   = true;
            //Lấy phần mở rộng của file (jpg, png, ...)
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            //Những loại file được phép upload
            $allowtypes    = array('jpg', 'png', 'jpeg', 'gif');
            // Kiểm tra kiểu file
            if (!in_array($imageFileType, $allowtypes)) {
                $_SESSION['failed'] = "Image type allowed are JPG, PNG, JPEG, GIF";
                $allowUpload = false;
                return;
            }
            if ($allowUpload) {
                // Xử lý di chuyển file tạm ra thư mục cần lưu trữ, dùng hàm move_uploaded_file
                if (move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target_dir . $target_file)) {
                } else {
                    $_SESSION['failed'] = "Error while uploading file.";
                    return;
                }
            } else {
                $_SESSION['failed'] = "Error";
                return;
            }
            $stmt = $conn->prepare("INSERT INTO `services` (`service_name`, `description`, `image`,`status`) VALUES (?, ?, ?,?)");
            $stmt->bind_param("sssi", $service_name, $description, $target_file, $status);
            $stmt->execute();
            if ($stmt->affected_rows >= 1) {
                $_SESSION['success'] = "Add new service successfully";
            } else {
                $_SESSION['failed'] = "Add new service failed !";
            }
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
                            <h3 class="card-title">Add new service</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" action="add.php" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="txtServiceName" class="col-sm-2 col-form-label">Service Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="txtServiceName" name="txtServiceName" value="" placeholder="Service name">
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
                                <div class="form-group row">
                                    <label for="fileupload" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <input type="file" multiple class="form-control" id="fileupload" name="fileupload">
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