<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Signup extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper('string');
    }


    public function index() {
        $this->load->view('front/signup');
    }

    public function create_user() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
        $this->form_validation->set_rules('username', 'Username','trim|required|min_length[6]|is_unique[users.username]|alpha_numeric', array(
            'is_unique' => '%s already taken.'
        ));
        $this->form_validation->set_rules('firstname', 'First Name','trim|required|alpha');
        $this->form_validation->set_rules('lastname', 'Last Name','trim|required|alpha');
        $this->form_validation->set_rules('email', 'Email','trim|required|valid_email|is_unique[users.email]', array(
            'is_unique' => '%s is already existing.'
        ));
        $this->form_validation->set_rules('password', 'Password','trim|required');
        $this->form_validation->set_rules('phone', 'Phone','trim|required|numeric');
        $this->form_validation->set_rules('address', 'Address','trim|required');

        if($this->form_validation->run() == true) {

            $formArray['username'] = $this->input->post('username');
            $formArray['f_name'] = $this->input->post('firstname');
            $formArray['l_name'] = $this->input->post('lastname');
            $formArray['email'] = $this->input->post('email');
            $formArray['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $formArray['phone'] = $this->input->post('phone');
            $formArray['address'] = $this->input->post('address');
            $formArray['activation_code'] = random_string('alnum', 16);
            $this->User_model->create($formArray);

            // EMAIL VERIFICATION
            $this->load->library('email');
            $config_email = array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'patricia.michaela18@gmail.com', 
                'smtp_pass' => 'fbdwmewjeqyycqlo', 
                'mailtype' => 'html',
                'starttls' => true,
                'newline' => "\r\n",
                'charset' => $this->config->item('charset'),
                'wordwrap' => TRUE
            );
            $this->email->initialize($config_email);
            $this->email->from('no-reply@simplengkainan.com', 'Simpleng Kainan');
            $this->email->to($this->input->post('email'));
            $this->email->subject('Verify your email address');
            $this->email->message('
            <h2><b>Welcome to Simpléng Kainan, '.$formArray['f_name'].'!</b></h2>
            <p>Thank you for registering. To activate your account, please click on the button below.</p><br>
            <a href="'.base_url('Signup/activate/'.$formArray['activation_code']).'" target="_blank" style="text-decoration: none; font-weight: bold;">Verify Email</a>');
            if(!$this->email->send()){
                // echo $this->email->print_debugger();
            }

            $this->session->set_flashdata("success", "Account created successfully! Please check your email to activate your account.");
            redirect(base_url().'login/index');
        } else {
            $this->load->view('front/signup');
        }
    }

    public function activate($activation_code){
        $this->load->model('User_model');
        $user = $this->User_model->get_by_activation_code($activation_code);
        if($user){
            $this->User_model->activate($user->u_id);
        }
        //load a view confirming that the account is activated
        $this->session->set_flashdata("success", "Your email has been verified. You can now login.");
        redirect(base_url().'login/index');
    }
}