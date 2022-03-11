 <?php
  require_once "../shared/admin_header.php";
  ?>
 <style>
   .desc {
     max-width: 200px;
   }
   .ap_date {
     max-width: 50px;
   }
 </style>
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
             <li class="breadcrumb-item active">Appoinments</li>
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
               <h3 class="card-title">List Appoinments</h3>
             </div>
             <div class="card-body">
               <?php
                require_once "../../../db_connect.php";
                $conn = OpenCon();
                $sql = "SELECT a.id,a.fullname,a.dob,a.phone_number,s.service_name,a.description,a.appointment_date,a.status FROM `appointments` a JOIN `services` s ON a.service_id = s.id";
                if ($result = mysqli_query($conn, $sql)) {
                  if (mysqli_num_rows($result) > 0) {
                ?>
                   <table id="example1" class="table table-bordered table-striped">
                     <thead>
                       <tr>
                         <th>Id</th>
                         <th>Fullname</th>
                         <th>DOB</th>
                         <th>Services</th>
                         <th>Description</th>
                         <th>Booked Date</th>
                         <th>Status</th>
                         <th>Action</th>
                       </tr>
                     </thead>
                     <?php
                      while ($row = mysqli_fetch_array($result)) {
                      ?>
                       <tr>
                         <td><?php echo $row['id']; ?></td>
                         <td><?php echo $row['fullname']; ?></td>
                         <td><?php $time = strtotime($row['dob']);
                              echo date('d-m-Y', $time); ?></td>
                         <td><?php echo $row['service_name']; ?></td>
                         <td class="desc"><?php echo $row['description']; ?></td>
                         <td class="ap_date"><?php $time = strtotime($row['appointment_date']);
                              echo date('d-m-Y', $time); ?></td>
                         <td>
                           <?php
                            if ($row['status'] == 0) {
                            ?>
                             <button class="btn btn-warning disabled text-white">
                               <i class="fas fa-question mr-3"></i>
                               Waiting
                             </button>
                           <?php
                            }
                            if ($row['status'] == -1) {
                            ?>
                             <button class="btn btn-danger disabled">
                               <i class="far fa-times-circle"></i>
                               Canceled
                             </button>
                           <?php
                            }
                            if ($row['status'] == 1) {
                            ?>
                             <button class="btn btn-primary disabled">
                               <i class="fas fa-check-circle mr-1"></i>
                               Accepted
                             </button>
                           <?php
                            }
                            if ($row['status'] == 2) {
                            ?>
                             <button class="btn btn-success disabled">
                               <i class="fas fa-check-double mr-1"></i>
                               Finished
                             </button>
                           <?php
                            }
                            ?>
                         </td>
                         <td>
                           <span>
                             <?php
                              if ($row['status'] == 0) {
                              ?>
                               <a href="accept.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to accept this appointment ?')"  class="btn btn-primary"><i class="fas fa-plus"></i> Accept</a>
                               <a href="cancel.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to cancel this appointment ?')" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Cancel</a>
                             <?php
                              }else if($row['status'] == 1){
                                ?>
                                <a href="finish.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Mark this appointment as finished ?')" class="btn btn-success"><i class="fas fa-check-double mr-1"></i> Finish</a>
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