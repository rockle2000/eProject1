<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="copyright" content="MACode ID, https://macodeid.com/">
    <link rel="icon" href="../../assets/img/icons/hospital-building.png">
    <title>Facilities</title>

    <link rel="stylesheet" href="../../assets/css/maicons.css">

    <link rel="stylesheet" href="../../assets/css/bootstrap.css">

    <link rel="stylesheet" href="../../assets/vendor/owl-carousel/css/owl.carousel.css">

    <link rel="stylesheet" href="../../assets/vendor/animate/animate.css">

    <link rel="stylesheet" href="../../assets/css/theme.css">
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
                        <li class="breadcrumb-item active" aria-current="page">Facilities</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Facilities</h1>
            </div> <!-- .container -->
        </div> <!-- .banner-section -->
    </div> <!-- .page-banner -->

    <div class="page-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-4 py-3 wow zoomIn">
                    <div class="card-service">
                        <div class="circle-shape bg-secondary text-white">
                            <span class="mai-chatbubbles-outline"></span>
                        </div>
                        <p><span>Chat</span> with a doctor</p>
                    </div>
                </div>
                <div class="col-md-4 py-3 wow zoomIn">
                    <div class="card-service">
                        <div class="circle-shape bg-primary text-white">
                            <span class="mai-shield-checkmark"></span>
                        </div>
                        <p><span>Health</span> Protection</p>
                    </div>
                </div>
                <div class="col-md-4 py-3 wow zoomIn">
                    <div class="card-service">
                        <div class="circle-shape bg-accent text-white">
                            <span class="mai-basket"></span>
                        </div>
                        <p><span>Cambrigde</span> Pharmacy</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-section">
        <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp">Our Facilities</h1>
            <div class="row justify-content-center">
                <div class="col-lg-12 wow fadeInUp">
                    <?php
                    require_once "../../db_connect.php";
                    $conn = OpenCon();
                    $sql = "SELECT * FROM facilities where `status` = 1";
                    if ($result = mysqli_query($conn, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                    ?>
                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                                <div class="row m-5">
                                    <div class="col-md-3">
                                        <img style="width: 200px; height: 200px;" src="../../upload/facilities_img/<?php echo $row['image']; ?>">
                                    </div>
                                    <div class="col-md-9">
                                        <h3 class="text-success"><?php echo $row['facility_name']; ?></h3>
                                        <span><?php echo $row['description']; ?></span>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                    <?php
                            mysqli_free_result($result);
                        } else {
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

    <div class="page-section banner-home bg-image" style="background-image: url(../assets/img/banner-pattern.svg);">
        <div class="container py-5 py-lg-0">
            <div class="row align-items-center">
                <div class="col-lg-4 wow zoomIn">
                    <div class="img-banner d-none d-lg-block">
                        <img src="../../assets/img/mobile_app.png" alt="">
                    </div>
                </div>
                <div class="col-lg-8 wow fadeInRight">
                    <h1 class="font-weight-normal mb-3">Get easy access of all features using One Health Application</h1>
                    <a href="#"><img src="../assets/img/google_play.svg" alt=""></a>
                    <a href="#" class="ml-2"><img src="../assets/img/app_store.svg" alt=""></a>
                </div>
            </div>
        </div>
    </div> <!-- .banner-home -->

    <?php include_once "shared/footer.php" ?>

</body>

</html>