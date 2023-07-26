<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

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
    public $member_model;
    public $project_model;
    public $login_model;
    public $user_model;
    

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('member_model');
        $this->load->model('project_model');
        $this->load->model('login_model');
        $this->load->model('user_model');
        $this->load->model('project_model');

    }

    /**
     * This function is the default function when accessing the Profile Controller
     */
    public function index() {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // Get Number of Members
                $data['title'] = "Profile";
                $data['members'] = $this->member_model->GetMembers();
                $data['selectedId'] = $data['members'][0]->MEMBER_ID;
                $data['projects'] = $this->project_model->GetProjects();
                $data['selectedMemberId'] = $data['members'][0]->MEMBER_ID;
                $data['selectedProjectId'] = $data['projects'][1]->PROJECT_ID;

                $data['firstName'] = $this->session->userdata('firstName');
                $data['lastName'] = $this->session->userdata('lastName');
                $data['memberId'] = $this->session->userdata('memberId');
                $data['userPass'] = $this->session->userdata('userPass');

                $data['userEmail'] = $this->user_model->GetEmail($this->session->userdata('memberId'));
                $data['userContactEmail'] = $this->user_model->GetContactEmail($this->session->userdata('memberId'));
                $data['userGithub'] = $this->user_model->GetGithub($this->session->userdata('memberId'));
                $data['userLinkedin'] = $this->user_model->GetLinkedin($this->session->userdata('memberId'));
                $data['userPortfolio'] = $this->user_model->GetPortfolio($this->session->userdata('memberId'));
                
                $data['projectCount'] = $this->project_model->countProjects();
                
                $data['projectMembers'] = $this->project_model->getProjectMembers($data['projects'][0]->PROJECT_ID);

                $data['myProjects'] = $this->project_model->GetMyProjects($data['memberId']);

                $data['message'] = "";

                $this->load->view('dist/profile', $data);
            } 
            else {
                redirect(base_url() . 'Login');
            }
        } 
        else {
            redirect(base_url() . 'Login');
        }
    }

    // TODO:
    public function viewMyProject() {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // Get Number of Members
                $data['title'] = "Profile";
                $data['members'] = $this->member_model->GetMembers();
                $data['selectedId'] = $data['members'][0]->MEMBER_ID;
                $data['projects'] = $this->project_model->GetProjects();
                $data['selectedMemberId'] = $data['members'][0]->MEMBER_ID;
                $data['selectedProjectId'] = $data['projects'][0]->PROJECT_ID;

                $data['firstName'] = $this->session->userdata('firstName');
                $data['lastName'] = $this->session->userdata('lastName');
                $data['memberId'] = $this->session->userdata('memberId');
                $data['userPass'] = $this->session->userdata('userPass');

                $data['userEmail'] = $this->user_model->GetEmail($this->session->userdata('memberId'));
                $data['userContactEmail'] = $this->user_model->GetContactEmail($this->session->userdata('memberId'));
                $data['userGithub'] = $this->user_model->GetGithub($this->session->userdata('memberId'));
                $data['userLinkedin'] = $this->user_model->GetLinkedin($this->session->userdata('memberId'));
                $data['userPortfolio'] = $this->user_model->GetPortfolio($this->session->userdata('memberId'));

                $data['projectCount'] = $this->project_model->countProjects();

                $data['myProjectsCount'] = $this->project_model->countMyProjects($data['memberId']);

                $data['projectMembers'] = $this->project_model->getProjectMembers($data['projects'][0]->PROJECT_ID);

                $data['myProjects'] = $this->project_model->GetMyProjects($data['memberId']);
                $data['message'] = "";

                $this->load->view('dist/viewMyProjects', $data);
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
     * This function is used to redirect the page to the View Project Page
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
     * This function is used to redirect the page to the Add Project Screen
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
     * This function is used to add the Project information record in the database
     */
    public function addProject() {

        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // To Update Members
                $projectName = $this->input->post('project_name');
                $projectAbbreviation = $this->input->post('project_abbreviation');
                $projectDescription = $this->input->post('project_description');

                $data['projects'] = $this->project_model->GetProjects();

                
                // The correct syntax to pass parameters for the update.
                $data = array();
                $data = array(
                    'DESCRIPTION' => $projectName,
                    'ABBREVIATION' => $projectAbbreviation,
                    'PROJECT_DESCRIPTION' => $projectDescription
                    
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
     * This function is used to delete the Project Information Record in the database
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

                // then go back to Project view
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

}