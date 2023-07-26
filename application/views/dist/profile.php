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
            <a href="" class="nav-link active">Projects</a>
            <a href="<?php echo base_url(); ?>Profile/viewMyProject" class="nav-link">My Projects</a>
          </nav>

          <div class="card-body">
                  <div class="d-flex">
                    <div class="wrapper">
                      <h4 class="card-title"> All Projects (<?php echo $projectCount[0]->projectCount; ?>)</h4>
                    </div>
                    
                  </div>

                  <!-- List of Projects -->
                  <div class="row project-list-showcase">
                    
                    <!-- Add to Project and Resend QR Code on the header -->
                    <a href="" class="nav-link" data-bs-toggle="modal" data-bs-target="#createprojectmodal"><h5><i class="typcn typcn-edit"></i>Create a project </h5></a>
                    <a href="" class="nav-link" data-bs-toggle="modal" data-bs-target="#addtoprojectmodal"><h5><i class="typcn typcn-user-add-outline"></i>Join a project </h5></a>
                    
                    <!--filter-->
                        <form name="srch" method="post" action="">
                        <input type="text" placeholder = "Search" name="search"/>
                        <button type="submit" name="submit" hidden></button>
                      </form>
                    <!---->
                    <div class="wrapper">
                    </div>

                    <br>

                  <!-- Code for search filter -->
                  <?php

                    if(isset($_POST['submit']))
                    {
                      $search = $_POST["search"];
                    }
                    else
                    {
                      $search = null;
                    }
                    $reg = "/$search/i";

                  foreach($projects as $project):
                    $randomValue = rand(0, 100);
                    if (preg_match($reg,$project->DESCRIPTION) === 1 or preg_match($reg,$project->ABBREVIATION) === 1 or preg_match($reg,$project->PROJECT_DESCRIPTION) === 1)
                    {
                    echo '
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12 project-grid">
                      <div class="project-grid-inner">
                        <div class="d-flex align-items-start">

                          <div class="wrapper">
                            <a href="" class="nav-link" data-bs-toggle="modal" data-bs-target="#">
                              <h5 class="project-title">' . $project->DESCRIPTION . '</h5>
                            </a>';
                            echo '<p class="project-location">Project Abbreviation: ' . $project->ABBREVIATION .' </p>
                            <p> Contact: ' . $project->PROJ_CONTACT_EMAIL . '</p>
                          </div>

                          <div class="badge badge-secondary ms-auto">' . $project->SECURITY_TYPE . '</div>
                        </div>

                        <p class="project-description">' . $project->PROJECT_DESCRIPTION . '</p>
                        <div class="d-flex justify-content-between">                         
                        </div>

                      
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                          <div class="action-tags d-flex flex-row">
                          </div>
                        </div>
                      </div>
                    </div>';
                  }
                  elseif($search == null)
                  {
                    echo '
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12 project-grid">
                      <div class="project-grid-inner">
                        <div class="d-flex align-items-start">

                          <div class="wrapper">
                            <a href="" class="nav-link" data-bs-toggle="modal" data-bs-target="#">
                              <h5 class="project-title">' . $project->DESCRIPTION . '</h5>
                            </a>';
                            echo '<p class="project-location">Project Abbreviation: ' . $project->ABBREVIATION .' </p>
                            <p class="project-location">Project Abbreviation: ' . $project->ABBREVIATION . '</p>
                          </div>

                          <div class="badge badge-secondary ms-auto">' . $project->SECURITY_TYPE . '</div>
                        </div>

                        <p class="project-description">' . $project->PROJECT_DESCRIPTION . '</p>
                        <div class="d-flex justify-content-between">                         
                        </div>
                      
                        <p class="project-description">' . $project->CONTACT_EMAIL . '</p>
                        <div class="d-flex justify-content-between">                         
                        </div>

                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                          <div class="action-tags d-flex flex-row">
                          </div>
                        </div>
                      </div>
                    </div>';
                  }
                  endforeach;
                  ?>
                    
                    
          </div><!-- az-profile-body -->
        </div><!-- az-content-body -->
      </div><!-- container -->
    </div><!-- az-content -->

  <!-- ADD TO PROJECT MODAL -->
  <div id="addtoprojectmodal" class="modal">
      <div class="modal-dialog" role="document">
          <div class="modal-content modal-content-demo">
              <form method="POST" action="<?php echo base_url(); ?>userMembers/addToProject/<?php echo $this->session->userdata('memberId'); ?>" data-parsley-validate>
              <div class="modal-header">
                  <h6 class="modal-title">Add to Project</h6>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <h6>Which project would you like join?</h6>
                  
                  <!-- Form to add a member to the project selected -->
                  <div>
                      <select name="projects[]" class="form-control wd-350 mg-b-20 select2">
                      <?php
                      
                      $array = array();

                      foreach($memberProjects as $memberProject):
                          array_push($array, $memberProject->PROJECT_ID);
                      endforeach;

                      foreach ($projects as $project):
                          if (in_array($project->PROJECT_ID, $array)) {
                            echo '<option value="' . $project->PROJECT_ID . '" selected>' . $project->DESCRIPTION . '</option>';
                        }
                        else {
                            echo '<option value="' . $project->PROJECT_ID . '">' . $project->DESCRIPTION . '</option>';
                        }
                      endforeach; ?>

                      </select>

                  </div><!-- col -->

                  <div>
                    <br>
                    <input type="text" class="form-control wd-350 mg-b-20 select2" placeholder="Enter the project code" name="project_password">
                  </div>

              </div> 



              <!-- Proceed and Cancel Button -->
              <div class="modal-footer">
                  <input type="submit" class="btn btn-indigo" value="Save">
                  <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Close</button>
              </div> 
              </form>

          </div>
      </div><!-- modal-dialog -->
  </div>

  <!-- ADD PROJECT MODAL -->
  <div id="createprojectmodal" class="modal">
      <div class="modal-dialog" role="document">
          <div class="modal-content modal-content-demo">
            
          <!-- FORM FOR INPUTS -->
          <form method="POST" action="<?php echo base_url(); ?>userProject/addProject" data-parsley-validate>
              <div class="modal-header">
                  <h6 class="modal-title"> Create Project</h6>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <h6>Fill in the required fields</h6>
                  
              <!-- Form to add a member to the project selected -->


                <!-- Start of inputs -->
                <!-- Project Name -->
                <div class="az-content-label mg-b-5">Project Name <span class="tx-danger">*</span></div>

                <div class="row row-sm">
                    <div class="col-lg">
                        <input class="form-control" placeholder="Project Name" type="text" name="project_name" required>
                    </div><!-- col -->
                  
                </div><!-- row -->

                <br>

                <!-- Abbreviation -->
                <div class="az-content-label mg-b-5">Abbreviation</div>

                <div class="row row-sm wd-400">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <input class="form-control" placeholder="Abbreviation Of Project" type="ABBREVIATION" name="project_abbreviation" required>
                    </div><!-- col -->
                </div><!-- row -->

                <br>

                <!-- Project Description -->
                <div class="az-content-label mg-b-5">Project Description</div>

                <div class="row row-sm mg-t-20">
                    <div class="col-lg">
                        <textarea rows="10" cols="20" class="form-control" type="text" placeholder="Project Description" name="project_description"></textarea>
                    </div> <!-- col -->
                </div> <!-- row -->


                <br>

                <!-- Security Type -->
                <div class="form-group">
                <div class="az-content-label mg-b-5">Security Type</div>
                <select name="project_security" class="form-control select2-no-search" required> 
                    <option label="Choose one"></option>
                    <option value="PUBLIC">Public</option>
                    <option value="PRIVATE">Private</option>
                </select>
                </div>

                <br>
                <br>

                <!-- Proceed and Cancel Button -->
                <div class="modal-footer">
                    <input type="submit" class="btn btn-indigo" value="Save">
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Close</button>
                </div> 

                <div class="ht-40"></div>
                </form>
                <!-- End of form -->

              </div> 
          </div>
      </div><!-- modal-dialog -->
  </div>

<?php $this->load->view('dist/footer'); ?>


