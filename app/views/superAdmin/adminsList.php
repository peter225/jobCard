<?php

$superAdmin = '';

if( array_key_exists('superAdmin', $data ) )

$superAdmin = $data['superAdmin'];
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | JobCard Admin Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->

  <link rel="stylesheet" href="../../assets/plugins/AdminLTE-master1/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../assets/plugins/AdminLTE-master1/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../assets/plugins/AdminLTE-master1/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../assets/plugins/AdminLTE-master1/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../assets/plugins/AdminLTE-master1/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-success navbar-light">
    <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
        </ul>

    
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
      
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
    <a href="#" class="brand-link">
      <img src="../../assets/plugins/AdminLTE-master1/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">$admin dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../assets/plugins/AdminLTE-master1/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
            <?php
                                
                echo  $superAdmin->getFirstName() ." " .  $superAdmin->getLastName();

            ?>
                                
          </a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="/superAdmins" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="#"></i>
              </p>
            </a>
          </li> 
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-bolt"></i>
              <p>
                Tasks
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/superAdmins/registration" class="nav-link">
                  <i class="fas fa-th nav-icon"></i>
                  <p>Admin registrations</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/superAdmins/jobType" class="nav-link">
                  <i class="fas fa-th nav-icon"></i>
                  <p>Select Job Type</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="fas fa-th nav-icon"></i>
                  <p>Administrator details</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-th nav-icon"></i>
                  <p>Engineers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-th nav-icon"></i>
                  <p>Accountants</p>
                </a>
              </li>
            </ul>
          </li>
          
         
          <li class="nav-item has-treeview">
            <a href="/Logout" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
                <i class="#"></i>
              </p>
            </a>
            
          </li>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0 text-dark">JobCard Super Admin Dashboard</h3>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-lg"  id="view-admin-btn">
                      Check Admin List
                </button>
          
          <?php include_once('app/includes/modal.php'); ?>

        </div>
    </section>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../assets/plugins/AdminLTE-master1/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../assets/plugins/AdminLTE-master1/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../../assets/plugins/AdminLTE-master1/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>


<!-- Toastr -->
<script src="../../assets/plugins/AdminLTE-master1/plugins/toastr/toastr.min.js"></script>

<!-- DataTables -->
<script src="../../assets/plugins/AdminLTE-master1/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../assets/plugins/AdminLTE-master1/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../assets/plugins/AdminLTE-master1/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../assets/plugins/AdminLTE-master1/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script src="../../assets/plugins/AdminLTE-master1/plugins/moment/moment.min.js"></script>
<!-- AdminLTE App -->
<script src="../../assets/plugins/AdminLTE-master1/dist/js/adminlte.js"></script>
<script type="text/javascript" src="/assets/js/admin_list.js"></script>
</body>
</html>
                                                