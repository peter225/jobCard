<?php

$admin = '';

if( array_key_exists('admin', $data ) )

$admin = $data['admin'];

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
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../../assets/plugins/AdminLTE-master1/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../assets/plugins/AdminLTE-master1/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../../assets/plugins/AdminLTE-master1/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../assets/plugins/AdminLTE-master1/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../assets/plugins/AdminLTE-master1/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../../assets/plugins/AdminLTE-master1/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../../assets/plugins/AdminLTE-master1/plugins/summernote/summernote-bs4.css">

  <link rel="stylesheet" href="../../assets/css/table.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/plugins/AdminLTE-master1/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../../assets/plugins/AdminLTE-master1/plugins/toastr/toastr.min.css">
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-success navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
          <i class="fas fa-bars"></i>
        </a>
      </li>
    </ul>
    <!-- Right navbar links -->
    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/Admins" class="brand-link">
      <img src="../../assets/plugins/AdminLTE-master1/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin dashboard</span>
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
                                
                echo  $admin->getFirstName() ." " .  $admin->getLastName();

            ?>
                                
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="/Admins" class="nav-link ">
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
              <li class="nav-item ">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Register Customers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/Admins/task" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Upload Job</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/Admins/userList" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer details</p>
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

 
    <!-- Main content -->
        <section class="content">
          <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Customer Registration</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Registration</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-success">
              <div class="card-header">
                
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" id="customer-data-form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="basicinput">First name</label>
                    <input type="text" name="first-name" class="form-control" id="first-name" placeholder="Enter first name">
                  </div>
                  <div class="form-group">
                    <label for="basicinput">Last name</label>
                    <input type="text" name="last-name" class="form-control" id="last-name" placeholder="Enter Last name">
                  </div>
                  <div class="form-group">
                    <label for="basicinput">Username</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username ">
                  </div>
                  <div class="form-group">
                    <label for="basicinput">Password</label>
                    <input type="password" name="password" class="form-control" id="psw" placeholder="Enter Password" autocomplete>
                  </div>
                  <div class="form-group">
                    <label for="basicinput">Email address</label>
                    <input type="text" name="email" class="form-control" id="email" placeholder="Enter email address">
                  </div>
                  <div class="form-group">
                    <label for="basicinput">Phone Number</label>
                    <input type="text" name="phone-number" class="form-control" id="phone-number" placeholder="Enter Phone number">
                  </div>
                  <div class="form-group">
                    <label for="basicinput">Address</label>
                    <input type="text" name="address" class="form-control" id="address" placeholder="Enter address">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Date of Birth</label>
                    <input type="date" name="dob" class="form-control" id="dob" placeholder="date of birth">
                  </div>
                  <div class="form-group mb-0">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                      <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="button" class="btn btn-primary" id="register_customer">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
        </section>
  
  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
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

<script src="../../assets/plugins/AdminLTE-master1/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Toastr -->
<script src="../../assets/plugins/AdminLTE-master1/plugins/toastr/toastr.min.js"></script>

<script src="../../assets/plugins/AdminLTE-master1/plugins/moment/moment.min.js"></script>
<!-- AdminLTE App -->
<script src="../../assets/plugins/AdminLTE-master1/dist/js/adminlte.js"></script>


<script type="text/javascript" src="/assets/js/registerCustomers.js"></script>
</body>
</html>
                                                