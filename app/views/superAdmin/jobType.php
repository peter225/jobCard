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
  <link rel="stylesheet" href="../../assets/plugins/AdminLTE-master1/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

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
    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
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
                <a href="#" class="nav-link active">
                  <i class="fas fa-th nav-icon"></i>
                  <p>Select Job Type</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/superAdmins/adminsList" class="nav-link">
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

 
    <!-- Main content -->
 <section class="content">
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Job Selection</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Task</li>
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
            	<div class="card card-success collapsed-card">
              		<div class="card-header">
              			<h3 class="card-title"></h3>
              				<div class="card-tools">
                  				<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  				</button>
                			</div>
                
              		</div>
              		<!-- /.card-header -->
              		<!-- form start -->
              		
                	<div class="card-body p-0">
		                <table class="table table-striped">
		                  <thead>
		                    <tr>
		                      <th style="width: 10px">#</th>
		                      <th>Categories</th>
		                      <th style="width: 40%;"></th>
		                      
		                    </tr>
		                  </thead>
		                  <tbody>
		                    <tr>
		                      <td>1.</td>
		                      <td>Electronics</td>
		                      <td>
		                      	<div class="form-group">
			                        <div class="custom-control custom-checkbox">
			                          <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
			                          <label for="customCheckbox1" class="custom-control-label">Custom Checkbox</label>
			                        </div>
			                    </div>
		                      </td>
		                      
		                    </tr>
		                    <tr>
		                      <td>2.</td>
		                      <td>Automobiles</td>
		                      <td>
		                        <div class="custom-control custom-checkbox">
		                          <input class="custom-control-input" type="checkbox" id="customCheckbox2" checked>
		                          <label for="customCheckbox2" class="custom-control-label">Custom Checkbox checked</label>
                        		</div>
                        		
		                      </td>
		                      
		                    </tr>
		                    <tr>
		                      <td>3.</td>
		                      <td>PC's(Laptop & Desktop)</td>
		                      <td>
		                        <div class="custom-control custom-checkbox">
		                          <input class="custom-control-input" type="checkbox" id="customCheckbox3" checked>
		                          <label for="customCheckbox3" class="custom-control-label">Custom Checkbox checked</label>
                        		</div>
		                      </td>
		                      
		                    </tr>
		                    <tr>
		                      <td>4.</td>
		                      <td>Mobile Phones</td>
		                      <td>
		                        <div class="custom-control custom-checkbox">
		                          <input class="custom-control-input" type="checkbox" id="customCheckbox4" checked>
		                          <label for="customCheckbox4" class="custom-control-label">Custom Checkbox checked</label>
                        		</div>
		                      </td>
		                      
		                    </tr>
		                  </tbody>
		                </table>
		            </div>
              	

                    
                   
	           <div class="card-footer">
	               <button type="button" class="btn btn-primary" id="saveJobCategory" name="create_job">Save selections
	                </button>
	           </div>
              		
            	</div>
            </div>
            <!-- /.card -->
            
          <!--/.col (left) -->
          <!-- right column -->
          
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
<script src="../../assets/plugins/AdminLTE-master1/dist/js/demo.js"></script>



</body>
</html>

