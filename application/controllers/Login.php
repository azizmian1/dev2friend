<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
    public $login_model;
    public $member_model;
    public $project_model;
    public $benchmark;

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('login_model');
        $this->load->model('member_model');
        $this->load->model('project_model');
    }

    public function index() {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            // If admin logs in, go to admin page. Else go to user profile
            if($this->session->userdata('userRoleFlg') == "ADMIN"){
                redirect(base_url() . 'Members');
            }else {
                redirect(base_url() . 'Profile');
            }
        }
        $data = array(
            'title' => "D2F - Login"
        );
        
        $this->load->view('dist/auth-login', $data);
    }

    public function Login_Auth() {
        $response = array();

        //Receiving post input of email, password from request
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        //$remember = $this->input->post('remember');

        #Login input validation\
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('email', 'User Email', 'trim|xss_clean|required|min_length[7]');
        $this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|required|min_length[6]');

        // If validation fails, redirect to the login page again.
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('feedback', 'Email/Password combination is invalid.');
            redirect(base_url() . 'Login', 'refresh');
        } else {
            //Validating login
            $login_status = $this->validate_login($email, $password);
            $response['login_status'] = $login_status;
            if ($login_status == 'success') {
                if (isset($_COOKIE['email'])) {
                    setcookie('email', ' ');
                }
                if (isset($_COOKIE['password'])) {
                    setcookie('password', ' ');
                }
                redirect(base_url() . 'Login', 'refresh');
            } else {
                $this->session->set_flashdata('feedback', 'Email/Password combination is invalid.');
                redirect(base_url() . 'Login', 'refresh');
            }
        }
    }

    // Validating login from request
    function validate_login($email = '', $password = '') {
        $credential = array('EMAIL' => $email, 'USER_PASS' => $password, 'ACTIVE_STAT_FLG' => 'A');
        $query = $this->login_model->getUserForLogin($credential);
        
        if ($query->num_rows() > 0) {
            $row = $query->row();

            $membersCount = sizeof($this->member_model->GetMembers()) + 1;
            $membersCountStr = sprintf('%03d', $membersCount);
            $memberId = "D2F" . substr($firstName, 0, 1) . substr($lastName, 0, 1) . $membersCountStr;

            $this->session->set_userdata('userLoginAccess', '1');
            $this->session->set_userdata('memberId', $row->MEMBER_ID);
            $this->session->set_userdata('userEmail', $row->USER_EMAIL);
            $this->session->set_userdata('firstName', $row->FIRST_NAME);
            $this->session->set_userdata('lastName', $row->LAST_NAME);
            $this->session->set_userdata('userRoleFlg', $row->ACCESS_ROLE_FLG);
            $this->session->set_userdata('userPass', $row->USER_PASS);
            return 'success';
        }
    }

    /* Logout method */
    function Logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('feedback', 'logged_out');
        redirect(base_url(), 'refresh');
    }


    function viewSignup() {
        $this->load->view('dist/signup');
    }


    // TO DO: needs some fix
    function Signup() {
        $title = 'D2F - Signup';

        $firstName = $this->input->post('firstName');
        $lastName = $this->input->post('lastName');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        //$userRole = $this->input->post('userRole');


        $membersCount = sizeof($this->member_model->GetMembers()) + 1;
        $membersCountStr = sprintf('%03d', $membersCount);
        $memberId = "D2F" . substr($firstName, 0, 1) . substr($lastName, 0, 1) . $membersCountStr;

        $data = array(
            'MEMBER_ID' => $memberId,
            'FIRST_NAME' => $firstName,
            'LAST_NAME' => $lastName,
            'EMAIL' => $email,
            'USER_PASS' => $password,
            'ACTIVE_STAT_FLG' => 'A',
            'ACCESS_ROLE_FLG' => 'user'
        );
        // Duplicate Email Test
        $email = $this->input->post('email');
        $sql = "SELECT EMAIL FROM `ci_member` WHERE EMAIL = '$email'";
        $result = $this->db->query($sql);
        if ($result->row()) {
            
        }
        else {
            $query = $this->login_model->InsertUser($data);   
        }  
        $data['message'] = "";

        $response = array();

        //Receiving post input of email, password from request
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        //$remember = $this->input->post('remember');

        // After signing up, redirect to login.
        redirect(base_url() . 'Login', 'refresh');

       
    }
}
