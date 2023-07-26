<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class userProject extends CI_Controller {

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

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('project_model');
        $this->load->model('member_model');
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

                $data['userGithub'] = $this->user_model->GetGithub($this->session->userdata('memberId'));

                $data['selectedId'] = $data['projects'][0]->PROJECT_ID;
                
                $data['message'] = "";

                $this->load->view('dist/userproject', $data);
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


                // function call to add to project
                $this->project_model->addProject($data);


                /* After adding the project, add the creator to the project */
                $data['projects'] = $this->project_model->GetProjects();
                $data['memberId'] = $this->session->userdata('memberId');
                $data['lastProj'] = $this->project_model->grabLastProject();

                $memberId = $data['memberId'];
                $pId = $data['lastProj'][0]->PROJECT_ID;
 
                $myData = array();
                $myData = array(
                    'PROJECT_ID' => $pId,
                    'MEMBER_ID' => $memberId
                );

                // function to auto add the creator to the project created.
                $this->project_model->addToProject($myData);

                redirect(base_url() . 'Profile/viewMyProject');

            }
            else {
                redirect(base_url() . 'Login');
            }
        }
        else {
            redirect(base_url() . 'Login');
        }
    }
}
