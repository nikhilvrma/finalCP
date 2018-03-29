<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Functions extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library(array('session', 'function_lib', 'skill_lib'));
		$this->load->helper(array('url'));
		$this->data = array();

		$this->data['message'] = ($v = $this->session->flashdata('message'))?$v:array('content'=>'','color'=>'');

		// $this->data['csrf_token_name'] = $this->security->get_csrf_token_name();
	}

	public function login(){
		$email = '';
		$password = '';
		if($x = $this->input->post('email')){
			$email = $x;
		}
		if($x = $this->input->post('password')){
			$password = $x;
		}
		if($this->function_lib->checkEMailExist($email)){
			$password = md5($password);
			$result = $this->function_lib->login($email, $password);
			if($result){
				redirect(base_url('/general-details'));
			}
			else{
				$this->session->set_flashdata('message', array('content'=>'Wrong Password. Please Try Again.','color'=>'red'));
				redirect(base_url());
			}
		}
		else{
			$this->session->set_flashdata('message', array('content'=>'This E-Mail Address is not registered with us. Please Register to Proceed Ahead.','color'=>'red'));
			redirect(base_url());
		}
	}

	public function signout(){
		$this->session->set_userdata('user_data', false);
		$this->session->set_userdata('user_data', []);
		$this->session->sess_destroy();
		redirect(base_url());
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
		if($password == $cpassword){
			if($this->function_lib->checkEMailExist($email)){
				$this->session->set_flashdata('message', array('content'=>'This E-Mail Address already exists. Please Try Again.','color'=>'red'));
				redirect(base_url());
			}
			else{
				if($this->function_lib->checkMobileExist($mobile)){
					$this->session->set_flashdata('message', array('content'=>'This Mobile Number already exists. Please Try Again.','color'=>'red'));
					redirect(base_url());
				}
				else{
					$password = md5($password);
					$data = array(
						'name' => $name,
						'email' => $email,
						'mobile' => $mobile,
						'password' => $password,
						'accountType' => $accountType
					);
					$result = $this->function_lib->register($data);
					if($result){
						$this->session->set_flashdata('message', array('content'=>'Thank You for registering on CampusPuppy. Login Now to Continue','color'=>'green'));
						redirect(base_url());
					}
					else{
						$this->session->set_flashdata('message', array('content'=>'Something Went Wrong. Please Try Again.','color'=>'red'));
						redirect(base_url());
					}
				}
			}
		}
		else{
			$this->session->set_flashdata('message', array('content'=>'Your Password and Confirm Password do not match with each-other. Please Try Again.','color'=>'red'));
			redirect(base_url());
		}
	}

	public function updateGeneralDetails(){
		$careerObjective = '';
		if($x = $this->input->post('careerObjective')){
			$careerObjective = $x;
		}
		$data = array(
			'careerObjective' => $careerObjective
		);
		$result = $this->function_lib->updateGeneralDetails($data, $_SESSION['user_data']['userID']);
		if($result){
			$this->session->set_flashdata('message', array('content'=>'Career Objective successfully Updated','color'=>'green'));
			redirect(base_url('general-details'));
		}
		else{
			$this->session->set_flashdata('message', array('content'=>'Something Went Wrong. Please Try Again.','color'=>'red'));
			redirect(base_url('general-details'));
		}
	}

	public function changePassword(){
		$currentPassword = '';
		$newPassword = '';
		$confirmNewPassword = '';

		if($x = $this->input->post('currentPassword')){
			$currentPassword = $x;
		}
		if($x = $this->input->post('newPassword')){
			$newPassword = $x;
		}
		if($x = $this->input->post('confirmNewPassword')){
			$confirmNewPassword = $x;
		}
		$currentPassword = md5($currentPassword);
		$newPassword = md5($newPassword);
		$confirmNewPassword = md5($confirmNewPassword);
		if($newPassword === $confirmNewPassword){
			$email = $_SESSION['user_data']['email'];
			if($this->function_lib->checkPasswordMatch($email, $currentPassword)){
				$result = $this->function_lib->changePassword($email, $newPassword);
				if($result){
					$this->session->set_flashdata('message', array('content'=>'Password Successfully Changed','color'=>'green'));
					redirect(base_url('change-password'));
				}
				else{
					$this->session->set_flashdata('message', array('content'=>'Some Error Occured, Please Try Again.','color'=>'red'));
					redirect(base_url('change-password'));
				}
			}
			else{
				$this->session->set_flashdata('message', array('content'=>'The Current Password, does not match with the one in our database, Please Try Again.','color'=>'red'));
				redirect(base_url('change-password'));
			}
		}
		else{
			$this->session->set_flashdata('message', array('content'=>'Your New Password, does not matches with Confirm New Password, Please Try Again.','color'=>'red'));
			redirect(base_url('change-password'));
		}
	}

	public function addOffer(){
		$offerType = '';
		$offerTitle = '';
		$offerDescription = '';
		$openings = '';
		$joiningDate = '';
		$applicationDeadline = '';
		if($x = $this->input->post('offerType')){
			$offerType = $x;
		}
		if($x = $this->input->post('offerTitle')){
			$offerTitle = $x;
		}
		if($x = $this->input->post('offerDescription')){
			$offerDescription = $x;
		}
		if($x = $this->input->post('openings')){
			$openings = $x;
		}
		if($x = $this->input->post('joiningDate')){
			$joiningDate = $x;
		}
		if($x = $this->input->post('applicationDeadline')){
			$applicationDeadline = $x;
		}
		if($offerType == '1' || $offerType == '2'){
			date_default_timezone_set("Asia/Kolkata");
			$today = date('Y-m-d');
			$d1 = DateTime::createFromFormat('Y-m-d', $joiningDate);
			$d2 = DateTime::createFromFormat('Y-m-d', $applicationDeadline);

			if (!($d1 && $d1->format('Y-m-d') === $joiningDate)){
				$this->session->set_flashdata('message', array('content'=>'Something Went Wrong. Please Try Again.4','color'=>'red'));
				redirect(base_url('add-new-offer'));
			}
			if ($joiningDate < $today){
				$this->session->set_flashdata('message', array('content'=>'Offer Joining Date has already Passed. Please Try Again.1','color'=>'red'));
				redirect(base_url('add-new-offer'));
			}
			if (!($d2 && $d2->format('Y-m-d') === $applicationDeadline)){
				$this->session->set_flashdata('message', array('content'=>'Something Went Wrong. Please Try Again.5','color'=>'red'));
				redirect(base_url('add-new-offer'));
			}
			if ($applicationDeadline < $today){
				$this->session->set_flashdata('message', array('content'=>'Application Deadline already Passed. Please Try Again.1','color'=>'red'));
				redirect(base_url('add-new-offer'));
			}
			if ($applicationDeadline > $joiningDate){
				$this->session->set_flashdata('message', array('content'=>'Offer Joining Date cannot be before the Offer Application Deadline. Please Try Again.','color'=>'red'));
				redirect(base_url('add-new-offer'));
			}

			if($offerType == '' || $offerTitle == '' || $offerDescription == '' || $openings == '' || $joiningDate == '' || $applicationDeadline == ''){
				$this->session->set_flashdata('message', array('content'=>'Something Went Wrong. Please Try Again.2','color'=>'red'));
				redirect(base_url('add-new-offer'));
			}
			else{
				$data = array(
					'offerType' => $offerType,
					'offerTitle' => $offerTitle,
					'offerDescription' => $offerDescription,
					'openings' => $openings,
					'joiningDate' => $joiningDate,
					'applicationDeadline' => $applicationDeadline
				);
				$result = $this->function_lib->addOffer($data);
				if($result){
					$this->session->set_flashdata('message', array('content'=>'Offer added Successfully.','color'=>'green'));
					redirect(base_url('add-new-offer'));
				}
				else{
					$this->session->set_flashdata('message', array('content'=>'Something Went Wrong. Please Try Again.1','color'=>'red'));
					redirect(base_url('add-new-offer'));
				}
			}
		}
		else{
			$this->session->set_flashdata('message', array('content'=>'Something Went Wrong. Please Try Again.3','color'=>'red'));
			redirect(base_url('add-new-offer'));
		}

	}

}
