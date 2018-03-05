<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Functions extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
		$this->data = array();

		$this->data['message'] = ($v = $this->session->flashdata('message'))?$v:array('content'=>'','color'=>'');

		// $this->data['csrf_token_name'] = $this->security->get_csrf_token_name();
	}

	public function login(){
		$username = '';
		$password = '';
		if($x = $this->input->post('username')){
			$username = $x;
		}
		if($x = $this->input->post('password')){
			$password = $x;
		}
		$password = md5($password);
		$result = $this->function_lib->login($username, $password);
		if($result){
			redirect(base_url('/add-new-user'));
		}
		else{
			$this->session->set_flashdata('message', array('content'=>'Check Username and/or Password','color'=>'red'));
			redirect(base_url('/login'));
		}
	}

	public function signout(){
		$this->session->set_userdata('user_data', false);
		$this->session->set_userdata('user_data', []);
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}

	public function register(){
		$name = '';
		$email = '';
		$mobile = '';
		$password = '';
		$cpassword = '';
		$accountType = '';
		if($x = $this->input->post('name')){
			$name = $x;
		}
		if($x = $this->input->post('email')){
			$email = $x;
		}
		if($x = $this->input->post('mobile')){
			$mobile = $x;
		}
		if($x = $this->input->post('password')){
			$password = $x;
		}
		if($x = $this->input->post('cpassword')){
			$cpassword = $x;
		}
		if($x = $this->input->post('accountType')){
			$accountType = $x;
		}
		$password = md5($password);
		$cpassword = md5($cpassword);
		$data = array(
			'name' => $name,
			'email' => $email,
			'mobile' => $mobile,
			'password' => $password,
			'accountType' => $accountType
		);

	}

}
