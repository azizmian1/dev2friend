<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class userMembers extends CI_Controller {

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
    public $user_model;

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('member_model');
        $this->load->model('project_model');
        $this->load->model('user_model');
    }

    /**
     * This function is the default function when accessing the Members Controller
     */
    public function index() {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // Get Number of Members
                $data['title'] = "Members";
                $data['members'] = $this->member_model->GetMembers();
                $data['selectedId'] = $data['members'][0]->MEMBER_ID;
                $data['projects'] = $this->project_model->Getprojects();
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

                $data['memberProjects'] = $this->project_model->getMemberProjects($data['members'][0]->MEMBER_ID);
                $data['message'] = "";

                $this->load->view('dist/usermembers', $data);
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
     * This function is used to redirect the page to the View Member Page
     * @param type $memberId
     */
    public function View($memberId) {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // Get Number of Members
                $data['title'] = "Members";
                $data['members'] = $this->member_model->GetMembers();
                $data['selectedId'] = $memberId;
                $data['selectedMember'] = $this->member_model->GetMember($memberId)[0];

                $data['firstName'] = $this->session->userdata('firstName');
                $data['lastName'] = $this->session->userdata('lastName');
                $data['memberId'] = $this->session->userdata('memberId');
                $data['userPass'] = $this->session->userdata('userPass');
                $data['userEmail'] = $this->user_model->GetEmail($this->session->userdata('memberId'));
                $data['userContactEmail'] = $this->user_model->GetContactEmail($this->session->userdata('memberId'));
                $data['userGithub'] = $this->user_model->GetGithub($this->session->userdata('memberId'));
                $data['userLinkedin'] = $this->user_model->GetLinkedin($this->session->userdata('memberId'));
                $data['userPortfolio'] = $this->user_model->GetPortfolio($this->session->userdata('memberId'));
            
                $data['projects'] = $this->project_model->Getprojects();
                $data['memberProjects'] = $this->project_model->getMemberProjects($memberId);
                

                $this->load->view('dist/userviewMember', $data);
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
     * Function to add a member to a project
     */
    public function addToProject($memberId) {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // Iterate through all selected projects, this is the array from the form.
                $projects = $this->input->post('projects[]');

                $projects = (is_array($projects)) ? $projects : [$projects];

                // Call delete function to not have duplicate data in the database.
                //$this->project_model->deleteMemberProject($memberId);

                // Iterate through the $projects array
                if (sizeof($projects) > 0) {
                    for ($i = 0; $i < sizeof($projects); $i++) {
                        $data = array();
                        $data = array(
                            'PROJECT_ID' => $projects[$i],
                            'MEMBER_ID' => $memberId
                        );
                        // Grab inputted project code 
                        $user_code = $this->input->post('project_password');
                        // Grab project password
                        $sql = "SELECT `PROJECT_PASSWORD` FROM ci_project WHERE `PROJECT_ID` = $projects[$i]";
                        $query = $this->db->query($sql);
                            foreach ($query->result_array() as $row)
                            {
                                $result = $row['PROJECT_PASSWORD'];
                                

                                if ($user_code == $result)
                                {
                                    $this->project_model->addToProject($data);
                                    redirect(base_url() . 'Profile/viewMyProject');
                                }
                                else if ($result == NULL)
                                {
                                    $this->project_model->addToProject($data);
                                    redirect(base_url() . 'Profile/viewMyProject');
                                }
                            }
                                
                    }
                    redirect(base_url() . 'Login');
                }
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
    public function save($memberId) {

        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // To Update Members
                $lastName = $this->input->post('last_name');
                $firstName = $this->input->post('first_name');
                $email = $this->input->post('emailAdd');
                $contactEmail = $this->input->post('contactEmailAdd');
                $password = $this->input->post('user_pass');
                $githubLink = $this->input->post('githubLink');
                $linkedinLink = $this->input->post('linkedinLink');
                $portfolioLink = $this->input->post('portfolioLink');
                $statFlg = "A";
                $roleFlg = "USER";

                $this->load->library('form_validation');
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
                $this->form_validation->set_rules('email', 'User Email', 'trim|xss_clean|required|min_length[7]');
                $this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|required|min_length[6]');

                if (empty($lastName) && empty($firstName) && empty($email) && empty($password)) {
                    echo 'Please correct the fields';
                    return false;
                }

                // Format Birth Date
                $birthDate = date('Y/m/d', strtotime($birthDate));

                // The correct syntax to pass parameters for the update.
                $data = array();
                $data = array(
                    'LAST_NAME' => $lastName,
                    'FIRST_NAME' => $firstName,
                    'EMAIL' => $email,
                    'CONTACT_EMAIL' => $contactEmail,
                    'USER_PASS' => $password,
                    'GITHUB_LINK' => $githubLink,
                    'LINKEDIN_LINK' => $linkedinLink,
                    'PORTFOLIO_LINK' => $portfolioLink,
                    'ACTIVE_STAT_FLG' => $statFlg,
                    'ACCESS_ROLE_FLG' => $roleFlg
                );

                // function call saveMember
                $this->member_model->saveMember($memberId, $data);

                redirect(base_url() . 'Profile');
                

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
