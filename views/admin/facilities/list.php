<?php
require_once "../shared/admin_header.php";
?>
<style>
  .desc {
    max-width: 400px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Facilities</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Facilities</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Main row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header bg-primary">
              <h3 class="card-title">List Facilities</h3>
            </div>
            <div class="card-body">
              <?php
              require_once "../../../db_connect.php";
              $conn = OpenCon();
              $sql = "SELECT * FROM facilities";
              if ($result = mysqli_query($conn, $sql)) {
                if (mysqli_num_rows($result) > 0) {
              ?>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Facility Name</th>
                        <th >Description</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                      <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['facility_name']; ?></td>
                        <td class="desc" ><?php echo $row['description']; ?></td>
                        <td> <img style="width: 150px; height: 150px;" src="../../../upload/facilities_img/<?php echo $row['image']; ?>" alt="No image"></td>
                        <td>
                          <?php
                          if ($row['status']) {
                          ?>
                            <button class="btn btn-success disabled">
                              <i class="fas fa-check-circle"></i>
                              Available
                            </button>
                          <?php
                          } else {
                          ?>
                            <button class="btn btn-danger disabled">
                              <i class="far fa-times-circle"></i>
                              Disabled
                            </button>
                          <?php
                          }
                          ?>
                        </td>
                        <td>
                          <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</a>
                          <span>
                            <?php
                            if ($row['status']) {
                            ?>
                              <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this facility ?')" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</a>
                            <?php
                            } else {
                            ?>
                              <a href="active.php?id=<?php echo $row['id']; ?>" class="btn btn-success"><i class="fas fa-plus"></i> Active</a>
                            <?php
                            }
                            ?>
                          </span>
                        </td>
                      </tr>
                    <?php
                    }
                    ?>
                  </table>
                <?php
                  // Giải phóng bộ nhớ của biến
                  mysqli_free_result($result);
                } else {
                ?>
                  <tr>
                    <td colspan="4">No Records.</td>
                  </tr>
              <?php
                }
              } else {
                echo "ERROR: Không thể thực thi câu lệnh $sql. " . mysqli_error($conn);
              }
              // Đóng kết nối
              CloseCon($conn);
              ?>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
require_once "../shared/admin_footer.html"

?>

<script type="text/javascript">
  $(function() {
    $("#example1").DataTable({
      "columnDefs": [{
        "width": "10%",
        "targets": 1
      },
        {
        "width": "5%",
        "targets": 0
      }],
      "responsive": true
        // , "lengthChange": false
        ,
      "pageLength": 5
    })
  });
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
    unset($_SESSION['success']);
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
  unset($_SESSION['failed']);
  ?>
</script>