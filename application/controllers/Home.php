<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library(array('session', 'function_lib'));
		$this->load->helper(array('url'));
		$this->data = array();

		$this->data['headerFiles'] =  $this->load->view('commonCode/headerFiles',$this->data,true);
		$this->data['footerFiles'] =  $this->load->view('commonCode/footerFiles',$this->data,true);
		$this->data['nav'] =  $this->load->view('commonCode/nav',$this->data,true);
		$this->data['footer'] =  $this->load->view('commonCode/footer',$this->data,true);

		$this->data['message'] = ($v = $this->session->flashdata('message'))?$v:array('content'=>'','color'=>'');

		// $this->data['csrf_token_name'] = $this->security->get_csrf_token_name();
	}

	public function index(){
		if($this->function_lib->auth()){
			redirect(base_url('general-details'));
		}
		else{
			$this->data['pageTitle'] = "CampusPuppy";
			$this->load->view('home', $this->data);
		}
	}


	public function verifyContactDetails(){
		if($this->function_lib->auth()){
			if($_SESSION['user_data']['emailVerified'] == '1' && $_SESSION['user_data']['mobileVerified'] == '1'){
				redirect(base_url('general-details'));
			}
			else{
				$this->data['pageTitle'] = "Verify Contact Details";
				$this->data['activePage'] = "0";
				$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
				$this->load->view('verifyContactDetails', $this->data);
			}
		}
		else{
			redirect(base_url());
		}

	}

	public function generalDetails(){
		if($this->function_lib->auth()){
			if($_SESSION['user_data']['emailVerified'] == '1' && $_SESSION['user_data']['mobileVerified'] == '1'){
				$this->data['pageTitle'] = "General Details";
				$this->data['activePage'] = "2";
				$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
				$this->load->view('generalDetails', $this->data);
			}
			else{
				redirect(base_url('verify-contact-details'));
			}
		}
		else{
			redirect(base_url());
		}

	}

	public function skills(){
		$this->auth();
		$this->data['pageTitle'] = "Skills";
		$this->data['activePage'] = "3";
		$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
		$this->load->view('skills', $this->data);
	}

	public function skillTest(){
		$this->auth();
		$this->data['pageTitle'] = "Skill Test";
		$this->data['activePage'] = "3";
		$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
		$this->load->view('skillTest', $this->data);
	}

	public function skillTestGuidelines(){
		$this->auth();
		$this->data['pageTitle'] = "Skill Test Guidelines";
		$this->data['activePage'] = "3";
		$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
		$this->load->view('skillTestGuidelines', $this->data);
	}

	public function educationalDetails(){
		$this->auth();
		$this->data['pageTitle'] = "Educational Details";
		$this->data['activePage'] = "4";
		$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
		$this->load->view('educationalDetails', $this->data);
	}

	public function workExperience(){
		$this->auth();
		$this->data['pageTitle'] = "Work Experience";
		$this->data['activePage'] = "5";
		$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
		$this->load->view('workExperience', $this->data);
	}

	public function resume(){
		$this->auth();
		$this->data['pageTitle'] = "Resume";
		$this->data['activePage'] = "6";
		$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
		$this->load->view('resume', $this->data);
	}

	public function changePassword(){
		$this->auth();
		$this->data['pageTitle'] = "Change Password";
		$this->data['activePage'] = "7";
		$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
		$this->load->view('changePassword', $this->data);
	}

	public function auth(){
		if($this->function_lib->auth()){
			if($_SESSION['user_data']['emailVerified'] == '1' && $_SESSION['user_data']['mobileVerified'] == '1'){
				redirect(base_url('general-details'));
			}
			else{
				redirect(base_url('verify-contact-details'));
			}
		}
		else{
			redirect(base_url());
		}
	}


	public function employer(){
		$this->data['pageTitle'] = "Employer";

		$this->load->view('employer', $this->data);
	}

	public function report(){
		$this->load->view('report', $this->data);
	}


}
