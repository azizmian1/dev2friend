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


    <title><?php echo $title; ?></title>

    <!-- vendor css -->
    <link href="<?php echo base_url(); ?>assets/css/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/typicons.font/typicons.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/spectrum-colorpicker/spectrum.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/select2/css/select2.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/ion-rangeslider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/amazeui-datetimepicker/css/amazeui.datetimepicker.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/jquery-simple-datetimepicker/jquery.simple-dtpicker.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/pickerjs/picker.min.css" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/azia.css">
    <link rel="icon" href="<?php echo base_url(); ?>assets/img/logo.jpeg">

  </head>

  <body>

     <div class="az-header shadow-none">
      <div class="container">
        <div class="az-header-left">
            <!--<a href="<?php echo base_url(); ?>" class="az-logo">Home</a>-->
            <a href="<?php echo base_url(); ?>" class="az-logo"><img src="<?php echo base_url(); ?>assets/img/logo.jpeg" alt="logo.jpeg" width="150" height="60"></a>
          <a href="" id="azNavShow" class="az-header-menu-icon d-lg-none"><span></span></a>
        </div><!-- az-header-left -->
        
        <div class="az-header-right">
          <div class="dropdown az-profile-menu">
            <a href="" class="az-img-user"><img src="<?php echo base_url(); ?>assets/img/avatar.jpg" alt=""></a>
            <div class="dropdown-menu">
              <div class="az-dropdown-header d-sm-none">
                <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
              </div>
              <div class="az-header-profile">
                <div class="az-img-user">
                  <img src="<?php echo base_url(); ?>assets/img/avatar.jpg" alt="">
                </div><!-- az-img-user -->
                <h6><?php echo $this->session->userdata('firstName') . " " . $this->session->userdata('lastName'); ?></h6>
                <?php 
                  if($this->session->userdata('userRoleFlg') == "ADMIN") {
                    echo '<span>System Administrator</span>';
                  }else 
                    echo '<span>User</span>';
                  
                  ?>
              </div><!-- az-header-profile -->

              <a href="" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editprofilemodal"><i class="typcn typcn-edit"></i>Edit Profile</a>
              <a href="<?php echo base_url(); ?>Login/Logout" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Sign Out</a>
            </div><!-- dropdown-menu -->
          </div>
        </div><!-- az-header-right -->
      </div><!-- container -->
    </div><!-- az-header -->

    <div class="az-navbar az-navbar-dashboard-four">
      <div class="container">
        <ul class="nav">
          <li class="nav-item active show">
            <a href="<?php echo base_url(); ?>userMembers" class="nav-link"><i class="typcn typcn-clipboard"></i>Search for Members</a>
            
            
          </li><!-- nav-item -->
          

        </ul><!-- nav -->
      </div><!-- container-fluid -->
    </div><!-- az-navbar -->

 
  </div> <!-- EDIT PROFILE MODAL -->
  <div id="editprofilemodal" class="modal">
      <div class="modal-dialog" role="document">
          <div class="modal-content modal-content-demo">
                          <!-- FORM FOR INPUTS -->
            <form method="POST" action="<?php echo base_url(); ?>userMembers/save/<?php echo $this->session->userdata('memberId')?>" data-parsley-validate>

            <div class="modal-header">
                  <h6 class="modal-title">Edit Profile</h6>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <h6>Fill in the required fields</h6>

              <!-- Start of inputs -->
              <!-- Name -->
              <div class="az-content-label mg-b-5">Name <span class="tx-danger">*</span></div>

              <div class="row row-sm">
                  <div class="col-lg">
                    <input class="form-control" placeholder="First Name" type="text" value="<?php echo $firstName ?>" name="first_name" required>
                  </div><!-- col -->
              </div><!-- row -->

              <hr class="mg-y-30">

              <div class="row row-sm">
                  <div class="col-lg">
                    <input class="form-control" placeholder="Last Name" type="text" value="<?php echo $lastName ?>" name="last_name" required>
                  </div><!-- col -->
              </div><!-- row -->

              <hr class="mg-y-30">

              <!-- Email Address -->
              <div class="az-content-label mg-b-5">Login Email<span class="tx-danger">*</span></div>

              <div class="row row-sm">

                      <input class="form-control" placeholder="Email Address" type="email" value="<?php echo $userEmail?>" name="emailAdd" required>

              </div><!-- row -->

              <hr class="mg-y-30">
              
              <!-- Email Address -->
              <div class="az-content-label mg-b-5">Contact Email</div>

              <div class="row row-sm">

                      <input class="form-control" placeholder="Email Address" type="email" value="<?php echo $userContactEmail?>" name="contactEmailAdd">

              </div><!-- row -->

              <hr class="mg-y-30">

              <!-- Password -->
              <div class="az-content-label mg-b-5">Password<span class="tx-danger">*</span></div>

              <div class="row row-sm">

                      <input class="form-control" placeholder="Password" type="text" value="<?php echo $userPass ?>" name="user_pass" required>

              </div><!-- row -->

              <hr class="mg-y-30">

              <!-- Github -->
              <div class="az-content-label mg-b-5">Github</div>

              <div class="row row-sm">

                      <input class="form-control" placeholder="https://github.com/sample" type="text" value="<?php echo $userGithub ?>" name="githubLink">

              </div><!-- row -->

              <hr class="mg-y-30">

              <!-- Linkedin -->
              <div class="az-content-label mg-b-5">Linkedin</div>

              <div class="row row-sm">

                      <input class="form-control" placeholder="https://Linkedin.com/sample" type="text" value="<?php echo $userLinkedin ?>" name="linkedinLink">

              </div><!-- row -->

              <hr class="mg-y-30">

              <!-- Linkedin -->
              <div class="az-content-label mg-b-5">Portfolio</div>

              <div class="row row-sm">

                      <input class="form-control" placeholder="Wwww.SamplePortfolio.com" type="text" value="<?php echo $userPortfolio ?>" name="portfolioLink">

              </div><!-- row -->

              <hr class="mg-y-30">


              <div class="col-lg-4">
                  <div class="btn-group" role="group" aria-label="Basic example">
                      <button class="btn btn-az-secondary pd-x-25 active">Submit</button>
                      <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Close</button>
                  </div> <!-- btn-group -->
              </div><!-- col-lg-4 -->

              <br>
              <h6>After submitting, please relog to view the changes</h6>

              <div class="ht-40"></div>
            </div>
            </form>
            <!-- End of form -->
          </div>
      </div><!-- modal-dialog -->
  </div>

