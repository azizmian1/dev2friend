<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {

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

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('member_model');
        $this->load->model('project_model');
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

             
                $data['memberProjects'] = $this->project_model->getMemberProjects($data['members'][0]->MEMBER_ID);
                $data['message'] = "";

                $this->load->view('dist/members', $data);
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
            
                $data['projects'] = $this->project_model->Getprojects();
                $data['memberProjects'] = $this->project_model->getMemberProjects($memberId);
                

                $this->load->view('dist/viewMember', $data);
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
    public function Edit($memberId) {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // Get Number of Members
                $data['title'] = "Edit Member";
                $data['members'] = $this->member_model->GetMembers();
                $data['selectedId'] = $memberId;
                $data['selectedMember'] = $this->member_model->GetMember($memberId)[0];

                $this->load->view('dist/editMember', $data);
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
     * This function is used to redirect the page to the Add Member Screen
     */
    public function Add() {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // Get Number of Members
                $data['title'] = "Add Member";
                $data['members'] = $this->member_model->GetMembers();

                $this->load->view('dist/addMember', $data);
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
                $statFlg = $this->input->post('active_stat_flg');
                $roleFlg = $this->input->post('access_role_flg');

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

                redirect(base_url() . 'Members/View/' . $memberId);
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
     * This function is used to add the member information record in the database
     */
    public function addMember() {

        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // To Update Members
                $lastName = $this->input->post('last_name');
                $firstName = $this->input->post('first_name');
                $email = $this->input->post('emailAdd');
                $password = $this->input->post('user_pass');
                $statFlg = $this->input->post('active_stat_flg');
                $roleFlg = $this->input->post('access_role_flg');

                $membersCount = sizeof($this->member_model->GetMembers()) + 1;
                $membersCountStr = sprintf('%03d', $membersCount);
                
                // Generate Member ID
                // JILREG<1st Char of FNAME><1st Char of LNAME><NUM>
                $memberId = "D2F" . substr($firstName, 0, 1) . substr($lastName, 0, 1) . $membersCountStr;

                // The correct syntax to pass parameters for the update.
                $data = array();
                $data = array(
                    'MEMBER_ID' => $memberId,
                    'LAST_NAME' => $lastName,
                    'FIRST_NAME' => $firstName,
                    'EMAIL' => $email,
                    'USER_PASS' => $password,
                    'ACTIVE_STAT_FLG' => $statFlg,
                    'ACCESS_ROLE_FLG' => $roleFlg
                );

                // function call saveMember
                $this->member_model->addMember($data);

                redirect(base_url() . 'Members/View/' . $memberId);
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
     * This function is used to resend the QR Code to the member
     * @param type $memberId
     */
    public function Resend($memberId) {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {
                $member = $this->member_model->GetMember($memberId)[0];
                
                include("application/libraries/phpqrcode/lib/full/qrlib.php");

                $SERVERFILEPATH = FCPATH . "/uploads/";
                $text = $memberId;
                $fileName = $text . "-Qrcode.png";

                if (!file_exists($SERVERFILEPATH . $fileName)) {
                    QRcode::png($text, $SERVERFILEPATH . $fileName, QR_ECLEVEL_H);
                }
                
                

                $this->sendQRCodeEmail($SERVERFILEPATH . $fileName, $member->FIRST_NAME . " " . $member->LAST_NAME, $member->EMAIL);
                
                //redirect(base_url() . 'Members/View/' . $memberId);
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
     * This function is used to delete the Member Information Record in the database
     * @param type $memberId
     */
    public function Delete($memberId) {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                $data['message'] = "The member information you selected has been successfully deleted.";

                // Get Number of Members
                $data['title'] = "Members";

                // function call deleteMember
                $this->member_model->deleteMember($memberId);

                // Retrieve the fresh cut of members
                $data['members'] = $this->member_model->GetMembers();
                $data['selectedId'] = $data['members'][0]->MEMBER_ID;

                // then go back to members view
                $this->load->view('dist/members', $data);
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
                $this->project_model->deleteMemberProject($memberId);

                // Grab inputted project code
                $user_code = $this->input->post('project_password');

                if (sizeof($projects) > 0) {
                    for ($i = 0; $i < sizeof($projects); $i++) {
                    $data = array();
                    $data = array(
                        'PROJECT_ID' => $projects[$i],
                        'MEMBER_ID' => $memberId
                    );
                    $this->project_model->addToProject($data);
                    }
                }
                

                redirect(base_url() . 'Members/View/' . $memberId);
            }
            else {
                redirect(base_url() . 'Login');
            }
        }
        else {
            redirect(base_url() . 'Login');
        }
    }

    public function addToProjectUser($memberId) {
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                $data['members'] = $this->member_model->GetMembers();
                $data['selectedId'] = $data['members'][0]->MEMBER_ID;
                $data['projects'] = $this->project_model->Getprojects();
                $data['selectedMemberId'] = $data['members'][0]->MEMBER_ID;
                $data['selectedProjectId'] = $data['projects'][1]->PROJECT_ID;

             
                $data['memberProjects'] = $this->project_model->getMemberProjects($data['members'][0]->MEMBER_ID);
                
                $data['memberId'] = $this->session->userdata('memberId');

                $data['myProjects'] = $this->project_model->GetMyProjects($data['memberId']);

                $data['message'] = "";

                $response = $this->input->post('response');

                if($response == "YES") {
                    $data = array();
                    $data = array(
                        'PROJECT_ID' => 4,
                        'MEMBER_ID' => $memberId
                    );
                    $this->project_model->addToProject($data);
                }
                
                $this->load->view('dist/profile', $data);

            }else {
                redirect(base_url() . 'Login');
            }
        }else {
            redirect(base_url() . 'Login');
        }
    }

}
