<?php
session_start();
if (!isset($_SESSION['email'])) {
  header('Location: ../login.php');
}
$url = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cambridge Hospital Dashboard</title>
  <link rel="icon" href="../../../assets/img/icons/dashboard.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../../../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../../../plugins/summernote/summernote-bs4.min.css">

  <link rel="stylesheet" href="../../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../../../plugins/toastr/toastr.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>


        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="../../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Cambridge</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo $_SESSION['email'] ?></a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item <?php echo (strpos($url, 'departments/list.php') != false || strpos($url, 'departments/add.php') != false) ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link <?php echo (strpos($url, 'departments/list.php') != false || strpos($url, 'departments/add.php') != false) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-building"></i>
                <p>
                  Departments
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../departments/list.php" class="nav-link  <?php echo strpos($url, '/departments/list.php') != false ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../departments/add.php" class="nav-link  <?php echo strpos($url, '/departments/add.php') != false ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add new department</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item <?php echo (strpos($url, 'centers/list.php') != false || strpos($url, 'centers/add.php') != false) ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link <?php echo (strpos($url, 'centers/list.php') != false || strpos($url, 'centers/add.php') != false) ? 'active' : '' ?>">
                <i class="nav-icon fa fa-clinic-medical"></i>
                <p>
                  Centers
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../centers/list.php" class="nav-link <?php echo strpos($url, 'centers/list.php') != false ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../centers/add.php" class="nav-link <?php echo strpos($url, 'centers/add.php') != false ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add new center</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item <?php echo (strpos($url, 'employees/list.php') != false || strpos($url, 'employees/add.php') != false) ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link <?php echo (strpos($url, 'employees/list.php') != false || strpos($url, 'employees/add.php') != false) ? 'active' : '' ?>">
                <i class="nav-icon fa fa-user-md"></i>
                <p>
                  Employees
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../employees/list.php" class="nav-link <?php echo strpos($url, 'employees/list.php') != false ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../employees/add.php" class="nav-link <?php echo strpos($url, 'employees/add.php') != false ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add new employee</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item <?php echo (strpos($url, 'roles/list.php') != false || strpos($url, 'roles/add.php') != false) ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link <?php echo (strpos($url, 'roles/list.php') != false || strpos($url, 'roles/add.php') != false) ? 'active' : '' ?>">
              <i class="nav-icon fas fa-user-tag"></i>
                <p>
                  Roles
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../roles/list.php" class="nav-link <?php echo strpos($url, 'roles/list.php') != false ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../roles/add.php" class="nav-link <?php echo strpos($url, 'roles/add.php') != false ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add new role</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item <?php echo (strpos($url, 'facilities/list.php') != false || strpos($url, 'facilities/add.php') != false) ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link <?php echo (strpos($url, 'facilities/list.php') != false || strpos($url, 'facilities/add.php') != false) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-warehouse"></i>
                <p>
                  Facilities
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../facilities/list.php" class="nav-link <?php echo strpos($url, 'facilities/list.php') != false ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../facilities/add.php" class="nav-link <?php echo strpos($url, 'facilities/add.php') != false ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add new facility</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-comment-medical"></i>
                <p>
                  Feedbacks
                </p>
              </a>
            </li>
            <li class="nav-item <?php echo (strpos($url, '_services/list.php') != false || strpos($url, '_services/add.php') != false) ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link <?php echo (strpos($url, '_services/list.php') != false || strpos($url, '_services/add.php') != false) ? 'active' : '' ?>">
                <i class="nav-icon fa fa-ambulance"></i>
                <p>
                  Services
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../_services/list.php" class="nav-link <?php echo strpos($url, '_services/list.php') != false ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../_services/add.php" class="nav-link <?php echo strpos($url, '_services/add.php') != false ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add new service</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="../logout.php" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  Sign out
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>