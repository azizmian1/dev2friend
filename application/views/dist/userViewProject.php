<?php $this->load->view('dist/userheader'); ?>
<body>
    <div class="az-content az-content-app az-content-contacts pd-b-0">
        <div class="container">

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
            <div class="az-content-body az-content-body-contacts">

                <!-- Alert message for succesfully deleting a member -->
                <?php
                if ($message != '') {
                    echo '<div class="alert alert-success" role="alert">

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Done! </strong>' . $message . '
                </div>';
                }
                ?> 

                <div class="az-contact-info-header">
                    <div class="media">
                        <div class="az-avatar avatar-xxl d-none d-sm-flex online">
                            <!-- <img src="../img/faces/face20.jpg" alt=""> -->
                        
                            <!-- Ung profile pic na bilog -->
                            <?php echo ($selectedProject->ABBREVIATION)[0];?>
                            <!--<a href=""><i class="typcn typcn-camera-outline"></i></a>-->
                        </div>
                        <div class="media-body">
                            <h4>
                                <!-- dito ung big header name -->
                                <?php echo $selectedProject->DESCRIPTION?></h4>

                                <!-- The bio for the main header -->
                            <p><?php echo ($selectedProject->PROJECT_DESCRIPTION); ?></p>                     

                            <nav class="nav">
                            <!-- <a href="<?php echo base_url(); ?>Members" class="nav-link"><i class="typcn typcn-document-add"></i> Add Member</a> -->
                            </nav>                        
                        </div><!-- media-body -->
                    </div><!-- media -->

                    <!-- ACTIONS -->
                    <div class="az-contact-action">
                            <a href="" data-bs-toggle="modal" data-bs-target="#editprojectmodal"><i class="typcn typcn-edit"></i> Edit Project</a>
                            <a href="" data-bs-toggle="modal" data-bs-target="#leaveyesornomodal"><i class="typcn typcn-trash"></i> Leave Project</a>
                            <a href="" data-bs-toggle="modal" data-bs-target="#yesornomodal"><i class="typcn typcn-trash"></i> Delete Project</a>
                            

                            <br>

                    </div><!-- az-contact-action -->

                
                </div><!-- az-contact-info-header -->

                <!-- BODY -->
                <div class="az-contact-info-body">

                <!-- SEPARATION -->
                <br>

                <div class="az-content-label tx-13 mg-b-25"><h6>Project Information</h6></div>

                <div class="az-content-label tx-13 mg-b-25">Recruiter E-mail: <?php echo $selectedProject->PROJ_CONTACT_EMAIL?></div>

                <div class="az-content-label tx-13 mg-b-25">PROJECT PASSWORD: <?php echo $selectedProject->PROJECT_PASSWORD?></div>

                <div class="az-content-label tx-13 mg-b-25">Discord: <a href="<?php echo $selectedProject->DISCORD_LINK?>"><?php echo $selectedProject->DISCORD_LINK?></a></div>

                <div class="az-content-label tx-13 mg-b-25">Github Repository: <a href="<?php echo $selectedProject->GITHUB_LINK?>"><?php echo $selectedProject->GITHUB_LINK?></a></div>
                
                

                    <!-- TABLE CONTENTS: Table where the projects are displayed -->
                    <?php 


                        if ($selectedProject->SECURITY_TYPE == "PRIVATE"){
                        echo '<div class="table-responsive">
                        <table class="table table-striped mg-b-0">
                            <thead>
                            <tr>
                                <th>Row</th>
                                
                                <th>Name</th>
                                
                                <th>Contact</th>
                                
                            </tr>
                            </thead>
                        <tbody>';
                                $rowCount = 1;
                                
                                foreach($projectMembers as $projectMem):
                                    echo '
                                <tr>
                                    <th scope="row">'. $rowCount . '</th>
                                    
                                    <td>'. $projectMem->FIRST_NAME . ' ' . $projectMem->LAST_NAME . '</td>

                                    <td>'. $projectMem->CONTACT_EMAIL . '</td>';
                                    
                                    if($projectMem->MEMBER_ID === $this->session->userdata('memberId'))
                                    {
                                        echo'
                                        <td>
                                            <a href="" data-bs-toggle="modal" data-bs-target="#leaveyesornomodal"><i class="typcn typcn-trash"></i> Leave</a>
                                        </td>';
                                    }
                                    if($projectMem->MEMBER_ID !== $this->session->userdata('memberId'))
                                    {
                                        echo'
                                        <td>
                                            <a href="" data-bs-toggle="modal" data-bs-target="#removemodal"><i class="typcn typcn-trash"></i> Remove</a>
                                        </td>';
                                        //$array = array($projectMem->PROJECT_ID,$projectMem->MEMBER_ID);
                                        //$arg = implode(" ", $array);
                                    }
                                
                                    echo'
                                </tr>';
                                $rowCount++;
                                endforeach;

                            echo '</tbody>
                                </table>
                            </div><!-- bd -->';
                        }

                        else{
                            echo '<div class="table-responsive">
                            <table class="table table-striped mg-b-0">
                                <thead>
                                <tr>
                                    <th>Row</th>
                                    
                                    <th>Name</th>
                                    
                                    <th>Contact</th>
                                    
                                </tr>
                                </thead>
                            <tbody>';
                                    $rowCount = 1;
                                    
                                    foreach($projectMembers as $projectMem):
                                        echo '
                                    <tr>
                                        <th scope="row">'. $rowCount . '</th>
                                        
                                        <td>'. $projectMem->FIRST_NAME . ' ' . $projectMem->LAST_NAME . '</td>
    
                                        <td>'. $projectMem->CONTACT_EMAIL . '</td>
                                        
                                        
                                    </tr>';
                                    $rowCount++;
                                    endforeach;
    
                                echo '</tbody>
                                    </table>
                                </div><!-- bd -->';
                        }

                        ?>
                        <div class="mg-b-20"></div>

                    </div><!-- az-profile-body -->
                </div><!-- az-content-body -->
            </div>
        </div><!-- modal-dialog -->
    </div><!-- modal -->

    <!-- DELETE MODAL -->
    <div id="yesornomodal" class="modal">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Alert</h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the Project Information permanently? </p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-indigo" onclick="location.href = '<?php echo base_url(); ?>Project/UserDelete/<?php echo $selectedId; ?>'">Save changes</button>
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div><!-- modal-dialog -->
    </div><!-- modal -->

    <!-- DELETE MODAL -->
    <div id="leaveyesornomodal" class="modal">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Alert</h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to leave the project permanently? </p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-indigo" onclick="location.href = '<?php echo base_url(); ?>Project/remove/<?php echo $selectedId; ?>'">Save changes</button>
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div><!-- modal-dialog -->
    </div><!-- modal -->

<div id="removemodal" class="modal">
    <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Alert</h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <p>Are you sure you want to remove this member permanently? </p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-indigo" onclick = "location.href = '<?php  echo base_url(); ?>Project/removeMember/<?php echo $projectMem->MEMBER_ID ."/". $selectedId ?>'">Save changes</button>
                <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    <!-- EDIT MODAL -->
    <div id="editprojectmodal" class="modal">
      <div class="modal-dialog" role="document">
          <div class="modal-content modal-content-demo">
            
           <!-- FORM FOR INPUTS -->
           <form method="POST" action="<?php echo base_url(); ?>Project/UserSave/<?php echo $selectedProject->PROJECT_ID; ?>" data-parsley-validate>
           <div class="modal-header">
                  <h6 class="modal-title"> Edit</h6>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">
            <h6>Edit the desired fields</h6>

            <!-- Start of inputs -->
            <div class="az-content-label mg-b-5">Project Name <span class="tx-danger">*</span></div>

            <div class="row row-sm">
                <div class="col-lg">
                    <input class="form-control" placeholder="Project Name" type="text" value="<?php echo $selectedProject->DESCRIPTION; ?>" name="projectName" required>
                </div><!-- col -->
            
            </div><!-- row -->

            <br>

            <div class="az-content-label mg-b-5">Abbreviation<span class="tx-danger">*</span></div>

            <div class="row row-sm wd-400">
                <div class="col-lg mg-t-10 mg-lg-t-0">
                    <input class="form-control" placeholder="Abbreviation Of Project" type="ABBREVIATION" value="<?php echo $selectedProject->ABBREVIATION; ?>" name="projectAbb" required>
                </div><!-- col -->
            </div><!-- row -->

            <br>

            <div class="az-content-label mg-b-5">Project Description</div>

            <div class="row row-sm mg-t-20">
                <div class="col-lg">
                    <textarea rows="10" cols="20" class="form-control" type="text" placeholder="Project Description" name="projectDesc"><?php echo $selectedProject->PROJECT_DESCRIPTION; ?></textarea>
                </div>
            </div>

            <br> 
            
            <div class="az-content-label mg-b-5">Project Password</div>

            <div class="row row-sm mg-t-20">
                <div class="col-lg">
                    <textarea rows="10" cols="20" class="form-control" type="text" placeholder="Project Password" name="projectPass"><?php echo $selectedProject->PROJECT_PASSWORD; ?></textarea>
                </div>
            </div>

            <br> 

            <div class="az-content-label mg-b-5">Recruiter Email</div>

            <div class="row row-sm mg-t-20">
                <div class="col-lg">
                    <textarea rows="10" cols="20" class="form-control" type="text" placeholder="Project Contact" name="contactEmail"><?php echo $selectedProject->PROJ_CONTACT_EMAIL; ?></textarea>
                </div>
            </div>

            <br> 

            <div class="az-content-label mg-b-5">Important Links</div>

            <div class="row row-sm mg-t-20">
                <div class="col-lg">
                    <textarea rows="10" cols="20" class="form-control" type="text" placeholder="Discord Link" name="discordLink"><?php echo $selectedProject->DISCORD_LINK; ?></textarea>
                </div>
            </div>

            <div class="row row-sm mg-t-20">
                <div class="col-lg">
                    <textarea rows="10" cols="20" class="form-control" type="text" placeholder="Github Link" name="githubLink"><?php echo $selectedProject->GITHUB_LINK; ?></textarea>
                </div>
            </div>

            <br>

            <div class="col-lg-4">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button class="btn btn-az-secondary pd-x-25 active">Submit</button>
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div><!-- col-4 -->

            <div class="ht-40"></div>
            </form>

              </div> 
          </div>
      </div><!-- modal-dialog -->
  </div>

    <?php $this->load->view('dist/footer'); ?>
   
</body>
</html>



