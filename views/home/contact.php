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

  <title>Contact us</title>

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

  <div class="page-banner overlay-dark bg-image" style="background-image: url(../../assets/img/bg_image_1.jpg);">
    <div class="banner-section">
      <div class="container text-center wow fadeInUp">
        <nav aria-label="Breadcrumb">
          <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contact</li>
          </ol>
        </nav>
        <h1 class="font-weight-normal">Contact</h1>
      </div> <!-- .container -->
    </div> <!-- .banner-section -->
  </div> <!-- .page-banner -->

  <div class="page-section">
    <div class="container">
      <h1 class="text-center wow fadeInUp">Add feedback</h1>

      <form class="contact-form mt-5" action="#" method="POST">
        <div class="row mb-3">
          <div class="col-sm-6 py-2 wow fadeInLeft">
            <label for="txtFullName">Name</label>
            <input type="text" id="txtFullName" name="txtFullName" class="form-control" placeholder="Full name.." required>
          </div>
          <div class="col-sm-6 py-2 wow fadeInRight">
            <label for="txtEmail">Email</label>
            <input type="text" id="txtEmail" name="txtEmail" class="form-control" placeholder="Email address.." required>
          </div>
          <div class="col-12 py-2 wow fadeInUp">
            <label for="txtSubject">Subject</label>
            <input type="text" id="txtSubject" name="txtSubject" class="form-control" placeholder="Enter subject.." required>
          </div>
          <div class="col-12 py-2 wow fadeInUp">
            <label for="txtMessage">Message</label>
            <textarea id="txtMessage" name="txtMessage" class="form-control" rows="8" placeholder="Enter Message.."></textarea>
          </div>
        </div>
        <button type="submit" name="btn_submit" class="btn btn-primary wow zoomIn">Send feedback</button>
      </form>
      <?php
      require_once "../../db_connect.php";
      require_once "../../util.php";
      if (isset($_POST["btn_submit"])) {
        $conn = OpenCon();
        $flag = true;
        if (isset($_POST["txtFullName"]) && isset($_POST["txtEmail"])  && isset($_POST["txtSubject"])&& isset($_POST["txtMessage"])) {
          $full_name = test_input($_POST["txtFullName"]);
          $email = test_input($_POST["txtEmail"]);
          $subject = test_input($_POST["txtSubject"]);
          $message = test_input($_POST["txtMessage"]);
          if (ctype_space($full_name) || trim($full_name) == "") {
            $_SESSION['failed'] = "Full name cannot be null";
            $flag = false;
          }
          if (ctype_space($subject) || trim($subject) == "") {
            $_SESSION['failed'] = "Subject cannot be null";
            $flag = false;
          }
          if (ctype_space($message) || trim($message) == "") {
            $_SESSION['failed'] = "Message cannot be null";
            $flag = false;
          }
          if (!preg_match("/^[a-zA-Z\\s]*$/", $full_name)) {
            $_SESSION['failed'] = "Full name is invalid";
            $flag = false;
          }
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['failed'] = "Email is invalid";
            $flag = false;
        }
          if ($flag) {
            $stmt = $conn->prepare("INSERT INTO `feedbacks` (`name`,`email`,`subject`, `comment`) VALUES (?,?,?,?)");
            $stmt->bind_param("ssss", $full_name, $email, $subject, $message);
            $stmt->execute();
            if ($stmt->affected_rows >= 1) {
              $_SESSION['success'] = "Add feedback successfully";
            } else {
              $_SESSION['failed'] = "Add feedback failed !";
            }
            $stmt->close();
          }
          CloseCon($conn);
        }else{
          echo 'fial';
        }
      } 
      ?>

    </div>
  </div>

  <div class="maps-container wow fadeInUp">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.939013556679!2d105.81047311488346!3d21.035126085994857!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab13464e8961%3A0x840d78ce1df107c6!2zTmcuIDM1IFAuIEtpbSBNw6MgVGjGsOG7o25nLCBD4buRbmcgVuG7iywgQmEgxJDDrG5oLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1645627516255!5m2!1svi!2s" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
  </div>

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