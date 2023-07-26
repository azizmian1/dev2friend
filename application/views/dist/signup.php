
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="<?php echo base_url(); ?>assets/js/UA-90680653-2.js"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-90680653-2');
    </script>
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 5 Dashboard Template">
    <meta name="author" content="BootstrapDash">

    <title><?php echo $title; ?></title>

    <!-- vendor css -->
    <link href="<?php echo base_url(); ?>assets/css/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/typicons.font/typicons.css" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/azia.css">

  </head>
  <body class="az-body">

    <div class="az-signup-wrapper">
      <div class="az-column-signup-left">
        <div>
          <h1 class="az-logo">Dev<span>2</span>Friend</h1>
          <h5>Create and Connect</h5>
          <p>Empowering developers with similar interests to connect easily and collaborate towards a common project goal.</p>
        </div>
      </div><!-- az-column-signup-left -->
      <div class="az-column-signup">
      <h1 class="az-logo">Dev<span>2</span>Friend</h1>
        <div class="az-signup-header">
          <h2>Get Started</h2>
          <h4>It's free to signup and only takes a minute.</h4>

          <form method="post" action="<?php echo base_url(); ?>Login/Signup">
            <div class="form-group">
              <label>First Name</label>
              <input type="text" class="form-control" placeholder="Enter your first name" name="firstName" required>
            </div><!-- form-group -->
            <div class="form-group">
              <label>Last Name</label>
              <input type="text" class="form-control" placeholder="Enter your last name" name="lastName" required>
            </div><!-- form-group -->
            <div class="form-group">
              <label>Email</label>
              <input type="text" class="form-control" placeholder="Enter your email" name="email" required>
            </div><!-- form-group -->
            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" placeholder="Enter your password" name="password" required>
            </div><!-- form-group -->

            <!--<div class="form-group">
              <label>Role</label>
              <select name="userRole" class="form-control select2-no-search" required>
                <option label="Choose one"></option>
                <option value="ADMIN">Admin</option>
                <option value="USER">User</option>
              </select>
            </div>-->

            <button class="btn btn-az-primary btn-block">Create Account</button>
            <div class="row row-xs">
              
            </div><!-- row -->
          </form>
        </div><!-- az-signup-header -->
        <div class="az-signup-footer">
          <p>Already have an account? <a href="<?php echo base_url(); ?>Login">Sign In</a></p>
        </div><!-- az-signin-footer -->
      </div><!-- az-column-signup -->
    </div><!-- az-signup-wrapper -->

    
    <script src="<?php echo base_url(); ?>assets/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/ionicons/ionicons/ionicons.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/azia.js"></script>
    <script>
      $(function(){
        'use strict'

      });
    </script>
  </body>
</html>
