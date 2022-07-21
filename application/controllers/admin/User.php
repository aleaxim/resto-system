<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class User extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('string');
        $admin = $this->session->userdata('admin');
        if(empty($admin)) {
            $this->session->set_flashdata('msg', 'You\'ve been logout');
            redirect(base_url().'admin/login/index');
        }
    }

    public function index() {
        $this->load->model('User_model');
        $users = $this->User_model->getUsers();
        $data['users'] = $users;
        $this->load->view('admin/partials/header');
        $this->load->view('admin/user/list', $data);
        $this->load->view('admin/partials/footer');
    }
    public function create_user() {

        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
        $this->form_validation->set_rules('username', 'Username','trim|required|min_length[6]|is_unique[users.username]|alpha_numeric', array(
            'is_unique' => '%s is already taken.'
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

            $this->session->set_flashdata('success', 'User added successfully! Activation link is sent on email.');
            redirect(base_url(). 'admin/user/index');


        } else {
            $this->load->view('admin/partials/header');
            $this->load->view('admin/user/add_user');
            $this->load->view('admin/partials/footer');
        }
        
    }

    public function edit($id) {
        $this->load->model('User_model');
        $user = $this->User_model->getUser($id);

        if(empty($user)) {
            $this->session->set_flashdata('error', 'User not found');
            redirect(base_url().'admin/user/index');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
        $this->form_validation->set_rules('username', 'Username','trim|required');
        $this->form_validation->set_rules('firstname', 'First Name','trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name','trim|required');
        $this->form_validation->set_rules('email', 'Email','trim|required');
        $this->form_validation->set_rules('password', 'Password','trim|required');
        $this->form_validation->set_rules('phone', 'Phone','trim|required');
        $this->form_validation->set_rules('address', 'Address','trim|required');

        if($this->form_validation->run() == true) { 

            $formArray['username'] = $this->input->post('username');
            $formArray['f_name'] = $this->input->post('firstname');
            $formArray['l_name'] = $this->input->post('lastname');
            $formArray['email'] = $this->input->post('email');
            $formArray['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $formArray['phone'] = $this->input->post('phone');
            $formArray['address'] = $this->input->post('address');


            $this->User_model->update($id,$formArray);

            $this->session->set_flashdata('success', 'User updated successfully');
            redirect(base_url(). 'admin/user/index');


        } else {
            $data['user'] = $user;
            $this->load->view('admin/partials/header');
            $this->load->view('admin/user/edit', $data);
            $this->load->view('admin/partials/footer');
        }
    }

    public function delete($id) {
        $this->load->model('User_model');
        $user = $this->User_model->getUser($id);

        if(empty($user)) {
            $this->session->set_flashdata('error', 'User not found');
            redirect(base_url().'admin/user/index');
        }

        $this->User_model->delete($id);

        $this->session->set_flashdata('success', 'User deleted successfully');
        redirect(base_url().'admin/user/index');

    }

}