<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edmin::Login</title>
    <link type="text/css" href="assets/plugins/edmin/code/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="assets/plugins/edmin/code/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="assets/plugins/edmin/code/css/theme.css" rel="stylesheet">
    <link type="text/css" href="assets/plugins/edmin/code/images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>

    <link type="text/css" href='/assets/plugins/toastr/css/toastr.css' rel='stylesheet'>

</head>
<body>
    <div id="responseBox"></div>

    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                    <i class="icon-reorder shaded"></i>
                </a>

                <a class="brand" href="#">
                    JobCard Customer Login
                </a>

                <div class="nav-collapse collapse navbar-inverse-collapse">
                
                    <ul class="nav pull-right">

                        <li><a href="#">
                            Sign Up
                        </a></li>

                        

                        <li><a href="#">
                            Forgot your password?
                        </a></li>
                    </ul>
                </div><!-- /.nav-collapse -->
            </div>
        </div><!-- /navbar-inner -->
    </div><!-- /navbar -->



    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="module module-login span4 offset4">
                    <form class="form-vertical">
                        <div class="module-head">
                            <h3>Sign In</h3>
                        </div>
                        <div class="module-body">
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <input class="span12" type="text" id="username" placeholder="Enter Username"name="username">
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <input class="span12" type="password"  id="psw" placeholder=" Enter Password" name="psw">
                                </div>
                            </div>
                        </div>
                        <div class="module-foot">
                            <div class="control-group">
                                <div class="controls clearfix">
                                    <button type="button" class="btn btn-primary pull-right" id="login-btn" name="Customer">Login</button>
                                    <label class="checkbox">
                                        <input type="checkbox"> Remember me
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/.wrapper-->

    <div class="footer">
        <div class="container">
             

            <b class="copyright">&copy; 2020 JobCard Computer-ICE Africa.com </b> All rights reserved.
        </div>
    </div>

<script src="assets/plugins/edmin/code/scripts/jquery-1.9.1.min.js" type="text/javascript"></script>

    <script src="assets/plugins/edmin/code/scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    
    <script src="assets/plugins/edmin/code/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

    <script src="assets/plugins/toastr/javascript/toastr.min.js" type="text/javascript"></script>

    <script type="text/javascript" src="/assets/js/login.js"></script>

</body>

</html>