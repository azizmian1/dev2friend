<?php $this->load->view('dist/header'); ?>

<div class="az-content az-content-app az-content-contacts pd-b-0">
    <div class="container">

        <div class="az-content-left az-content-left-contacts">

            <div class="az-content-breadcrumb lh-1 mg-b-10">
                <span>Main Menu</span>
                <span>Members</span>
            </div>
            <h2 class="az-content-title tx-24 mg-b-30">Members</h2>

            <nav class="nav az-nav-line az-nav-line-chat">
                <a href="<?php echo base_url(); ?>Members" class="nav-link active">All Members</a>
                <a href="<?php echo base_url(); ?>Project" class="nav-link">Projects</a>
            </nav>

            <div id="azContactList" class="az-contacts-list">


                <!-- php code to print the information of the church members -->
            <?php
                $newLetter = ($members[0]->LAST_NAME)[0];
                $previousLetter = "";
                $rowNum = 0;
                
                foreach ($members as $member):
                    $rowNum++;

                    if ($previousLetter != ($member->LAST_NAME)[0]) {
                        $newLetter = ($member->LAST_NAME)[0];
                        $previousLetter = $newLetter;
                        echo '<div class="az-contact-label">' . $newLetter . '</div>';
                    }
                ?>
                    <div class="az-contact-item <?php if ($rowNum == 1) echo 'selected'; ?>" onclick="location.href = '<?php echo base_url(); ?>Members/View/<?php echo $member->MEMBER_ID ?>'">
                        <div class="az-avatar bg-gray-700 online">
                            <!--<img src="../img/faces/face20.jpg" alt="">-->
                            <?php echo $newLetter . ($member->FIRST_NAME)[0]; ?>
                        </div>
                        <div class="az-contact-body">
                            <h6><?php echo $member->LAST_NAME . ', ' . $member->FIRST_NAME ?></h6>
                            <span class="phone"><?php echo $member->EMAIL; ?></span>
                        </div><!-- az-contact-body -->
                        <a href="" class="az-contact-star active"><i class="typcn typcn-star"></i></a>
                    </div><!-- az-contact-item -->
                
                <?php endforeach; ?>


                <!-- end of printing --> 


            </div><!-- az-contacts-list -->

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
                        <?php echo ($members[0]->LAST_NAME)[0] . ($members[0]->FIRST_NAME)[0]; ?>
                        <!--<a href=""><i class="typcn typcn-camera-outline"></i></a>-->
                    </div>
                    <div class="media-body">
                        <h4>
                            <!-- dito ung big header name -->
                            <?php echo $members[0]->LAST_NAME . ', ' . $members[0]->FIRST_NAME ?></h4>
                        <nav class="nav">
                          
                            <!-- Add to Project and Resend QR Code on the header -->
                            <a href="" class="nav-link" data-bs-toggle="modal" data-bs-target="#addtoprojectmodal"><i class="typcn typcn-user-add-outline"></i> Add to Project Group</a>

                        </nav>
                    </div><!-- media-body -->
                </div><!-- media -->


                <div class="az-contact-action">
                    <a href="<?php echo base_url(); ?>Members/Edit/<?php echo $selectedId; ?>"><i class="typcn typcn-edit"></i> Edit Member</a>
                    <a href="" data-bs-toggle="modal" data-bs-target="#yesornomodal"><i class="typcn typcn-trash"></i> Delete Member</a>
                    <a href="<?php echo base_url(); ?>Members/Add"><i class="typcn typcn-document-add"></i> Add Member</a>
                </div><!-- az-contact-action -->

            </div><!-- az-contact-info-header -->
            <div class="az-contact-info-body">
                <div class="media-list">
                    

                <div class="media">
                        <div class="media-body">
                            <div>
                                <label>Github</label>
                                <span class="tx-medium"><a href="<?php echo $members[0]->GITHUB_LINK ?> "><?php echo $members[0]->GITHUB_LINK ?></a></span>
                            </div>
                        </div><!-- media-body -->
                    </div><!-- media -->

                    <div class="media">
                        <div class="media-body">
                            <div>
                                <label>Linkedin</label>
                                <span class="tx-medium"><a href="<?php echo $members[0]->LINKEDIN_LINK ?> "><?php echo $members[0]->LINKEDIN_LINK ?></a></span>
                            </div>
                        </div><!-- media-body -->
                    </div><!-- media -->

                    <div class="media">
                        <div class="media-body">
                            <div>
                                <label>Portfolio</label>
                                <span class="tx-medium"><a href="<?php echo $members[0]->PORTFOLIO_LINK ?> "><?php echo $members[0]->PORTFOLIO_LINK ?></a></span>
                            </div>
                        </div><!-- media-body -->
                    </div><!-- media -->

                    <div class="media">
                        <div class="media-icon align-self-start"><i class="far fa-envelope"></i></div>
                        <div class="media-body">
                            <div>
                                <label>Login Email</label>
                                <span class="tx-medium"><?php echo $members[0]->EMAIL ?></span>
                            </div>
                        </div><!-- media-body -->
                    </div><!-- media -->

                    <div class="media">
                        <div class="media-icon align-self-start"><i class="far fa-envelope"></i></div>
                        <div class="media-body">
                            <div>
                                <label>Contact Email</label>
                                <span class="tx-medium"><?php echo $members[0]->CONTACT_EMAIL ?></span>
                            </div>
                        </div><!-- media-body -->
                    </div><!-- media -->
                  
                    <div class="media">
                        <div class="media-icon align-self-start"><i class="far fa-regular fa-user-check"></i></div>
                        <div class="media-body">
                            <div>
                                <label>Account Status</label>
                                <?php 
                                if($members[0]->ACTIVE_STAT_FLG == 'A') {
                                    echo '<span class="tx-medium">Active</span>';
                                }else {
                                    echo '<span class="tx-medium">Inactive</span>';
                                }
                                ?>
                            </div>
                        </div><!-- media-body -->
                    </div><!-- media -->

                    <div class="media">
                        <div class="media-icon align-self-start"><i class="far fa-regular fa-user"></i></div>
                        <div class="media-body">
                            <div>
                                <label>User Role</label>
                                <span class="tx-medium"><?php echo $members[0]->ACCESS_ROLE_FLG ?></span>
                            </div>
                        </div><!-- media-body -->
                    </div><!-- media -->
                   

            

                </div><!-- media-list -->
            </div><!-- az-contact-info-body -->
        </div><!-- az-content-body -->
    </div>
</div><!-- az-content -->

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
                <p>Are you sure you want to delete the Member Information permanently? </p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-indigo" onclick="location.href = '<?php echo base_url(); ?>Members/Delete/<?php echo $selectedId; ?>'">Save changes</button>
                <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- ADD TO PROJECT MODAL -->
<div id="addtoprojectmodal" class="modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <form method="POST" action="<?php echo base_url(); ?>Members/addToProject/<?php echo $members[0]->MEMBER_ID; ?>" data-parsley-validate>
            <div class="modal-header">
                <h6 class="modal-title">Add to Project</h6>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>Which project would you like to add  <?php echo $members[0]->FIRST_NAME . " " . $members[0]->LAST_NAME ?>?</h6>
                
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

<?php $this->load->view('dist/footer'); ?>

<script>
     // Hide alert after 5 seconds
     $(".alert").delay(5000).slideUp(200, function() {
        $(this).alert('close');
        });
</script>
