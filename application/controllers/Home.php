<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index()
	{
		$this->load->model('Menu_model');
		$dish = $this->Menu_model->getMenu();
		$data['dishes'] = $dish;
		$this->load->view('front/partials/header');
		$this->load->view('front/home', $data);
		$this->load->view('front/partials/footer');
	}

	public function sendMail() {
		$this->load->library('form_validation');
        $this->form_validation->set_rules('name','name', 'trim|required');
        $this->form_validation->set_rules('email','email', 'trim|required');
        $this->form_validation->set_rules('subject','subject', 'trim|required');
        $this->form_validation->set_rules('message','message', 'trim|required');

		if($this->form_validation->run() == true) {

			// EMAIL CONFIG
			$name = $this->input->post('name');
			$emailFrom = $this->input->post('email');
			$subject = $this->input->post('subject');
			$message = $this->input->post('message');
			$toEmail = "zofiajung024@gmail.com";
			
			$config['protocol'] = 'smtp';
            $config['smtp_host'] = 'ssl://smtp.googlemail.com';
            $config['smtp_port'] = '465';
            $config['smtp_user'] = '';
            $config['smtp_pass'] = '';
            $config['mailtype'] = 'html';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['newline'] = "\r\n"; //use double quotes
            $this->load->library('email', $config);
            $this->email->initialize($config);    
			$this->email->from($emailFrom, $name);
            $this->email->to($toEmail);
            $this->email->subject($subject);
            $this->email->message($message);
			
			if ($this->email->send()){
				$this->session->set_flashdata("msg","mail has been sent successfully");
				redirect(base_url().'home/index');
			} else {
				$this->session->set_flashdata("msg","mail is not sent, try again.");
				redirect(base_url().'home/index');
			}
		} else {
			redirect(base_url().'home/index');
		}
    }
}
