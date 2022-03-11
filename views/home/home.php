<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="copyright" content="MACode ID, https://macodeid.com/">
  <link rel="icon" href="../../assets/img/icons/hospital-building.png">

  <title>Cambridge Hospital</title>

  <link rel="stylesheet" href="../../assets/css/maicons.css">

  <link rel="stylesheet" href="../../assets/css/bootstrap.css">

  <link rel="stylesheet" href="../../assets/vendor/owl-carousel/css/owl.carousel.css">

  <link rel="stylesheet" href="../../assets/vendor/animate/animate.css">

  <link rel="stylesheet" href="../../assets/css/theme.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
</head>

<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>

  <?php include_once "shared/header.php" ?>

  <div class="page-hero bg-image overlay-dark" style="background-image: url(../../assets/img/bg_image_1.jpg);">
    <div class="hero-section">
      <div class="container text-center wow zoomIn">
        <span class="subhead">Let's make your life happier</span>
        <h1 class="display-4">Healthy Living</h1>
        <a href="home.php#bookAppointment" class="btn btn-primary">Book Appoinment</a>
      </div>
    </div>
  </div>


  <div class="bg-light">
    <div class="page-section py-3 mt-md-n5 custom-index">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-4 py-3 py-md-0">
            <div class="card-service wow fadeInUp">
              <div class="circle-shape bg-secondary text-white">
                <span class="mai-chatbubbles-outline"></span>
              </div>
              <p><span>Chat</span> with a doctor</p>
            </div>
          </div>
          <div class="col-md-4 py-3 py-md-0">
            <div class="card-service wow fadeInUp">
              <div class="circle-shape bg-primary text-white">
                <span class="mai-shield-checkmark"></span>
              </div>
              <p><span>Health</span> Check</p>
            </div>
          </div>
          <div class="col-md-4 py-3 py-md-0">
            <div class="card-service wow fadeInUp">
              <div class="circle-shape bg-accent text-white">
                <span class="mai-basket"></span>
              </div>
              <p><span>Cambrigde</span> Pharmacy</p>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- .page-section -->

    <div class="page-section pb-0">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 py-3 wow fadeInUp">
            <h1>Welcome to Cambridge <br> Hospital</h1>
            <p class="text-grey mb-4">At Cambridge Hospital, the individual needs of our patients and their families are our top priority. As a leading healthcare organization in the Kingdom, we aspire to be the healthcare destination of choice in Riyadh and be recognized for having the most satisfied patients, the best possible clinical outcomes, and the most professional physicians, specialists and staff.</p>
            <a href="about.html" class="btn btn-primary">Learn More</a>
          </div>
          <div class="col-lg-6 wow fadeInRight" data-wow-delay="400ms">
            <div class="img-place custom-img-1">
              <img src="../../assets/img/bg-doctor.png" alt="">
            </div>
          </div>
        </div>
      </div>
    </div> <!-- .bg-light -->
  </div> <!-- .bg-light -->

  <div class="page-section">
    <div class="container">
      <h1 class="text-center mb-5 wow fadeInUp">Our Doctors</h1>

      <div class="owl-carousel wow fadeInUp" id="doctorSlideshow">
        <div class="item">
          <div class="card-doctor">
            <div class="header">
              <img src="../../assets/img/doctors/doctor_1.jpg" alt="">
              <div class="meta">
                <a href="#"><span class="mai-call"></span></a>
                <a href="#"><span class="mai-logo-whatsapp"></span></a>
              </div>
            </div>
            <div class="body">
              <p class="text-xl mb-0">Dr. Stein Albert</p>
              <span class="text-sm text-grey">Founder</span>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="card-doctor">
            <div class="header">
              <img src="../../assets/img/doctors/doctor_2.jpg" alt="">
              <div class="meta">
                <a href="#"><span class="mai-call"></span></a>
                <a href="#"><span class="mai-logo-whatsapp"></span></a>
              </div>
            </div>
            <div class="body">
              <p class="text-xl mb-0">Dr. Alexa Melvin</p>
              <span class="text-sm text-grey">Co-founder</span>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="card-doctor">
            <div class="header">
              <img src="../../assets/img/doctors/doctor_3.jpg" alt="">
              <div class="meta">
                <a href="#"><span class="mai-call"></span></a>
                <a href="#"><span class="mai-logo-whatsapp"></span></a>
              </div>
            </div>
            <div class="body">
              <p class="text-xl mb-0">Dr. Rebecca Steffany</p>
              <span class="text-sm text-grey">Pharmacist</span>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="card-doctor">
            <div class="header">
              <img src="../../assets/img/doctors/doctor_1.jpg" alt="">
              <div class="meta">
                <a href="#"><span class="mai-call"></span></a>
                <a href="#"><span class="mai-logo-whatsapp"></span></a>
              </div>
            </div>
            <div class="body">
              <p class="text-xl mb-0">Dr. Thomas Johnson</p>
              <span class="text-sm text-grey">Respiratory therapist</span>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="card-doctor">
            <div class="header">
              <img src="../../assets/img/doctors/doctor_2.jpg" alt="">
              <div class="meta">
                <a href="#"><span class="mai-call"></span></a>
                <a href="#"><span class="mai-logo-whatsapp"></span></a>
              </div>
            </div>
            <div class="body">
              <p class="text-xl mb-0">Dr. John</p>
              <span class="text-sm text-grey">Medical technologist</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="page-section bg-light" id="success_stories">
    <div class="container">
      <h1 class="text-center wow fadeInUp">Achievements</h1>
      <div class="row mt-5">
        <div class="col-lg-4 py-2 wow zoomIn">
          <div class="card-blog">
            <div class="header">
              <div class="post-category">
                <a href="#">Covid19</a>
              </div>
              <a href="blog-details.html" class="post-thumb">
                <img src="../../assets/img/blog/blog_1.jpg" alt="">
              </a>
            </div>
            <div class="body">
              <h5 class="post-title"><a href="blog-details.html">Healthiest Maryland Business-Gold standard (2020)</a></h5>
              <div class="site-info">
                <div class="avatar mr-2">
                  <div class="avatar-img">
                    <img src="../../assets/img/person/person_1.jpg" alt="">
                  </div>
                  <span>Roger Adams</span>
                </div>
                <span class="mai-time"></span> 1 week ago
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 py-2 wow zoomIn">
          <div class="card-blog">
            <div class="header">
              <div class="post-category">
                <a href="#">Covid19</a>
              </div>
              <a href="blog-details.html" class="post-thumb">
                <img src="../../assets/img/blog/blog_2.jpg" alt="">
              </a>
            </div>
            <div class="body">
              <h5 class="post-title"><a href="blog-details.html">Healogics President's Circle Center of Distinction (2018)</a></h5>
              <div class="site-info">
                <div class="avatar mr-2">
                  <div class="avatar-img">
                    <img src="../../assets/img/person/person_1.jpg" alt="">
                  </div>
                  <span>Roger Adams</span>
                </div>
                <span class="mai-time"></span> 4 weeks ago
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 py-2 wow zoomIn">
          <div class="card-blog">
            <div class="header">
              <div class="post-category">
                <a href="#">Covid19</a>
              </div>
              <a href="blog-details.html" class="post-thumb">
                <img src="../../assets/img/blog/blog_3.jpg" alt="">
              </a>
            </div>
            <div class="body">
              <h5 class="post-title"><a href="blog-details.html">U.S. Department of Health and Human Services’ Silver Recognition for Organ Donations (2018)</a></h5>
              <div class="site-info">
                <div class="avatar mr-2">
                  <div class="avatar-img">
                    <img src="../../assets/img/person/person_2.jpg" alt="">
                  </div>
                  <span>Diego Simmons</span>
                </div>
                <span class="mai-time"></span> 2 months ago
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 text-center mt-4 wow zoomIn">
          <a href="#" class="btn btn-primary">Read More</a>
        </div>

      </div>
    </div>
  </div> <!-- .page-section -->
  <div class="page-section">
    <div class="container" id="bookAppointment">
      <h1 class="text-center wow fadeInUp">Make an Appointment</h1>
      <form class="main-form" action="#" method="POST">
        <div class="row mt-5 ">
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
            <input type="text" class="form-control" placeholder="Full name" id="txtFullName" name="txtFullName" required>
          </div>
          <div class="col-12 col-sm-6 py-2 wow fadeInRight">
            <input type="text" class="form-control" id="txtDob" name="txtDob" placeholder="Date of birth" onfocus="(this.type='date')" onblur="(this.type='text')" required>
          </div>
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
            <input type="text" class="form-control" id="txtDate" name="txtDate" placeholder="Appointment date" onfocus="(this.type='date')" onblur="(this.type='text')" required>
          </div>
          <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
            <select name="ddlService" id="ddlService" class="custom-select">
              <?php
              require_once "../../db_connect.php";
              $conn = OpenCon();
              $sql = "SELECT * FROM services where `status` = 1";
              if ($result = mysqli_query($conn, $sql)) {
                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_array($result)) {
              ?>
                    <option value="<?php echo $row["id"]; ?>"><?php echo $row["service_name"] ?></option>
              <?php
                  }
                  mysqli_free_result($result);
                }
              } else {
                echo "ERROR: Không thể thực thi câu lệnh $sql. " . mysqli_error($conn);
              }
              // Đóng kết nối
              CloseCon($conn);
              ?>
            </select>
          </div>
          <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
            <input type="text" class="form-control" placeholder="PhoneNumber" id="txtPhone" name="txtPhone" required>
          </div>
          <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
            <textarea class="form-control" rows="6" placeholder="Enter message.." id="txtDescription" name="txtDescription"></textarea>
          </div>
        </div>

        <button type="submit" name="btn_submit" class="btn btn-primary mt-3 wow zoomIn">Send</button>
      </form>
      <?php
      require_once "../../db_connect.php";
      require_once "../../util.php";
      if (isset($_POST["btn_submit"])) {
        $conn = OpenCon();
        $flag = true;
        if (isset($_POST["txtFullName"]) && isset($_POST["txtPhone"])  && isset($_POST["txtDob"])  && isset($_POST["txtDate"])) {
          $full_name = test_input($_POST["txtFullName"]);
          $phone = test_input($_POST["txtPhone"]);
          $time = strtotime($_POST["txtDob"]);
          $dob = date('Y-m-d H:i:s', $time);
          $time2 = strtotime($_POST["txtDate"]);
          $ap_date = date('Y-m-d H:i:s', $time2);
          $description = test_input($_POST["txtDescription"]);
          $service_id = $_POST["ddlService"];
          if (ctype_space($full_name) || trim($full_name) == "") {
            $_SESSION['failed'] = "Full name cannot be null";
            $flag = false;
          }
          if (ctype_space($phone) || trim($phone) == "") {
            $_SESSION['failed'] = "Phone number cannot be null";
            $flag = false;
          }
          if (!preg_match("/^[a-zA-Z\\s]*$/", $full_name)) {
            $_SESSION['failed'] = "Full name is invalid";
            $flag = false;
          }
          if (!preg_match("/^(([+]{0,1}\d{2})|\d?)[\s-]?[0-9]{2}[\s-]?[0-9]{3}[\s-]?[0-9]{4}$/", $phone)) {
            $_SESSION['failed'] = "Phone is invalid";
            $flag = false;
          }

          $now = date('Y-m-d H:i:s');
          if($ap_date < $now){
            $_SESSION['failed'] = "Cannot book appoinment on the day in the past";
            $flag = false;
          }
          if($dob > $now){
            $_SESSION['failed'] = "Invalid date of birth";
            $flag = false;
          }
          if ($flag) {
            $stmt = $conn->prepare("INSERT INTO `appointments` (`fullname`,`dob`,`phone_number`, `service_id`,`description`,`appointment_date`) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param("sssiss", $full_name, $dob, $phone, $service_id, $description, $ap_date);
            $stmt->execute();
            if ($stmt->affected_rows >= 1) {
              $_SESSION['success'] = "Book appointment successfully";
            } else {
              $_SESSION['failed'] = "Book appointment failed !";
            }
            $stmt->close();
          }
          CloseCon($conn);
          // echo ("<script>location.href = '/eProject1/views/home/home.php';</script>");
        }
      } 
      ?>
    </div>
  </div> <!-- .page-section -->

  <div class="page-section banner-home bg-image" style="background-image: url(../../assets/img/banner-pattern.svg);">
    <div class="container py-5 py-lg-0">
      <div class="row align-items-center">
        <div class="col-lg-4 wow zoomIn">
          <div class="img-banner d-none d-lg-block">
            <img src="../../assets/img/mobile_app.png" alt="">
          </div>
        </div>
        <div class="col-lg-8 wow fadeInRight">
          <h1 class="font-weight-normal mb-3">Get easy access of all features using One Health Application</h1>
          <a href="#"><img src="../../assets/img/google_play.svg" alt=""></a>
          <a href="#" class="ml-2"><img src="../../assets/img/app_store.svg" alt=""></a>
        </div>
      </div>
    </div>
  </div> <!-- .banner-home -->
  <?php include_once "shared/footer.php" ?>
  <script src="../../plugins/toastr/toastr.min.js"></script>
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
      var message = "<?php echo $_SESSION['failed'] ?>";
      toastr.error(message);
    <?php
      unset($_SESSION['failed']);
    }
    ?>
  </script>
</body>
</html>