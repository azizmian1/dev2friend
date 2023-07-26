<?php $this->load->view('dist/userHeader'); ?>

<div class="az-content az-content-app az-content-contacts pd-b-0">
    <div class="container">  

        <div class="az-content-left az-content-left-contacts">  

            <div class="az-content-breadcrumb lh-1 mg-b-10">
                <span>Members</span>
                <span>View Member</span>
            </div>

            <h2 class="az-content-title tx-24 mg-b-30" onclick="location.href = '<?php echo base_url(); ?>Members'">Members</h2>

            <nav class="nav az-nav-line az-nav-line-chat">
                <a href="<?php echo base_url(); ?>userMembers" class="nav-link active">All Members</a>

            </nav>

            <div id="azContactList" class="az-contacts-list">


                <!-- php code to print the information of the church members -->
                <?php
                $newLetter = ($members[0]->LAST_NAME)[0];
                $previousLetter = "";

                foreach ($members as $member):

                    if ($previousLetter != ($member->LAST_NAME)[0]) {
                        $newLetter = ($member->LAST_NAME)[0];
                        $previousLetter = $newLetter;
                        echo '<div class="az-contact-label">' . $newLetter . '</div>';
                    }
                    ?>
                    <div class="az-contact-item <?php if ($selectedId == $member->MEMBER_ID) echo 'selected'; ?>" onclick="location.href = '<?php echo base_url(); ?>userMembers/View/<?php echo $member->MEMBER_ID ?>'">
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
        <div class="az-contact-info-header">
                <div class="media">
                    <div class="az-avatar avatar-xxl d-none d-sm-flex online">
                        <!-- <img src="../img/faces/face20.jpg" alt=""> -->
                        <?php echo ($selectedMember->LAST_NAME)[0] . ($selectedMember->FIRST_NAME)[0]; ?>
                        <!--<a href=""><i class="typcn typcn-camera-outline"></i></a>-->
                    </div>
                </div><!-- media -->


            </div><!-- az-contact-info-header -->

            <div class="az-contact-info-body">
                <div class="media-list">
                
                    <div class="media">
                        <div class="media-body">
                            <div>
                                <label>Github</label>
                                <span class="tx-medium"><a href="<?php echo $selectedMember->GITHUB_LINK ?> "><?php echo $selectedMember->GITHUB_LINK ?></a></span>
                            </div>
                        </div><!-- media-body -->
                    </div><!-- media -->

                    <div class="media">
                        <div class="media-body">
                            <div>
                                <label>Linkedin</label>
                                <span class="tx-medium"><a href="<?php echo $selectedMember->LINKEDIN_LINK ?> "><?php echo $selectedMember->LINKEDIN_LINK ?></a></span>
                            </div>
                        </div><!-- media-body -->
                    </div><!-- media -->

                    <div class="media">
                        <div class="media-body">
                            <div>
                                <label>Portfolio</label>
                                <span class="tx-medium"><a href="<?php echo $selectedMember->PORTFOLIO_LINK ?> "><?php echo $selectedMember->PORTFOLIO_LINK ?></a></span>
                            </div>
                        </div><!-- media-body -->
                    </div><!-- media -->

                    <div class="media">
                        <div class="media-icon align-self-start"><i class="far fa-envelope"></i></div>
                        <div class="media-body">
                            <div>
                                <label>Email Address</label>
                                <span class="tx-medium"><?php echo $selectedMember->CONTACT_EMAIL ?></span>
                            </div>
                        </div><!-- media-body -->
                    </div><!-- media -->

                    <div class="media">
                        <div class="media-icon align-self-start"><i class="far fa-regular fa-user"></i></div>
                        <div class="media-body">
                            <div>
                                <label>User Role</label>
                                <span class="tx-medium"><?php echo $selectedMember->ACCESS_ROLE_FLG ?></span>
                            </div>
                        </div><!-- media-body -->
                    </div><!-- media -->
                 


                </div><!-- media-list -->
            </div><!-- az-contact-info-body -->
        </div><!-- az-content-body -->
    </div> <!-- container -->
</div><!-- az-content -->


<?php $this->load->view('dist/footer'); ?>







