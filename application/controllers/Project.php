<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

    /**
     * CI Config
     *
     * @var CI_Config
     */
    public $db;
    public $email;
    public $session;
    public $form_validation;
    public $upload;
    public $project_model;
    public $member_model;
    public $user_model;

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('project_model');
        $this->load->model('member_model');
        $this->load->model('user_model');
    }

    /**
     * This function is the default function when accessing the Project Controller
     */
    public function index() {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // Get Number of Members
                $data['title'] = "Projects";
                $data['projects'] = $this->project_model->GetProjects();
                $data['projectMembers'] = $this->project_model->getProjectMembers($data['projects'][0]->PROJECT_ID);

                $data['selectedId'] = $data['projects'][0]->PROJECT_ID;
                
                $data['message'] = "";

                $this->load->view('dist/project', $data);
            } else {
                 redirect(base_url() . 'Login');
             }
         }
         else {
             $data = array();
             redirect(base_url() . 'Login');
         }
    }

    /**
     * This function is used to redirect the page to the View project Page
     * @param type $projectId
     */
    public function View($projectId) {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // Get Number of Members
                $data['title'] = "Projects";
                $data['projects'] = $this->project_model->GetProjects();
                $data['selectedId'] = $projectId;
                $data['projectMembers'] = $this->project_model->getProjectMembers($projectId);
                $data['selectedProject'] = $this->project_model->GetProject($projectId)[0];


                $data['message'] = "";
                
                $this->load->view('dist/viewProject', $data);
            }
            else {
                redirect(base_url() . 'Login');
            }
        }
        else {
            redirect(base_url() . 'Login');
        }
    }

    /**
    * This function is used to redirect the page to the User Project Page
    * @param type $projectId
    */
    public function UserView($projectId) {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // Get Number of Members
                $data['title'] = "Projects";
                $data['projects'] = $this->project_model->GetProjects();
                $data['selectedId'] = $projectId;
                $data['projectMembers'] = $this->project_model->getProjectMembers($projectId);
                $data['selectedProject'] = $this->project_model->GetProject($projectId)[0];

                $data['firstName'] = $this->session->userdata('firstName');
                $data['lastName'] = $this->session->userdata('lastName');
                $data['memberId'] = $this->session->userdata('memberId');
                $data['userPass'] = $this->session->userdata('userPass');

                $data['userEmail'] = $this->user_model->GetEmail($this->session->userdata('memberId'));
                $data['userContactEmail'] = $this->user_model->GetContactEmail($this->session->userdata('memberId'));
                $data['userGithub'] = $this->user_model->GetGithub($this->session->userdata('memberId'));
                $data['userLinkedin'] = $this->user_model->GetLinkedin($this->session->userdata('memberId'));
                $data['userPortfolio'] = $this->user_model->GetPortfolio($this->session->userdata('memberId'));

                $data['message'] = "";
                
                $this->load->view('dist/userViewProject', $data);
            }
            else {
                redirect(base_url() . 'Login');
            }
        }
        else {
            redirect(base_url() . 'Login');
        }
    }


     /**
     * This function is used to redirect the page to the Edit Member Screen
     * @param type $memberId
     */
    public function Edit($projectId) {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {
                // Get Number of Members
                $data['title'] = "Edit Project";
                $data['projects'] = $this->project_model->GetProjects();
                $data['selectedId'] = $projectId;
                $data['selectedProject'] = $this->project_model->GetProject($projectId)[0];
                
                $this->load->view('dist/editProject', $data);
            }
            else {
                redirect(base_url() . 'login');
            }
        }
        else {
            redirect(base_url() . 'Login');
        }
    }

    /**
     * This function is used to redirect the page to the Add project Screen
     */
    public function Add() {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // Get Number of Members
                $data['title'] = "Add Project";
                $data['projects'] = $this->project_model->GetProjects();

                $this->load->view('dist/addProject', $data);
            }
            else {
                redirect(base_url() . 'Login');
            }
        }
        else {
            redirect(base_url() . 'Login');
        }
    }


    /**
     * This function is used to add the project information record in the database
     */
    public function addProject() {

        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // To Update Members
                $projectName = $this->input->post('project_name');
                $projectAbbreviation = $this->input->post('project_abbreviation');
                $projectDescription = $this->input->post('project_description');
                $projectSecurityType = $this->input->post('project_security');

                $data['projects'] = $this->project_model->GetProjects();

                if ($projectSecurityType == 'PUBLIC'){
                    $projectPassword = NULL;        
                }

                else{
            
                    $str = rand();
                    $result = md5($str);
                    $projectPassword = $result;

                }
                
                // The correct syntax to pass parameters for the update.
                $data = array();
                $data = array(
                    'DESCRIPTION' => $projectName,
                    'ABBREVIATION' => $projectAbbreviation,
                    'PROJECT_DESCRIPTION' => $projectDescription,
                    'SECURITY_TYPE' => $projectSecurityType,
                    'PROJECT_PASSWORD' => $projectPassword
                    
                );




                // function call saveMember
                $this->project_model->addProject($data);

                redirect(base_url() . 'Project');

            }
            else {
                redirect(base_url() . 'Login');
            }
        }
        else {
            redirect(base_url() . 'Login');
        }
    }

    /**
     * This function is used to save the changes made when editing the Member
     * @param type $memberId
     */
    public function save($projectId) {

        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // To Update Members
                $projectName = $this->input->post('projectName');
                $projectAbb = $this->input->post('projectAbb');
                $projectDesc = $this->input->post('projectDesc');
                

                // The correct syntax to pass parameters for the update.
                $data = array();
                $data = array(
                    'ABBREVIATION' => $projectAbb,
                    'DESCRIPTION' => $projectName,
                    'PROJECT_DESCRIPTION' => $projectDesc
                );

                // function call saveMember
                $this->project_model->saveProject($projectId, $data);

                redirect(base_url() . 'Project/View/' . $projectId);
            }
            else {
                redirect(base_url() . 'Login');
            }
        }
        else {
            redirect(base_url() . 'Login');
        }
    }

        /**
     * This function is used to save the changes made when editing the Member
     * @param type $memberId
     */
    public function UserSave($projectId) {

        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // To Update Members
                $projectName = $this->input->post('projectName');
                $projectAbb = $this->input->post('projectAbb');
                $projectDesc = $this->input->post('projectDesc');
                $projectPass = $this->input->post('projectPass');
                $discordLink = $this->input->post('discordLink');
                $githubLink = $this->input->post('githubLink');
                $contactEmail = $this->input->post('contactEmail');
                

                // The correct syntax to pass parameters for the update.
                $data = array();
                $data = array(
                    'ABBREVIATION' => $projectAbb,
                    'DESCRIPTION' => $projectName,
                    'PROJECT_DESCRIPTION' => $projectDesc,
                    'PROJECT_PASSWORD' => $projectPass,
                    'DISCORD_LINK' => $discordLink,
                    'GITHUB_LINK' => $githubLink,
                    'PROJ_CONTACT_EMAIL' => $contactEmail

                );

                // function call saveMember
                $this->project_model->saveProject($projectId, $data);

                redirect(base_url() . 'Project/UserView/' . $projectId);
            }
            else {
                redirect(base_url() . 'Login');
            }
        }
        else {
            redirect(base_url() . 'Login');
        }
    }

    /**
     * This function is used to delete the project Information Record in the database
     * @param type $projectId
     */
    public function Delete($projectId) {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                $data['message'] = "The project you selected has been successfully deleted.";

                
                $data['title'] = "Projects";

                // function call deleteProject
                $this->project_model->deleteProject($projectId);
                

                // Retrieve the fresh cut of members
                $data['projects'] = $this->project_model->GetProjects();
                $data['selectedId'] = $data['projects'][0]->PROJECT_ID;

                $data['projectMembers'] = $this->project_model->getProjectMembers($projectId);
                $data['selectedProject'] = $this->project_model->GetProject($projectId);

                // then go back to project view
                redirect(base_url() . 'Project');
            }
            else {
                redirect(base_url() . 'Login');
            }
        }
        else {
            $data = array();
            redirect(base_url() . 'Login');
        }
    }

        /**
     * This function is used to delete the project Information Record in the database
     * @param type $projectId
     */
    public function UserDelete($projectId) {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                $data['message'] = "The project you selected has been successfully deleted.";

                
                $data['title'] = "Projects";

                // function call deleteProject
                $this->project_model->deleteProject($projectId);
                

                // Retrieve the fresh cut of members
                $data['projects'] = $this->project_model->GetProjects();
                $data['selectedId'] = $data['projects'][0]->PROJECT_ID;

                $data['projectMembers'] = $this->project_model->getProjectMembers($projectId);
                $data['selectedProject'] = $this->project_model->GetProject($projectId);

                // then go back to project view
                redirect(base_url() . 'Profile/viewMyProject');
            }
            else {
                redirect(base_url() . 'Login');
            }
        }
        else {
            $data = array();
            redirect(base_url() . 'Login');
        }
    }

    public function remove($projectId) {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // function call deleteProject
                $this->project_model->removeFromProject($projectId, $this->session->userdata('memberId'));
                

                // then go back to project view
                redirect(base_url() . 'Profile/viewMyProject');
            }
            else {
                redirect(base_url() . 'Login');
            }
        }
        else {
            $data = array();
            redirect(base_url() . 'Login');
        }
    }
    /////////////////////////////////////////////////////////////////////////////
    public function removeMember($memberId,$projectId) {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // function call deleteProject
                $this->project_model->removeMember($projectId,$memberId);
                

                // then go back to project view
                redirect(base_url() . 'Profile/viewMyProject');
            }
            else {
                redirect(base_url() . 'Login');
            }
        }
        else {
            $data = array();
            redirect(base_url() . 'Login');
        }
    }
/////////////////////////////////////////////////////////////////////////////
}
?>
