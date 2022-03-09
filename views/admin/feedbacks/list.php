<?php 
  require_once "../shared/admin_header.php";
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Feedbacks</li>
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
                <h3 class="card-title">List Feedbacks</h3>
              </div>
              <div class="card-body">
          <?php 
            require_once "../../../db_connect.php";
            $conn = OpenCon();
            $sql = "select * from `feedbacks`";
              if ($result = mysqli_query($conn, $sql)) {
                if (mysqli_num_rows($result) > 0) {
                  ?>
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>FullName</th>
                          <th>Email</th>
                          <th>Subject</th>
                          <th>Comment</th>
                          <th>Created At</th>
                        </tr>
                      </thead>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['subject']; ?></td>
                            <td><?php echo $row['comment']; ?></td>
                            <td><?php $time = strtotime($row['created_at']); echo date('d-m-Y',$time); ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </table>
                    <?php
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
         "responsive": true
          // , "lengthChange": false
          , "pageLength": 5
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
