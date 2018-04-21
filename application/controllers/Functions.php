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

	public function changeEmail(){
		$email = $this->input->post('email');
		if($this->function_lib->checkEMailExist($email)){
			$this->session->set_flashdata('message', array('content'=>'This E-Mail Address already exists. Please Try Again.','color'=>'red'));
			redirect(base_url('verify-contact-details'));
		}
		if($this->function_lib->updateEmail($email)){
			unset($_SESSION['sentVerificationEmail']);
			$_SESSION['user_data']['email'] = $email;	
			$this->session->set_flashdata('message', array('content'=>'Your E-mail Address has been successfully changed.','color'=>'green'));
			redirect(base_url('verify-contact-details'));
		}else{
			$this->session->set_flashdata('message', array('content'=>'Something Went Wrong. Please Try Again.','color'=>'red'));
			redirect(base_url());
		}
	}

	public function changeMobile(){
		$mobile = $this->input->post('mobile');
		if($this->function_lib->checkMobileExist($mobile)){
			$this->session->set_flashdata('message', array('content'=>'This Mobile Number already exists. Please Try Again.','color'=>'red'));
			redirect(base_url('verify-contact-details'));
		}
		if($this->function_lib->updateMobile($mobile)){
			unset($_SESSION['sentVerificationSMS']);
			$_SESSION['user_data']['mobile'] = $mobile;
			$this->session->set_flashdata('message', array('content'=>'Your Mobile Number has been successfully changed.','color'=>'green'));
			redirect(base_url('verify-contact-details'));
		}else{
			$this->session->set_flashdata('message', array('content'=>'Something Went Wrong. Please Try Again.','color'=>'red'));
			redirect(base_url());
		}
	} 

	public function checkMobileVerificationCode(){
		$code = $this->input->post('code');
		$data = $this->function_lib->getMobileVerificationCode()[0];
		date_default_timezone_set("Asia/Kolkata");
		$currentTime = strtotime(date("d M Y H:i:s"));
		if($currentTime<$data['expiry']){
			if($code == $data['code']){
				$_SESSION['user_data']['mobileVerified'] = 1;
				$this->function_lib->updateMobileVerified();
				$this->session->set_flashdata('message', array('content'=>'Your Mobile Number has been successfully verified.','color'=>'green'));
				redirect(base_url('verify-contact-details'));
			}else{
				$this->session->set_flashdata('message', array('content'=>'The Verification Code Entered is Wrong..','color'=>'red'));
				redirect(base_url('verify-contact-details'));
			}
		}else{
			unset($_SESSION['sentVerificationSMS']);
			$this->session->set_flashdata('message', array('content'=>'The Verification Code Entered has Expired. Please Enter new Verification Code.','color'=>'red'));
			redirect(base_url('verify-contact-details'));
		}
			
	}

	public function checkEmailVerificationCode(){
		$code = $this->input->post('code');
		$data = $this->function_lib->getEmailVerificationCode()[0];
		date_default_timezone_set("Asia/Kolkata");
		$currentTime = strtotime(date("d M Y H:i:s"));
		// var_dump($data); var_dump($currentTime);die;
		if($currentTime<$data['expiry']){
			if($code == $data['code']){
				$_SESSION['user_data']['emailVerified'] = 1;
				$this->function_lib->updateEmailVerified();
				$this->session->set_flashdata('message', array('content'=>'Your Email Address has been successfully verified.','color'=>'green'));
				redirect(base_url('verify-contact-details'));
			}else{
				$this->session->set_flashdata('message', array('content'=>'The Verification Code Entered is Wrong..','color'=>'red'));
				redirect(base_url('verify-contact-details'));
			}
		}else{
			unset($_SESSION['sentVerificationEmail']);
			$this->session->set_flashdata('message', array('content'=>'The Verification Code Entered has Expired. Please Enter new Verification Code.','color'=>'red'));
			redirect(base_url('verify-contact-details'));
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
						if($accountType=='1'){
							$userID = $this->function_lib->getUserData($email);
							$userID = $userID[0]['userID'];
							$resumeReferenceNumber = $this->generateReumseReferenceNumber($userID);
							$data = array(
								'resumeReferenceNumber' => $resumeReferenceNumber
							);
							$this->function_lib->updateGeneralDetails($data, $userID);
						}else{
							$userID = $this->function_lib->getUserData($email);
							$userID = $userID[0]['userID'];
							$this->function_lib->insertCompanyData($userID);
						}

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

	public function contactUs(){
		$name = "";
		$mobile = "";
		$email = "";
		$message = "";
		if($x = $this->input->post('name')){
			$name = $x;
		}
		if($x = $this->input->post('email')){
			$email = $x;
		}
		if($x = $this->input->post('mobile')){
			$mobile = $x;
		}
		if($x = $this->input->post('message')){
			$message = $x;
		}
		if($name == "" || $email == "" || $mobile == "" || $message == ""){
			$this->session->set_flashdata('message', array('content'=>'Incomplete Data Inputted.1','color'=>'red'));
			redirect(base_url('contact-us'));
		}
		$data = array(
			'name' => $name,
			'email' => $email,
			'mobile' => $mobile,
			'message' => $message
		);
		$result = $this->function_lib->contactUs($data);
		if($result){
			$this->session->set_flashdata('message', array('content'=>'Thank You for connecting with us. CampusPuppy Team will get back to you soon.','color'=>'green'));
			redirect(base_url('contact-us'));
		}
		else{
			$this->session->set_flashdata('message', array('content'=>'Something Went Wrong. Please Try Again.','color'=>'red'));
			redirect(base_url('contact-us'));
		}
	}


	public function addEducation(){
		$type = "";
		$year = "";
		$scoreType = "";
		$score = "";
		$board = "";
		$courseBach = '';
		$courseMast = '';
		$college = '';
		$other = '';
		$newCollege = ''; 
		if($x = $this->input->post('type')){
			$type = $x;
		}
		if($x = $this->input->post('year')){
			$year = $x;
		}
		if($x = $this->input->post('scoreType')){
			$scoreType = $x;
		}
		if($x = $this->input->post('score')){
			$score = $x;
		}
		if($x = $this->input->post('board')){
			$board = $x;
		}
		if($x = $this->input->post('courseMast')){
			$courseMast = $x;
		}
		if($x = $this->input->post('courseBach')){
			$courseBach = $x;
		}
		if($x = $this->input->post('college')){
			$college = $x;
		}
		if($x = $this->input->post('other')){
			$other = $x;
		}
		if($x = $this->input->post('newCollege')){
			$newCollege = $x;
		}
		if($type == "" || $year == "" || $scoreType == "" || $score == ""){
			$this->session->set_flashdata('message', array('content'=>'Incomplete Data Inputted.','color'=>'red'));
			redirect(base_url('educational-details'));
		}
		if($scoreType == 1){
			if(!($score >= 0.0 && $score <= 10.0)){
				$this->session->set_flashdata('message', array('content'=>'Some Error Occured, Please Try Again','color'=>'red'));
				redirect(base_url('educational-details'));
			}
		}else{
			if(!($score >= 0 && $score <= 100)){
				$this->session->set_flashdata('message', array('content'=>'Some Error Occured, Please Try Again','color'=>'red'));
				redirect(base_url('educational-details'));
			}
		}

		if($other == 1){
			if($newCollege == ''){
				$this->session->set_flashdata('message', array('content'=>'Incomplete Data Inputted.','color'=>'red'));
				redirect(base_url('educational-details'));
			}
		}



		if($this->function_lib->checkEducationUnique($_SESSION['user_data']['userID'], $type) && !(isset($_POST['edit']) && $_POST['edit'] == 1)){
			$this->session->set_flashdata('message', array('content'=>'This Educational Detail is already added. Please Remove the Previous added Detail to add the new data.','color'=>'red'));
				redirect(base_url('educational-details'));
		}else{
			if(isset($_POST['edit']) && $_POST['edit'] == 1){
				$config['upload_path'] = 'assets/uploads/EducationalDocuments';
			 	$config['allowed_types'] = 'pdf';
			 	$config['max_size']	= '3000';
			 	$this->load->library('upload', $config);
			 	$result = $this->upload->do_upload('file');
			 	$x = $this->upload->data();
			 	$error = $this->upload->display_errors();
				$base_url = base_url();
				$fileName = $base_url.'assets/uploads/EducationalDocuments/'.$x['file_name'];
				if($type == 1 || $type == 2){
				if($board == ''){
					$this->session->set_flashdata('message', array('content'=>'Incomplete Data Inputted.2','color'=>'red'));
					redirect(base_url('educational-details'));
				}
				if($error == ''){
					$data = array(
						'userID' => $_SESSION['user_data']['userID'],
						'educationType' => $type,
						'year' => $year,
						'score' => $score,
						'scoreType' => $scoreType,
						'institute' => $board,
						'supportingDocument' => $fileName
					);
				}else{
					$data = array(
						'userID' => $_SESSION['user_data']['userID'],
						'educationType' => $type,
						'year' => $year,
						'score' => $score,
						'scoreType' => $scoreType,
						'institute' => $board
					);
				}
			}
			// var_dump($other);die;
			if($type == 3){
				if($other != 1){
					if($college == ''){
						$this->session->set_flashdata('message', array('content'=>'Incomplete Data Inputted.3','color'=>'red'));
						redirect(base_url('educational-details'));
					}
				}
					if($courseBach == ''){
						$this->session->set_flashdata('message', array('content'=>'Incomplete Data Inputted.4','color'=>'red'));
						redirect(base_url('educational-details'));
					}
					// $newCollege = str_replace(' ', '', $newCollege);
					if($other == 1){
						$data = array(
							'college' => $newCollege,
							'active' => 1
						);
						$this->function_lib->insertCollege($data);
						$college = $this->function_lib->getCollegeID($newCollege);
					}
				
				if($error == ''){
				$data = array(
				'userID' => $_SESSION['user_data']['userID'],
				'educationType' => $type,
				'year' => $year,
				'score' => $score,
				'scoreType' => $scoreType,
				'instituteID' => $college,
				'courseID' => $courseBach,
				'supportingDocument' => $fileName
				);
				}else{
					$data = array(
				'userID' => $_SESSION['user_data']['userID'],
				'educationType' => $type,
				'year' => $year,
				'score' => $score,
				'scoreType' => $scoreType,
				'instituteID' => $college,
				'courseID' => $courseBach
				);
				}
			}
			if($type == 4){
				if($other != 1){
					if($college == ''){
						$this->session->set_flashdata('message', array('content'=>'Incomplete Data Inputted.','color'=>'red'));
						redirect(base_url('educational-details'));
					}
				}
					if($courseBach == ''){
						$this->session->set_flashdata('message', array('content'=>'Incomplete Data Inputted.','color'=>'red'));
						redirect(base_url('educational-details'));
					}
					// $newCollege = str_replace(' ', '', $newCollege);
					if($other == 1){
						$data = array(
							'college' => $newCollege,
							'active' => 1
						);
						$this->function_lib->insertCollege($data);
						$college = $this->function_lib->getCollegeID($newCollege);
					}

				if($error == ''){
				$data = array(
				'userID' => $_SESSION['user_data']['userID'],
				'educationType' => $type,
				'year' => $year,
				'score' => $score,
				'scoreType' => $scoreType,
				'instituteID' => $college,
				'courseID' => $courseMast,
				'supportingDocument' => $fileName
				);
			}else{
				$data = array(
				'userID' => $_SESSION['user_data']['userID'],
				'educationType' => $type,
				'year' => $year,
				'score' => $score,
				'scoreType' => $scoreType,
				'instituteID' => $college,
				'courseID' => $courseMast
				);
			}
			}
				if($this->function_lib->updateEducation($data, $_POST['id'])){
					$this->session->set_flashdata('message', array('content'=>'Education Added Successfully.','color'=>'green'));
					redirect(base_url('educational-details'));
				}else{
					$this->session->set_flashdata('message', array('content'=>'Some Error Occured, Please Try Again','color'=>'red'));
					redirect(base_url('educational-details'));
				}
			}else{
			$config['upload_path'] = 'assets/uploads/EducationalDocuments';
		 	$config['allowed_types'] = 'pdf';
		 	$config['max_size']	= '3000';
		 	$this->load->library('upload', $config);
		 	$result = $this->upload->do_upload('file');
		 	$x = $this->upload->data();
		 	$error = $this->upload->display_errors();
			$base_url = base_url();
			$fileName = $base_url.'assets/uploads/EducationalDocuments/'.$x['file_name'];
			if($type == 1 || $type == 2){
				if($board == ''){
					$this->session->set_flashdata('message', array('content'=>'Incomplete Data Inputted.2','color'=>'red'));
					redirect(base_url('educational-details'));
				}
				if($error == ''){
					$data = array(
						'userID' => $_SESSION['user_data']['userID'],
						'educationType' => $type,
						'year' => $year,
						'score' => $score,
						'scoreType' => $scoreType,
						'institute' => $board,
						'supportingDocument' => $fileName
					);
				}else{
					$data = array(
						'userID' => $_SESSION['user_data']['userID'],
						'educationType' => $type,
						'year' => $year,
						'score' => $score,
						'scoreType' => $scoreType,
						'institute' => $board
					);
				}
			}

			if($type == 3){
				if($other != 1){
					if($college == ''){
						$this->session->set_flashdata('message', array('content'=>'Incomplete Data Inputted.','color'=>'red'));
						redirect(base_url('educational-details'));
					}
				}
					if($courseBach == ''){
						$this->session->set_flashdata('message', array('content'=>'Incomplete Data Inputted.','color'=>'red'));
						redirect(base_url('educational-details'));
					}
					// $newCollege = str_replace(' ', '', $newCollege);
					if($other == 1){
						$data = array(
							'college' => $newCollege,
							'active' => 1
						);
						$this->function_lib->insertCollege($data);
						$college = $this->function_lib->getCollegeID($newCollege);
					}
				if($error == ''){
				$data = array(
				'userID' => $_SESSION['user_data']['userID'],
				'educationType' => $type,
				'year' => $year,
				'score' => $score,
				'scoreType' => $scoreType,
				'instituteID' => $college,
				'courseID' => $courseBach,
				'supportingDocument' => $fileName
				);
				}else{
					$data = array(
				'userID' => $_SESSION['user_data']['userID'],
				'educationType' => $type,
				'year' => $year,
				'score' => $score,
				'scoreType' => $scoreType,
				'instituteID' => $college,
				'courseID' => $courseBach
				);
				}
			}
			if($type == 4){
				if($other != 1){
					if($college == ''){
						$this->session->set_flashdata('message', array('content'=>'Incomplete Data Inputted.','color'=>'red'));
						redirect(base_url('educational-details'));
					}
				}
					if($courseBach == ''){
						$this->session->set_flashdata('message', array('content'=>'Incomplete Data Inputted.','color'=>'red'));
						redirect(base_url('educational-details'));
					}
					// $newCollege = str_replace(' ', '', $newCollege);
					if($other == 1){
						$data = array(
							'college' => $newCollege,
							'active' => 1
						);
						$this->function_lib->insertCollege($data);
						$college = $this->function_lib->getCollegeID($newCollege);
					}
				if($error == ''){
				$data = array(
				'userID' => $_SESSION['user_data']['userID'],
				'educationType' => $type,
				'year' => $year,
				'score' => $score,
				'scoreType' => $scoreType,
				'instituteID' => $college,
				'courseID' => $courseMast,
				'supportingDocument' => $fileName
				);
			}else{
				$data = array(
				'userID' => $_SESSION['user_data']['userID'],
				'educationType' => $type,
				'year' => $year,
				'score' => $score,
				'scoreType' => $scoreType,
				'instituteID' => $college,
				'courseID' => $courseMast
				);
			}
			}
			if($this->function_lib->addEducation($data)){
				$this->session->set_flashdata('message', array('content'=>'Education Added Successfully.','color'=>'green'));
				redirect(base_url('educational-details'));
			}else{
				$this->session->set_flashdata('message', array('content'=>'Some Error Occured, Please Try Again','color'=>'red'));
				redirect(base_url('educational-details'));
			}
		}
		}
	}

	public function addWorkExperience(){
		$companyName = "";
		$position = "";
		$role = "";
		$startMonth = "";
		$startYear = "";
		$endMonth = "";
		$endYear = "";
		$currentWorking = "";

		if($x = $this->input->post('companyName')){
			$companyName = $x;
		}
		if($x = $this->input->post('position')){
			$position = $x;
		}
		if($x = $this->input->post('role')){
			$role = $x;
		}
		if($x = $this->input->post('startMonth')){
			$startMonth = $x;
		}
		if($x = $this->input->post('startYear')){
			$startYear = $x;
		}
		if($x = $this->input->post('endMonth')){
			$endMonth = $x;
		}
		if($x = $this->input->post('endYear')){
			$endYear = $x;
		}
		if($x = $this->input->post('currentWorking')){
			$currentWorking = $x;
		}
		// var_dump($currentWorking);die;
		if($companyName == "" || $position == "" || $role == "" || $startYear == "" || $startMonth == ""){
			$this->session->set_flashdata('message', array('content'=>'Incomplete Data Inputted.','color'=>'red'));
			redirect(base_url('work-experience'));
		}

		if($endYear != "" && $endYear < $startYear){
			$this->session->set_flashdata('message', array('content'=>'End date cannot be less than start date.','color'=>'red'));
			redirect(base_url('work-experience'));
		}

		$ey = $this->getMonth($endMonth);
		$cy = $this->getMonth($startMonth);

		// var_dump($ey);
		// var_dump($cy);die;
		if($endYear == $startYear){
			if($ey < $cy){
				$this->session->set_flashdata('message', array('content'=>'End date cannot be less than start date.','color'=>'red'));
				redirect(base_url('work-experience'));
			}
		}
		if(isset($_POST['edit']) && $_POST['edit'] == 1){
			$config['upload_path'] = 'assets/uploads/WorkExperience';
		 	$config['allowed_types'] = 'pdf';
		 	$config['max_size']	= '3000';
		 	$this->load->library('upload', $config);
		 	$result = $this->upload->do_upload('file');
		 	$x = $this->upload->data();
		 	$error = $this->upload->display_errors();
			$base_url = base_url();
			$fileName = $base_url.'assets/uploads/WorkExperience/'.$x['file_name'];
			if($error == ''){
			$data = array(
				'userID' => $_SESSION['user_data']['userID'],
				'companyName' => $companyName,
				'position' => $position,
				'role' => $role,
				'startYear' => $startYear,
				'startMonth' => $startMonth,
				'endYear' => $endYear,
				'endMonth' => $endMonth,
				'currentlyWorking' => $currentWorking,
				'supportingDocument' => $fileName
			);
			}else{
				$data = array(
				'userID' => $_SESSION['user_data']['userID'],
				'companyName' => $companyName,
				'position' => $position,
				'role' => $role,
				'startYear' => $startYear,
				'startMonth' => $startMonth,
				'endYear' => $endYear,
				'endMonth' => $endMonth,
				'currentlyWorking' => $currentWorking,
			);
			}
			if($this->function_lib->updateWorkExperience($data, $_POST['id'])){
				$this->session->set_flashdata('message', array('content'=>'Work Experience Added Successfully.','color'=>'green'));
				redirect(base_url('work-experience'));
			}else{
				$this->session->set_flashdata('message', array('content'=>'Some Error Occured, Please Try Again','color'=>'red'));
				redirect(base_url('work-experience'));
			}
		}else{
			$config['upload_path'] = 'assets/uploads/WorkExperience';
		 	$config['allowed_types'] = 'pdf';
		 	$config['max_size']	= '3000';
		 	$this->load->library('upload', $config);
		 	$result = $this->upload->do_upload('file');
		 	$x = $this->upload->data();
		 	$error = $this->upload->display_errors();
			$base_url = base_url();
			$fileName = $base_url.'assets/uploads/WorkExperience/'.$x['file_name'];

			$data = array(
				'userID' => $_SESSION['user_data']['userID'],
				'companyName' => $companyName,
				'position' => $position,
				'role' => $role,
				'startYear' => $startYear,
				'startMonth' => $startMonth,
				'endYear' => $endYear,
				'endMonth' => $endMonth,
				'currentlyWorking' => $currentWorking,
				'supportingDocument' => $fileName
			);

			if($this->function_lib->addWorkExperience($data, $id)){
				$this->session->set_flashdata('message', array('content'=>'Work Experience Added Successfully.','color'=>'green'));
				redirect(base_url('work-experience'));
			}else{
				$this->session->set_flashdata('message', array('content'=>'Some Error Occured, Please Try Again','color'=>'red'));
				redirect(base_url('work-experience'));
			}
		}
	}

	public function getMonth($month){
		if($month == 'January')
			return 1;
		if($month == 'February')
			return 2;
		if($month == 'March')
			return 3;
		if($month == 'April')
			return 4;
		if($month == 'May')
			return 5;
		if($month == 'June')
			return 6;
		if($month == 'July')
			return 7;
		if($month == 'August')
			return 8;
		if($month == 'September')
			return 9;
		if($month == 'October')
			return 10;
		if($month == 'November')
			return 11;
		if($month == 'December')
			return 12;
	}

	public function updateGeneralDetails(){
		$location = '';
		if($_SESSION['user_data']['accountType'] == 1){
			$careerObjective = '';
			if($x = $this->input->post('careerObjective')){
				$careerObjective = $x;
			}
			if($x = $this->input->post('location')){
				$location = $x;
			}
			$data = array(
				'careerObjective' => $careerObjective,
				'cityID' => $location
			);
			$result = $this->function_lib->updateGeneralDetails($data, $_SESSION['user_data']['userID']);
		}else{
			$companyName = '';
			$companyDescription = '';
			if($x = $this->input->post('companyName')){
				$companyName = $x;
			}
			if($x = $this->input->post('companyDescription')){
				$companyDescription = $x;
			}
			if($x = $this->input->post('location')){
				$location = $x;
			}
			$data = array(
				'cityID' => $location
			);
			$result = $this->function_lib->updateGeneralDetails($data, $_SESSION['user_data']['userID']);
			if($result){
				$data = array(
					'companyName' => $companyName,
					'companyDescription' => $companyDescription
				);
				$result = $this->function_lib->updateCompanyDetails($data, $_SESSION['user_data']['userID']);
			}else{
				$this->session->set_flashdata('message', array('content'=>'Something Went Wrong. Please Try Again.','color'=>'red'));
				redirect(base_url('general-details'));
			}

		}

		if($result){
			$this->session->set_flashdata('message', array('content'=>'General Details successfully Updated','color'=>'green'));
			redirect(base_url('general-details'));
		}
		else{
			$this->session->set_flashdata('message', array('content'=>'Something Went Wrong. Please Try Again.','color'=>'red'));
			redirect(base_url('general-details'));
		}
	}


	public function addPreferredLocation(){
		$location = "";
		if($x = $this->input->post('preferredLocation')){
			$location = $x;
		}

		if($location == 0){
				$this->session->set_flashdata('message', array('content'=>'Select a location To add Preferred Location.','color'=>'red'));
				redirect(base_url('general-details'));
		}
		$data = array(
			'cityID' => $location,
			'userID' => $_SESSION['user_data']['userID']
		);
		if($this->function_lib->checkPreferredLocationUnique($location, $_SESSION['user_data']['userID'])){
			$this->session->set_flashdata('message', array('content'=>'Preferred Location already Added.','color'=>'red'));
			redirect(base_url('general-details'));
		}
		if($this->function_lib->insertPreferredLocation($data)){
			$this->session->set_flashdata('message', array('content'=>'Preferred Location Added.','color'=>'green'));
			redirect(base_url('general-details'));
		}else{
			$this->session->set_flashdata('message', array('content'=>'Something Went Wrong. Please Try Again.','color'=>'red'));
			redirect(base_url('general-details'));
		}
	}


	public function deletePreferredLocation(){
		$location = $this->input->get('location');
		if($this->function_lib->deletePreferredLocation($location, $_SESSION['user_data']['userID'])){
			$this->session->set_flashdata('message', array('content'=>'Preferred Location Deleted.','color'=>'green'));
			redirect(base_url('general-details'));
		}else{
			$this->session->set_flashdata('message', array('content'=>'Something Went Wrong. Please Try Again.','color'=>'red'));
			redirect(base_url('general-details'));
		}
	}

	public function deleteEducationalDetail(){
		$education = $this->input->get('id');
		// var_dump($this->function_lib->getUserIDForEducation($education)); die;
		if($this->function_lib->getUserIDForEducation($education) != $_SESSION['user_data']['userID']){
			redirect(base_url('404'));
		}
		if($this->function_lib->deleteEducationalDetail($education)){
			$this->session->set_flashdata('message', array('content'=>'Education Deleted.','color'=>'green'));
			redirect(base_url('educational-details'));
		}else{
			$this->session->set_flashdata('message', array('content'=>'Something Went Wrong. Please Try Again.','color'=>'red'));
			redirect(base_url('educational-details'));
		}
	}

	public function deleteWorkExperience(){
		$experience = $this->input->get('id');
		if($this->function_lib->getUserIDForExperience($experience) != $_SESSION['user_data']['userID']){
			redirect(base_url('404'));
		}
		if($this->function_lib->deleteWorkExperience($experience)){
			$this->session->set_flashdata('message', array('content'=>'Experience Deleted.','color'=>'green'));
			redirect(base_url('work-experience'));
		}else{
			$this->session->set_flashdata('message', array('content'=>'Something Went Wrong. Please Try Again.','color'=>'red'));
			redirect(base_url('work-experience'));
		}
	}

	public function updateProfileImage(){
		$profilePic = '';
		$userID = $_SESSION['user_data']['userID'];
		if($x = $this->input->post('profilePic')){
			$profilePic = $x;
		}

		if($profilePic == '' || $profilePic == 'data:,'){
			$this->session->set_flashdata('message', array('content'=>'Some Error Occured, Please Try Again','color'=>'red'));
			redirect(base_url('general-details'));
		}else{
            $result = $this->function_lib->uploadImage($profilePic, 'profile', 'assets/images/profile-images/');
			if($result){
				$this->session->set_flashdata('message', array('content'=>'Profile Image Successfully changed.','color'=>'green'));
				redirect(base_url('general-details'));
			}
			else{
				$this->session->set_flashdata('message', array('content'=>'Some Error Occured, Please Try Again','color'=>'red'));
				redirect(base_url('general-details'));
			}
        }
	}

	public function updateCompanyImage(){
		$companyLogo = '';
		$userID = $_SESSION['user_data']['userID'];
		if($x = $this->input->post('companyLogo')){
			$companyLogo = $x;
		}
		// var_dump($companyLogo); die;
		if($companyLogo == '' || $companyLogo == 'data:,'){
			$this->session->set_flashdata('message', array('content'=>'Some Error Occured, Please Try Again','color'=>'red'));
			redirect(base_url('general-details'));
		}else{
            $result = $this->function_lib->uploadImage($companyLogo, 'company', 'assets/images/company-logos/');
			if($result){
				$this->session->set_flashdata('message', array('content'=>'Logo Successfully changed.','color'=>'green'));
				redirect(base_url('general-details'));
			}
			else{
				$this->session->set_flashdata('message', array('content'=>'Some Error Occured, Please Try Again','color'=>'red'));
				redirect(base_url('general-details'));
			}
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
		$compensationType = '';
		$compensation = '';
		$minCompensation = '';
		$maxCompensation = '';
		$workHome = '';
		$selectedLocations = '';
		$partTime = '';
		$duration = '';
		$applicantType = '';
		$selectedSkills = '';

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
		if($x = $this->input->post('compensationType')){
			$compensationType = $x;
		}
		if($x = $this->input->post('compensation')){
			$compensation = $x;
		}
		if($x = $this->input->post('minCompensation')){
			$minCompensation = $x;
		}
		if($x = $this->input->post('maxCompensation')){
			$maxCompensation = $x;
		}
		if($x = $this->input->post('workHome')){
			$workHome = $x;
		}
		if($x = $this->input->post('selectedLocations')){
			$selectedLocations = $x;
		}
		if($x = $this->input->post('partTime')){
			$partTime = $x;
		}
		if($x = $this->input->post('duration')){
			$duration = $x;
		}
		if($x = $this->input->post('applicantType')){
			$applicantType = $x;
		}
		if($x = $this->input->post('selectedSkills')){
			$selectedSkills = $x;
		}
		$redirect = array(
			'offerType' => $offerType,
			'offerDescription'=> $offerDescription,
			'offerTitle'=> $offerTitle,
			'openings'=> $openings,
			'joiningDate'=> $joiningDate,
			'applicationDeadline'=> $applicationDeadline,
			'compensationType'=> $compensationType,
			'compensation'=> $compensation,
			'minCompensation' => $minCompensation,
			'maxCompensation' => $maxCompensation,
			'workHome' => $workHome,
			'location'=> $selectedLocations,
			'partTime' => $partTime,
			'duration' => $duration,
			'applicantType' => $applicantType,
			'selectedSkills' => $selectedSkills
		);
		// var_dump($redirect); die;
		$_SESSION['redirect'] = $redirect;
		$companyData = $this->function_lib->getCompanyData($_SESSION['user_data']['userID']);
		if($companyData['companyName'] == NULL || $companyData['companyName'] == ''){
			$this->session->set_flashdata('message', array('content'=>'Please Enter Company Details to add offers.','color'=>'red'));
			redirect(base_url('general-details'));
		}
		if($offerType == '1' || $offerType == '2'){
			date_default_timezone_set("Asia/Kolkata");
			$today = date('Y-m-d');
			$d1 = DateTime::createFromFormat('Y-m-d', $joiningDate);
			$d2 = DateTime::createFromFormat('Y-m-d', $applicationDeadline);
			if(!is_numeric($openings)){
				$this->session->set_flashdata('message', array('content'=>'Number of Openings Must be entered as Integer. Please Try Again.','color'=>'red'));
				if(isset($_POST['edit'])){
					redirect(base_url('edit-offer/'.$_POST['edit']));
				}
				redirect(base_url('add-new-offer'));
			}
			if(!is_numeric($duration) && $offerType == 2){
				$this->session->set_flashdata('message', array('content'=>'Duration Must be entered as Integer. Please Try Again.','color'=>'red'));
				if(isset($_POST['edit'])){
					redirect(base_url('edit-offer/'.$_POST['edit']));
				}
				redirect(base_url('add-new-offer'));
			}
			if(!is_numeric($compensation) && $compensationType == 1){
				$this->session->set_flashdata('message', array('content'=>'Compensation Must be entered as Integer. Please Try Again.','color'=>'red'));
				if(isset($_POST['edit'])){
					redirect(base_url('edit-offer/'.$_POST['edit']));
				}
				redirect(base_url('add-new-offer'));
			}
			if(!is_numeric($minCompensation) && $compensationType == 2){
				$this->session->set_flashdata('message', array('content'=>'Compensation Must be entered as Integer. Please Try Again.','color'=>'red'));
				if(isset($_POST['edit'])){
					redirect(base_url('edit-offer/'.$_POST['edit']));
				}
				redirect(base_url('add-new-offer'));
			}
			if(!is_numeric($maxCompensation) && $compensationType == 2){
				$this->session->set_flashdata('message', array('content'=>'Compensation Must be entered as Integer. Please Try Again.','color'=>'red'));
				if(isset($_POST['edit'])){
					redirect(base_url('edit-offer/'.$_POST['edit']));
				}
				redirect(base_url('add-new-offer'));
			}
			if (!($d1 && $d1->format('Y-m-d') === $joiningDate)){
				$this->session->set_flashdata('message', array('content'=>'Something Went Wrong. Please Try Again.','color'=>'red'));
				if(isset($_POST['edit'])){
					redirect(base_url('edit-offer/'.$_POST['edit']));
				}
				redirect(base_url('add-new-offer'));
			}
			if ($joiningDate < $today){
				$this->session->set_flashdata('message', array('content'=>'Offer Joining Date has already Passed. Please Try Again.','color'=>'red'));
				if(isset($_POST['edit'])){
					redirect(base_url('edit-offer/'.$_POST['edit']));
				}
				redirect(base_url('add-new-offer'));
			}
			if (!($d2 && $d2->format('Y-m-d') === $applicationDeadline)){
				$this->session->set_flashdata('message', array('content'=>'Something Went Wrong. Please Try Again.','color'=>'red'));
				if(isset($_POST['edit'])){
					redirect(base_url('edit-offer/'.$_POST['edit']));
				}
				redirect(base_url('add-new-offer'));
			}
			if ($applicationDeadline < $today){
				$this->session->set_flashdata('message', array('content'=>'Application Deadline already Passed. Please Try Again.','color'=>'red'));
				if(isset($_POST['edit'])){
					redirect(base_url('edit-offer/'.$_POST['edit']));
				}
				redirect(base_url('add-new-offer'));
			}
			if ($applicationDeadline >= $joiningDate){
				$this->session->set_flashdata('message', array('content'=>'Offer Joining Date cannot be before the Offer Application Deadline. Please Try Again.','color'=>'red'));
				if(isset($_POST['edit'])){
					redirect(base_url('edit-offer/'.$_POST['edit']));
				}
				redirect(base_url('add-new-offer'));
			}


			if($compensationType == 1){
				if($compensation == ''){
					$this->session->set_flashdata('message', array('content'=>'Incomplete Data. Please Try Again.','color'=>'red'));
					if(isset($_POST['edit'])){
						redirect(base_url('edit-offer/'.$_POST['edit']));
					}
					redirect(base_url('add-new-offer'));
				}
				$data['compensation'] = $compensation;
			}else if($compensationType == 2){
				if($maxCompensation == '' || $minCompensation == ''){
					$this->session->set_flashdata('message', array('content'=>'Incomplete Data. Please Try Again.','color'=>'red'));
					if(isset($_POST['edit'])){
						redirect(base_url('edit-offer/'.$_POST['edit']));
					}
					redirect(base_url('add-new-offer'));
				}
				if($maxCompensation < $minCompensation){
					if($offerType == 2){
						$this->session->set_flashdata('message', array('content'=>'Maximum Stipend Cannot be less than Minimum Stipend. Please Try Again.','color'=>'red'));
					}else{
						$this->session->set_flashdata('message', array('content'=>'Maximum Compensation Cannot be less than Minimum Compensation. Please Try Again.','color'=>'red'));
					}
					if(isset($_POST['edit'])){
						redirect(base_url('edit-offer/'.$_POST['edit']));
					}
					redirect(base_url('add-new-offer'));
				}

				$data['minCompensation'] = $minCompensation;
				$data['maxCompensation'] = $maxCompensation;

			}
			// var_dump($selectedLocations);die;
			if($workHome == 2){
				if($selectedLocations == '[null]' || $selectedLocations == ''){
					$this->session->set_flashdata('message', array('content'=>'Incomplete Data. Please Try Again.','color'=>'red'));
					if(isset($_POST['edit'])){
						redirect(base_url('edit-offer/'.$_POST['edit']));
					}
					redirect(base_url('add-new-offer'));
				}
			}

			if($offerType == 2){
				if($duration == ''){
					$this->session->set_flashdata('message', array('content'=>'Incomplete Data. Please Try Again.','color'=>'red'));
					if(isset($_POST['edit'])){
						redirect(base_url('edit-offer/'.$_POST['edit']));
					}
					redirect(base_url('add-new-offer'));
				}else{
					$data['duration'] = $duration;
				}
			}

			if($applicantType == 2){
				if($selectedSkills == '[null]' || $selectedSkills == ''){
					$this->session->set_flashdata('message', array('content'=>'Incomplete Data. Please Try Again.','color'=>'red'));
					if(isset($_POST['edit'])){
						redirect(base_url('edit-offer/'.$_POST['edit']));
					}
					redirect(base_url('add-new-offer'));
				}
			}

			if($offerType == '' || $offerTitle == '' || $offerDescription == '' || $openings == '' || $joiningDate == '' || $applicationDeadline == ''){
				$this->session->set_flashdata('message', array('content'=>'Incomplete Data. Please Try Again.','color'=>'red'));
				if(isset($_POST['edit'])){
					redirect(base_url('edit-offer/'.$_POST['edit']));
				}
				redirect(base_url('add-new-offer'));
			}
			else{

					$data['offerType'] = $offerType;
					$data['offerTitle'] = $offerTitle;
					$data['offerDescription'] = $offerDescription;
					$data['openings'] = $openings;
					$data['joiningDate'] = $joiningDate;
					$data['applicationDeadline'] = $applicationDeadline;
					$data['workFromHome'] = $workHome;
					$data['partTime'] = $partTime;
					$data['addedBy'] = $_SESSION['user_data']['userID'];
					$data['skillRequired'] = $applicantType;

				if(!isset($_POST['edit'])){
				$result = $this->function_lib->addOffer($data);
				if($result){
					$offerID = $this->function_lib->getCurrentOfferID($_SESSION['user_data']['userID']);
					if($applicantType == 2){
						$skills = json_decode($selectedSkills);
						$i = 0;
						foreach ($skills as $key => $value) {
							if($value == NULL)
								continue;
							$dat[$i]['offerID'] = $offerID;
							$dat[$i]['skillID'] = $value->skillID;
							$i++;
						}
						$result1 = $this->function_lib->addOfferSkills($dat);
					}else{
						$result1 = true;
					}
					if($workHome == 2){
						$locations = json_decode($selectedLocations);
						// var_dump($locations);
						$i = 0;
						foreach ($locations as $key => $value) {
							if($value == NULL)
								continue;
							$dats[$i]['offerID'] = $offerID;
							$dats[$i]['cityID'] = $value->locationID;
							$i++;
						}
						$result2 = $this->function_lib->addOfferlocation($dats);
					}else{
						$result2 = true;
					}
					if($result1 && $result2){
						unset($_SESSION['redirect']);
						$this->session->set_flashdata('message', array('content'=>'Offer added Successfully. Offer Will be approved By CampusPuppy team within 24 hrs.','color'=>'green'));
						if(isset($_POST['edit'])){
							redirect(base_url('my-added-offers'));
					}
						redirect(base_url('add-new-offer'));
					}else{
						$this->session->set_flashdata('message', array('content'=>'Something Went Wrong. Please Try Again.','color'=>'red'));
						if(isset($_POST['edit'])){
							redirect(base_url('edit-offer/'.$_POST['edit']));
						}
						redirect(base_url('add-new-offer'));
					}
				}else{
					$this->session->set_flashdata('message', array('content'=>'Something Went Wrong. Please Try Again.','color'=>'red'));
					if(isset($_POST['edit'])){
						redirect(base_url('edit-offer/'.$_POST['edit']));
					}
					redirect(base_url('add-new-offer'));
				}
			}else{
					$result = $this->function_lib->updateOffer($_POST['edit'], $data);
				if($result){
					 $this->function_lib->deleteSkillsLocations($_POST['edit']);
					 $offerID = $_POST['edit'];
					if($applicantType == 2){
						$skills = json_decode($selectedSkills);
						var_dump($selectedSkills);
						// var_dump($skills);die;
						$i = 0;
						foreach ($skills as $key => $value) {
							if($value == NULL)
								continue;
							$dat[$i]['offerID'] = $offerID;
							$dat[$i]['skillID'] = $value->skillID;
							$i++;
						}
						$result1 = $this->function_lib->addOfferSkills($dat);
					}else{
						$result1 = true;
					}
					if($workHome == 2){
						$locations = json_decode($selectedLocations);
						// var_dump($locations);
						$i = 0;
						foreach ($locations as $key => $value) {
							if($value == NULL)
								continue;
							$dats[$i]['offerID'] = $offerID;
							$dats[$i]['cityID'] = $value->locationID;
							$i++;
						}
						$result2 = $this->function_lib->addOfferlocation($dats);
					}else{
						$result2 = true;
					}
					if($result1 && $result2){
						unset($_SESSION['redirect']);
						$this->session->set_flashdata('message', array('content'=>'Offer Edited Successfully. Offer Will be approved By CampusPuppy team within 24 hrs.','color'=>'green'));
						if(isset($_POST['edit'])){
							redirect(base_url('my-added-offers'));
					}
						redirect(base_url('add-new-offer'));
					}else{
						$this->session->set_flashdata('message', array('content'=>'Something Went Wrong. Please Try Again.','color'=>'red'));
						if(isset($_POST['edit'])){
							redirect(base_url('edit-offer/'.$_POST['edit']));
						}
						redirect(base_url('add-new-offer'));
					}
				}else{
					$this->session->set_flashdata('message', array('content'=>'Something Went Wrong. Please Try Again.','color'=>'red'));
					if(isset($_POST['edit'])){
						redirect(base_url('edit-offer/'.$_POST['edit']));
					}
					redirect(base_url('add-new-offer'));
				}
			}
			}
		}
		else{
			$this->session->set_flashdata('message', array('content'=>'Something Went Wrong. Please Try Again.','color'=>'red'));
			if(isset($_POST['edit'])){
				redirect(base_url('edit-offer/'.$_POST['edit']));
			}
			redirect(base_url('add-new-offer'));
		}

	}

	public function generateReumseReferenceNumber($userID){
			$userID = dechex($userID);
			$lengthUserID = strlen((string)$userID);
			if($lengthUserID == '1'){
				$append = md5($userID);
				$append = substr($append, 0, 5);
			}
			if($lengthUserID == '2'){
				$append = md5($userID);
				$append = substr($append, 0, 4);
			}
			if($lengthUserID == '3'){
				$append = md5($userID);
				$append = substr($append, 0, 3);
			}
			if($lengthUserID == '4'){
				$append = md5($userID);
				$append = substr($append, 0, 2);
			}
			if($lengthUserID == '5'){
				$append = md5($userID);
				$append = substr($append, 0, 1);
			}
			if($lengthUserID == '6'){
				$append = "";
			}
			$userID = $append.$userID;
			$resumeReferenceNumber = "CPR".$userID;
			return $resumeReferenceNumber;
		}

	public function getMoreAddedOffers(){
		$offset = $this->input->get('offset');
		$offset = $offset * 10;
		$data['offers'] = $this->function_lib->getAddedOffers($_SESSION['user_data']['userID'],$offset, 10);
		$data['hasMore'] = $this->function_lib->hasMoreOffers($_SESSION['user_data']['userID'],10, $offset+10);
		$offers = $data['offers'];
		if(!empty($offers)){
			foreach ($offers as $key => $offer) {
				if($offerSkills = $this->function_lib->getOfferSkills($offer['offerID']))
					$data['offerSkills'][$offer['offerID']] = $offerSkills;
				else
					$data['offerSkills'][$offer['offerID']] = array();

				if($offerLocations = $this->function_lib->getOfferLocations($offer['offerID']))
					$data['offerLocations'][$offer['offerID']] = $offerLocations;
				else{
					$data['offerLocations'][$offer['offerID']] = array();
				}
			}
			echo json_encode($data);
		}else{
			echo "false";
		}
	}

	public function getMoreAppliedOffers(){
		$offset = $this->input->get('offset');
		$offset = $offset * 10;
		$data['offers'] = $this->function_lib->getAppliedOffers($_SESSION['user_data']['userID'],$offset, 10, 0);
		$data['hasMore'] = $this->function_lib->hasMoreAppliedOffers($_SESSION['user_data']['userID'],10, $offset+10, 0);
		$offers = $data['offers'];
		if(!empty($offers)){
			foreach ($offers as $key => $offer) {
				if($offerSkills = $this->function_lib->getOfferSkills($offer['offerID']))
					$data['offerSkills'][$offer['offerID']] = $offerSkills;
				else
					$data['offerSkills'][$offer['offerID']] = array();

				if($offerLocations = $this->function_lib->getOfferLocations($offer['offerID']))
					$data['offerLocations'][$offer['offerID']] = $offerLocations;
				else{
					$data['offerLocations'][$offer['offerID']] = array();
				}
			}
			echo json_encode($data);
		}else{
			echo "false";
		}
	}

	public function filterAppliedOffers(){
		unset($_SESSION['filter']);
		unset($_SESSION['data']);
		$status = $this->input->get('status');
		$data['offers'] = $this->function_lib->getAppliedOffers($_SESSION['user_data']['userID'],0, 10, $status);
		$data['hasMore'] = $this->function_lib->hasMoreAppliedOffers($_SESSION['user_data']['userID'],10, 10, $status);
		$data['status'] = $status;
		$offers = $data['offers'];
		// var_dump($offers);die;
		if(!empty($offers)){
			foreach ($offers as $key => $offer) {
				if($offerSkills = $this->function_lib->getOfferSkills($offer['offerID']))
					$data['offerSkills'][$offer['offerID']] = $offerSkills;
				else
					$data['offerSkills'][$offer['offerID']] = array();

				if($offerLocations = $this->function_lib->getOfferLocations($offer['offerID']))
					$data['offerLocations'][$offer['offerID']] = $offerLocations;
				else{
					$data['offerLocations'][$offer['offerID']] = array();
				}
			}
			// var_dump($data); die;
			$_SESSION['filter'] = 1;
			$_SESSION['data'] = $data;
			redirect(base_url('applied-offers'));
		}else{
			$_SESSION['filter'] = 1;
			$_SESSION['data'] = $data;
			redirect(base_url('applied-offers'));
		}
	}

	public function getMoreOffers(){
		$offset = $this->input->get('offset');
		$offset = $offset * 10;
		$data['offers'] = $this->function_lib->getAllOffers($offset, 10);
		$data['hasMore'] = $this->function_lib->hasMoreUserOffers(10, $offset+10);
		$offers = $data['offers'];
		if(!empty($offers)){
			foreach ($offers as $key => $offer) {
				if($offerSkills = $this->function_lib->getOfferSkills($offer['offerID']))
					$data['offerSkills'][$offer['offerID']] = $offerSkills;
				else
					$data['offerSkills'][$offer['offerID']] = array();

				if($offerLocations = $this->function_lib->getOfferLocations($offer['offerID']))
					$data['offerLocations'][$offer['offerID']] = $offerLocations;
				else{
					$data['offerLocations'][$offer['offerID']] = array();
				}
			}
			echo json_encode($data);
		}else{
			echo "false";
		}
	}

	public function apply($offerID){
		if($this->function_lib->auth()){
		if($this->function_lib->checkAlreadyApplied($offerID, $_SESSION['user_data']['userID'])){
			$offer = $this->function_lib->getOfferDetails($offerID);
			$offerSkills = $this->function_lib->getOfferSkills($offerID);
			$userSkills =  $this->skill_lib->getUserSkills($_SESSION['user_data']['userID']);
			$i = 0;
			foreach ($offerSkills as $key => $value) {
				$skills[$i] = $value['skillID'];
				$i++;
			}
			$i=0;
			foreach ($userSkills as $key => $value) {
				$users[$i] = $value['skillID'];
				$i++;
			}
			if($offer[0]['skillRequired'] == 1){
			$data = array(
				'userID' => $_SESSION['user_data']['userID'],
				'offerID' => $offerID,
				'status' => 1
			);
			if($this->function_lib->insertApplicationData($data)){
				$this->session->set_flashdata('message', array('content'=>'Application Successful.','color'=>'green'));
				redirect(base_url('applied-offers'));
			}else{
				$this->session->set_flashdata('message', array('content'=>'Something Went Wrong. Please Try Again.','color'=>'red'));
				redirect(base_url('available-offers'));
			}
		}else{
			if(!empty(array_intersect($skills, $users))){
			$data = array(
				'userID' => $_SESSION['user_data']['userID'],
				'offerID' => $offerID,
				'status' => 1
			);
			if($this->function_lib->insertApplicationData($data)){
				$this->session->set_flashdata('message', array('content'=>'Application Successful.','color'=>'green'));
				redirect(base_url('applied-offers'));
			}else{
				$this->session->set_flashdata('message', array('content'=>'Something Went Wrong. Please Try Again.','color'=>'red'));
				redirect(base_url('available-offers'));
			}
			}else{
			$this->session->set_flashdata('message', array('content'=>'Your Skills Do Not Match the Required Skills.','color'=>'red'));
				redirect(base_url('available-offers'));
			}
		}
		}else{
			$this->session->set_flashdata('message', array('content'=>'You Have Already Applied for the offer.','color'=>'red'));
				redirect(base_url('offer/'.$offerID));
		}
	}else{
			redirect(base_url());
		}
}

	public function filterAvailableOffers(){
		unset($_SESSION['filter']);
		unset($_SESSION['data']);
		unset($_SESSION['appliedFilters']);
		$offerType = '';
		$offerLocations = '';
		$offerSkills = '';
		if($x = $this->input->get('offerType')){
			$offerType = $x;
		}
		if($x = $this->input->get('offerLocations')){
			$offerLocations = $x;
		}
		if($x = $this->input->get('offerSkills')){
			$offerSkills = $x;
		}
			$_SESSION['appliedFilters'] = array(
				'offerType' => $offerType,
				'offerSkills' => $offerSkills,
				'offerLocations' => $offerLocations);
		// var_dump($offerLocations); die;
		$data['offers'] = $this->function_lib->getAllOffers(0,10);
		$data['hasMore'] = $this->function_lib->hasMoreUserOffers(10, 10);

		if(!empty($offerType)){
		$typeOffers = array_column($data['offers'], 'offerID');
		$j = 0;
		foreach ($data['offers'] as $key => $offer) {
			if(!in_array($offer['offerType'], $offerType)){
				unset($typeOffers[$j]);
			}
			$j++;
		}
		}else{
			$typeOffers = array();
		}

		if(!empty($offerSkills)){
		$skillOffers = array_column($data['offers'], 'offerID');
		$j = 0;
		foreach ($data['offers'] as $key => $offer) {
			$offerSkill = $this->function_lib->getOfferSkills($offer['offerID']);
			$i = 0;
			foreach ($offerSkill as $key => $value) {
				$skills[$i] = $value['skillID'];
				$i++;
			}

			if(empty(array_intersect($offerSkills, $skills))){
				if(in_array('0', $offerSkills)){
					if(!empty($offerSkill))
						unset($skillOffers[$j]);
				}else{
					unset($skillOffers[$j]);
				}
			}
			$j++;
		}
		}else{
			$skillOffers = array();
		}


		if(!empty($offerLocations)){
		$locationOffers = array_column($data['offers'], 'offerID');
		$j = 0;
		foreach ($data['offers'] as $key => $offer) {
			$offerLocation = $this->function_lib->getOfferLocations($offer['offerID']);
			$i = 0;

			foreach ($offerLocation as $key => $value) {
				$locations[$i] = $value['cityID'];
				$i++;
			}

			if(empty(array_intersect($offerLocations, $locations))){
				if(in_array('0', $offerLocations)){
					if(!empty($offerLocation))
						unset($locationOffers[$j]);
				}else{
					unset($locationOffers[$j]);
				}
			}
			$j++;
		}
		}else{
			$locationOffers = array();
		}

		$skillLocationFiltered = array_unique(array_merge($locationOffers, $skillOffers));
		if(!empty($skillLocationFiltered) && !empty($typeOffers))
			$filteredOffer =  array_intersect($skillLocationFiltered, $typeOffers);
		else if(empty($skillLocationFiltered) && empty($typeOffers)){
			$filteredOffer = array();
		}else if(empty($skillLocationFiltered)){
			$filteredOffer = $typeOffers;
		}
		else if(empty($typeOffers)){
			$filteredOffer = $skillLocationFiltered;
		}

		$j=0;
		foreach ($data['offers'] as $key => $offer) {
			if(!in_array($offer['offerID'], $filteredOffer)){
				unset($data['offers'][$j]);
			}
			$j++;
		}
		$offers = $data['offers'];
		if(!empty($offers)){
			foreach ($offers as $key => $offer) {
				if($offerSkills = $this->function_lib->getOfferSkills($offer['offerID']))
					$data['offerSkills'][$offer['offerID']] = $offerSkills;
				else
					$data['offerSkills'][$offer['offerID']] = array();

				if($offerLocations = $this->function_lib->getOfferLocations($offer['offerID']))
					$data['offerLocations'][$offer['offerID']] = $offerLocations;
				else{
					$data['offerLocations'][$offer['offerID']] = array();
				}
			}
			// var_dump($_SESSION['appliedFilters']);die;
			$_SESSION['filter'] = 1;
			$_SESSION['data'] = $data;
			redirect(base_url('available-offers'));
		}else{
			$_SESSION['filter'] = 1;
			$_SESSION['data'] = $data;
			redirect(base_url('available-offers'));
		}

	}

	public function filterRelevantAvailable(){
		unset($_SESSION['filter']);
		unset($_SESSION['data']);
		$status = $this->input->get('status');
		$data['offers'] = $this->function_lib->getAllOffers(0, 10);
		$data['hasMore'] = $this->function_lib->hasMoreUserOffers(10, 10);
		if($status == 1){
			redirect(base_url('available-offers'));
		}else{
			$userSkills =  $this->skill_lib->getUserSkills($_SESSION['user_data']['userID']);
			$i=0;
			foreach ($userSkills as $key => $value) {
				$skills[$i] = $value['skillID'];
				$i++;
			}
			$j = 0;
			$data['userSkills'] = $skills;
			foreach ($data['offers'] as $key => $offer) {
				$offerSkills = $this->function_lib->getOfferSkills($offer['offerID']);
				$i = 0;
				foreach ($offerSkills as $key => $value) {
					$offerSkill[$i] = $value['skillID'];
					$i++;
				}
				if(empty(array_intersect($offerSkill, $skills))){
					if(!empty($offerSkills))
					unset($data['offers'][$j]);
				}
				$j++;
			}
		}
		$data['status'] = $status;
		$offers = $data['offers'];
		if(!empty($offers)){
			foreach ($offers as $key => $offer) {
				if($offergetSkills = $this->function_lib->getOfferSkills($offer['offerID'])){
					$data['offerSkills'][$offer['offerID']] = $offergetSkills;
				}
				else
					$data['offerSkills'][$offer['offerID']] = array();

				if($offergetLocations = $this->function_lib->getOfferLocations($offer['offerID']))
					$data['offerLocations'][$offer['offerID']] = $offergetLocations;
				else{
					$data['offerLocations'][$offer['offerID']] = array();
				}
			}

			$_SESSION['filter'] = 1;
			$_SESSION['data'] = $data;
			redirect(base_url('available-offers'));
		}else{
			$_SESSION['filter'] = 1;
			$_SESSION['data'] = $data;
			redirect(base_url('available-offers'));
		}
	}

	public function resetPassword(){
		$registeredEMail = "";
		if($x = $this->input->post('registeredEMail')){
			$registeredEMail = $x;
		}
		if($this->function_lib->checkEMailExist($registeredEMail)){
			$this->generateResetPasswordToken($registeredEMail);
			$this->session->set_flashdata('message', array('content'=>'Password Reset Token has been sent to the requested E-Mail Address','color'=>'green'));
			redirect(base_url('reset-password?email='.$registeredEMail));
		}
		else{
			$this->session->set_flashdata('message', array('content'=>'You are not registered with CampusPuppy. Register a Account today.','color'=>'red'));
			redirect(base_url());
		}
	}

	public function resendPasswordToken(){
		$email = "";
		if($x = $this->input->get('email')){
			$email = $x;
		}
		if($this->function_lib->checkEMailExist($email)){
			$this->generateResetPasswordToken($email);
			$this->session->set_flashdata('message', array('content'=>'Password Reset Token has been sent to the requested E-Mail Address','color'=>'green'));
			redirect(base_url('reset-password?email='.$email));
		}
		else{
			$this->session->set_flashdata('message', array('content'=>'You are not registered with CampusPuppy. Register a Account today.','color'=>'red'));
			redirect(base_url());
		}
	}

	public function resetUserPassword(){
		$token = "";
		$password = "";
		$confirmPassword = "";
		$email = "";
		if($x = $this->input->post('token')){
			$token = $x;
		}
		if($x = $this->input->post('password')){
			$password = $x;
		}
		if($x = $this->input->post('confirmPassword')){
			$confirmPassword = $x;
		}
		if($x = $this->input->post('email')){
			$email = $x;
		}
		$check = $this->function_lib->checkResetToken($email, $token);
		if(empty($check)){
			$this->session->set_flashdata('message', array('content'=>'Some Error Occured, Please Try Again.','color'=>'red'));
			redirect(base_url('reset-password?email='.$email));
		}
		else{
			if($password === $confirmPassword){
				$password = md5($password);
				$result = $this->function_lib->changePassword($email, $password);
				if($result){
					$this->function_lib->resetActivePasswordResetToken($email, $token);
					$this->session->set_flashdata('message', array('content'=>'Your Password is now Successfully Reset.','color'=>'green'));
					redirect(base_url('reset-password?email='.$email));
				}
				else{
					$this->session->set_flashdata('message', array('content'=>'Some Error Occured, Please Try Again.','color'=>'red'));
					redirect(base_url('reset-password?email='.$email));

				}
			}
			else{
				$this->session->set_flashdata('message', array('content'=>'Your Password and Confirm Password do not Match. Please Try Again.','color'=>'red'));
				redirect(base_url('reset-password?email='.$email));
			}
		}
	}

	public function generateResetPasswordToken($email){
		date_default_timezone_set("Asia/Kolkata");
		$checkCode = $this->function_lib->checkResetPasswordToken($email);
		$currentTime = strtotime(date("d M Y H:i:s"));
		if($checkCode){
			$expiry = $checkCode[0]['expiry'];
			$timeDifference = $expiry-$currentTime;
			if($timeDifference>0 && $timeDifference<7200){
				$msg = "Your Reset Password Token is: ".$checkCode[0]['token'].". The token is valid for only next 2 hours.";
				$this->sendResetPasswordEMail($email, $msg);
			}
			else{
				$token = rand(100000,999999);
				$expiry = $currentTime + 7200;
				$tokenData = array(
					'token' => $token,
					'email' => $email,
					'generatedAt' => $currentTime,
					'expiry' => $expiry,
					'active' => '1'
				);
				$this->function_lib->insertResetPasswordToken($tokenData);
				$msg =  "Your Reset Password Token is: ".$token.". The token is valid for only next 2 hours.";
				$this->sendResetPasswordEMail($email, $msg);
			}
		}
		else {
			$token = rand(100000,999999);
			$expiry = $currentTime + 7200;
			$tokenData = array(
				'token' => $token,
				'email' => $email,
				'generatedAt' => $currentTime,
				'expiry' => $expiry,
				'active' => '1'
			);
			$this->function_lib->insertResetPasswordToken($tokenData);
			$msg =  "Your Reset Password Token is: ".$code.". The token is valid for only next 2 hours.";
			$this->sendResetPasswordEMail($email, $msg);
		}
	}

	private function sendResetPasswordEMail($email, $msg){
		$this->load->helper('mail_helper');
		$this->data['msg'] = $msg;
		$message =  $this->load->view('emailers/resetPassword', $this->data, true);
		$data = array(
				'sendToEmail' => $email,
				'fromName' => 'Campus Puppy Private Limited',
				'fromEmail' => 'no-reply@campuspuppy.com',
				'subject' => 'Reset Password|Campus Puppy Private Limited',
				'message' => $message,
				'using' =>'pepipost'
				);
		sendEmail($data);
	}

}
