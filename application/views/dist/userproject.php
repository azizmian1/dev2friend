<?php $this->load->view('dist/userHeader'); ?>

<div class="az-content az-content-app az-content-contacts pd-b-0">
    <div class="container">
        <div class="az-content-left az-content-left-contacts">

            <div class="az-content-breadcrumb lh-1 mg-b-10">
                <span>Main Menu</span>
                <span>Projects</span>
            </div>
            <h2 class="az-content-title tx-24 mg-b-30">Projects</h2>

            <nav class="nav az-nav-line az-nav-line-chat">
                <a href="<?php echo base_url(); ?>userProject" class="nav-link active">All Projects</a>
                <a href="<?php echo base_url(); ?>userMembers" class="nav-link">Members</a>
                
            </nav>

            <div id="azContactList" class="az-contacts-list">


             <!-- php code to print the information of the church projects -->
             <?php
                $newLetter = ($projects[0]->ABBREVIATION)[0];
                $previousLetter = "";
              

                foreach ($projects as $project):

                    if ($previousLetter != ($project->ABBREVIATION)[0]) {
                        $newLetter = ($project->ABBREVIATION)[0];
                        $previousLetter = $newLetter;
                        echo '<div class="az-contact-label">' . $newLetter . '</div>';
                    }
                    ?>
                    <div class="az-contact-item <?php if ($selectedId == $project->PROJECT_ID) echo 'selected'; ?>" onclick="location.href = '<?php echo base_url(); ?>userProject/View/<?php echo $project->PROJECT_ID ?>'">
                        <div class="az-avatar bg-gray-700 online">
                            <!--<img src="../img/faces/face20.jpg" alt="">-->
                            <?php echo $newLetter ?>
                        </div>
                        <div class="az-contact-body">
                            <h6><?php echo $project->ABBREVIATION ?></h6>
                            <span class="phone"><?php echo $project->DESCRIPTION ?></span>
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
                    
                        <!-- Ung profile pic na bilog -->
                        <?php echo ($projects[0]->ABBREVIATION)[0];?>
                        <!--<a href=""><i class="typcn typcn-camera-outline"></i></a>-->
                    </div>
                    <div class="media-body">
                        <h4>
                            <!-- dito ung big header name -->
                            <?php echo ($projects[0]->DESCRIPTION); ?></h4>

                            <!-- The bio for the main header -->
                         <p><?php echo ($projects[0]->PROJECT_DESCRIPTION); ?></p> 
                        

                    </div><!-- media-body -->
                </div><!-- media -->

                <!-- ACTIONS -->
                
              </div><!-- az-contact-info-header -->

              <!-- BODY -->
            <div class="az-contact-info-body">

            <!-- SEPARATION -->
            <br>
                <div class="az-content-label tx-13 mg-b-25">Project Information</div>
                
                    <!-- TABLE CONTENTS -->
                    <?php 

                        echo '<div class="table-responsive">
                        <table class="table table-striped mg-b-0">
                            <thead>
                            <tr>
                                <th>Row</th>
                                
                                <th>Name</th>
                                
                                
                            </tr>
                            </thead>
                        <tbody>';
                                $rowCount = 1;

                                foreach($projectMembers as $projectMem):
                                    echo '
                                <tr>
                                    <th scope="row">'. $rowCount . '</th>
                                    
                                    <td>'. $projectMem->FIRST_NAME . ' ' . $projectMem->LAST_NAME . '</td>
                                    
                                    
                                </tr>';
                                
                                $rowCount++;
                                endforeach;

                            echo '</tbody>
                                </table>
                            </div><!-- bd -->';
                        
                        ?>
                    <div class="mg-b-20"></div>
                </div><!-- az-profile-body -->
            </div><!-- az-content-body -->
        </div>
    </div><!-- container -->
</div><!-- az-content -->


<?php $this->load->view('dist/footer'); ?>
<script>
    $(function () {
        'use strict'

    
        new PerfectScrollbar('#azContactList', {
            suppressScrollX: true
        });

    new PerfectScrollbar('.az-contact-info-body', {
            suppressScrollX: true
        });

    });
</script>
<script>
     // Hide alert after 5 seconds
     $(".alert").delay(5000).slideUp(200, function() {
        $(this).alert('close');
        });
</script>
</body>
</html>


