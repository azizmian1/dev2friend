<?php $this->load->view('dist/userHeader'); ?>
  <body>

    <div class="az-content az-content-profile">
      <div class="container mn-ht-100p">
        <div class="az-content-left az-content-left-profile">

          <div class="az-profile-overview">
            
            <div class="d-flex justify-content-between mg-b-20">
              <div>
                <h5 class="az-profile-name"><?php echo $this->session->userdata('firstName') . " " . $this->session->userdata('lastName'); ?></h5>
              </div>
              
            </div>


            <hr class="mg-y-30">

            <label class="az-content-label tx-13 mg-b-20">Websites &amp; Social Channel</label>
            <div class="az-profile-social-list">
              <div class="media">
                <div><i class="typcn typcn-social-github-circular"></i></div>
                <div class="media-body">
                  <span>Github</span>
                  <a href="<?php echo $userGithub ?>"><?php echo $userGithub ?></a>
                </div>
              </div><!-- media -->
              <div class="media">
                <div><i class="typcn typcn-social-linkedin"></i></div>
                <div class="media-body">
                  <span>Linkedin</span>
                  <a href="<?php echo $userLinkedin ?>"><?php echo $userLinkedin ?></a>
                </div>
              </div><!-- media -->
              <div class="media">
                <div><i class="typcn typcn-business-card"></i></div>
                <div class="media-body">
                  <span>My Portfolio</span>
                  <a href="<?php echo $userPortfolio ?>"><?php echo $userPortfolio ?></a>
                </div>
              </div><!-- media -->
            </div><!-- az-profile-social-list -->

          </div><!-- az-profile-overview -->
          <br />

        </div><!-- az-content-left -->
        <div class="az-content-body az-content-body-profile">
          <nav class="nav az-nav-line">
            <a href="<?php echo base_url(); ?>Profile" class="nav-link">Projects</a>
            <a href="" class="nav-link active">My Projects</a>
          </nav>

          <div class="card-body">
                  <div class="d-flex">
                    <div class="wrapper">
                      <h4 class="card-title">My Projects</h4>
                    </div>
                    <div class="wrapper">
                    </div>
                  </div>

                  <!-- List of Projects -->
                  <div class="row project-list-showcase">
                    
                  <?php 

                    if (!$myProjects) {
                      // list is empty.
                    }

                    else{

                    $newLetter = ($myProjects[0]->ABBREVIATION)[0];
                    $previousLetter = "";


                      foreach ($myProjects as $myProjects):

                  ?>
                          <div class="az-contact-item <?php if ($selectedId == $myProjects->PROJECT_ID) echo 'selected'; ?>" onclick="location.href = '<?php echo base_url(); ?>Project/UserView/<?php echo $myProjects->PROJECT_ID ?>'">
                            

                              <div class="az-contact-body">
                                  <h6><?php echo $myProjects->ABBREVIATION . " (" . $myProjects->SECURITY_TYPE . ")"?></h6>
                                  <span class="phone"><?php echo $myProjects->DESCRIPTION ?></span>
                              </div><!-- az-contact-body -->
                              <a href="" class="az-contact-star active"><i class="typcn typcn-star"></i></a>
                          </div><!-- az-contact-item -->

                      <?php endforeach; } ?>

                      <!-- end of printing --> 

                      


</div><!-- az-contacts-list -->

                  <!--
                  // TO DO: MODAL
                  foreach($myProjects as $myProject):
                    $randomValue = rand(0, 100);
                    echo '
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12 project-grid">
                      <div class="project-grid-inner">
                        <div class="d-flex align-items-start">
                          <div class="wrapper">
                          <a href="" class="nav-link" data-bs-toggle="modal" data-bs-target="#viewprojectmodal"><h5 class="project-title">' . $myProject->DESCRIPTION . '</h5></a>';
                            echo '<p class="project-location">Project Abbreviation: ' . $myProject->ABBREVIATION . '</p>
                          </div>
                          <div class="badge badge-secondary ms-auto">Ongoing</div>
                        </div>
                        <p class="project-description">' . $myProject->PROJECT_DESCRIPTION . '</p>
                      
                     
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                          <div class="action-tags d-flex flex-row">
                          </div>

                        </div>
                      </div>
                    </div>';
                  endforeach;
                  ?>
                -->
                    
                    
          </div><!-- az-profile-body -->
        </div><!-- az-content-body -->
      </div><!-- container -->
    </div><!-- az-content -->


<?php $this->load->view('dist/footer'); ?>