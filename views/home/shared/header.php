<style>
  html{
    scroll-behavior: smooth;
  }
</style>
<header>
  <div class="topbar">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 text-sm">
          <div class="site-info">
            <a href="#"><span class="mai-call text-primary"></span> +00 123 4455 6666</a>
            <span class="divider">|</span>
            <a href="#"><span class="mai-mail text-primary"></span> cambrigdehospital@gmail.com</a>
          </div>
        </div>
        <div class="col-sm-4 text-right text-sm">
          <div class="social-mini-button">
            <a href="#"><span class="mai-logo-facebook-f"></span></a>
            <a href="#"><span class="mai-logo-twitter"></span></a>
            <a href="#"><span class="mai-logo-dribbble"></span></a>
            <a href="#"><span class="mai-logo-instagram"></span></a>
          </div>
        </div>
      </div> <!-- .row -->
    </div> <!-- .container -->
  </div> <!-- .topbar -->

  <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="#"><span class="text-primary">Cambridge</span>-Hospital</a>

      <!-- <form action="#">
          <div class="input-group input-navbar">
            <div class="input-group-prepend">
              <span class="input-group-text" id="icon-addon1"><span class="mai-search"></span></span>
            </div>
            <input type="text" class="form-control" placeholder="Enter keyword.." aria-label="Username" aria-describedby="icon-addon1">
          </div>
        </form> -->

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupport">
        <ul class="navbar-nav ml-auto">
          <?php
          $url = $_SERVER['REQUEST_URI'];
            ?>
            <li class="nav-item <?php echo strpos($url, 'home.php') != false ? 'active' : '' ?> ">
            <a class="nav-link" href="home.php">Home</a>
            </li>
            <?php
          ?>
          
          <li class="nav-item <?php echo strpos($url, 'about_us.php') != false ? 'active' : '' ?>">
            <a class="nav-link" href="about_us.php">About Us</a>
          </li>
          <li class="nav-item <?php echo strpos($url, 'department.php') != false ? 'active' : '' ?>">
            <a class="nav-link" href="department.php">Departments</a>
          </li>
          <li class="nav-item <?php echo strpos($url, 'facility.php') != false ? 'active' : '' ?>">
            <a class="nav-link" href="facility.php">Facilities</a>
          </li>
          <li class="nav-item <?php echo strpos($url, 'service.php') != false ? 'active' : '' ?>">
            <a class="nav-link" href="service.php">Services</a>
          </li>
          <li class="nav-item <?php echo strpos($url, 'center.php') != false ? 'active' : '' ?>">
            <a class="nav-link" href="center.php">Centers</a>
          </li>
          <li class="nav-item <?php echo strpos($url, 'contact.php') != false ? 'active' : '' ?>">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
          <li class=" nav-item <?php echo strpos($url, 'stories.php') != false ? 'active' : '' ?>" >
            <a class="smooth-goto nav-link" href="home.php#success_stories">Success Stories</a>
          </li>
        </ul>
      </div> <!-- .navbar-collapse -->
    </div> <!-- .container -->
  </nav>
</header>
<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
<script type="text/javascript">
  if(window.location.hash){
    let hash = window.location.hash;
    if($(hash).length){
      $('html,body').animate({
        scrollTop: $(hash).offset().top
      },900,'');
    }
  }

</script>