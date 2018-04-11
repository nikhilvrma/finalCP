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
						if($accountType=='1'){
							$userID = $this->function_lib->getUserData($email);
							$userID = $userID[0]['userID'];
							$resumeReferenceNumber = $this->generateReumseReferenceNumber($userID);
							$data = array(
								'resumeReferenceNumber' => $resumeReferenceNumber
							);
							$this->function_lib->updateGeneralDetails($data, $userID);
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


	public function addEducation(){
		$type = "";
		$year = "";
		$scoreType = "";
		$score = "";
		$board = "";
		$courseBach = '';
		$courseMast = '';
		$college = '';
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

		if($type == "" || $year == "" || $scoreType == "" || $score == ""){
			$this->session->set_flashdata('message', array('content'=>'Incomplete Data Inputted.1','color'=>'red'));
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

			if($type == 3){
				if($college == ''|| $courseBach == ''){
					$this->session->set_flashdata('message', array('content'=>'Incomplete Data Inputted.3','color'=>'red'));
					redirect(base_url('educational-details'));
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
				if($college == ''|| $courseMast == ''){
					$this->session->set_flashdata('message', array('content'=>'Incomplete Data Inputted.4','color'=>'red'));
					redirect(base_url('educational-details'));
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
				if($college == ''|| $courseBach == ''){
					$this->session->set_flashdata('message', array('content'=>'Incomplete Data Inputted.3','color'=>'red'));
					redirect(base_url('educational-details'));
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
				if($college == ''|| $courseMast == ''){
					$this->session->set_flashdata('message', array('content'=>'Incomplete Data Inputted.4','color'=>'red'));
					redirect(base_url('educational-details'));
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
			$this->session->set_flashdata('message', array('content'=>'Career Objective successfully Updated','color'=>'green'));
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
            $result = $this->function_lib->uploadImage($profilePic, 'profile', 'assets/uploads/ProfileImages/');
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
		var_dump($companyLogo); die;
		if($companyLogo == '' || $companyLogo == 'data:,'){
			$this->session->set_flashdata('message', array('content'=>'Some Error Occured, Please Try Again','class'=>'error'));
			redirect(base_url('general-details'));
		}else{
            $result = $this->function_lib->uploadImage($companyLogo, 'company', 'assets/uploads/CompanyLogo/');
			if($result){
				$this->session->set_flashdata('message', array('content'=>'Logo Successfully changed.','class'=>'success'));
				redirect(base_url('general-details'));
			}
			else{
				$this->session->set_flashdata('message', array('content'=>'Some Error Occured, Please Try Again','class'=>'error'));
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
		$location = '';
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
		if($x = $this->input->post('location')){
			$location = $x;
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
			'location'=> $location,
			'partTime' => $partTime,
			'duration' => $duration,
			'applicantType' => $applicantType,
			'selectedSkills' => $selectedSkills
		);
		$_SESSION['redirect'] = $redirect;

		if($offerType == '1' || $offerType == '2'){
			date_default_timezone_set("Asia/Kolkata");
			$today = date('Y-m-d');
			$d1 = DateTime::createFromFormat('Y-m-d', $joiningDate);
			$d2 = DateTime::createFromFormat('Y-m-d', $applicationDeadline);

			if (!($d1 && $d1->format('Y-m-d') === $joiningDate)){
				$this->session->set_flashdata('message', array('content'=>'Something Went Wrong. Please Try Again.','color'=>'red'));
				redirect(base_url('add-new-offer'));
			}
			if ($joiningDate < $today){
				$this->session->set_flashdata('message', array('content'=>'Offer Joining Date has already Passed. Please Try Again.','color'=>'red'));
				redirect(base_url('add-new-offer'));
			}
			if (!($d2 && $d2->format('Y-m-d') === $applicationDeadline)){
				$this->session->set_flashdata('message', array('content'=>'Something Went Wrong. Please Try Again.','color'=>'red'));
				redirect(base_url('add-new-offer'));
			}
			if ($applicationDeadline < $today){
				$this->session->set_flashdata('message', array('content'=>'Application Deadline already Passed. Please Try Again.','color'=>'red'));
				redirect(base_url('add-new-offer'));
			}
			if ($applicationDeadline > $joiningDate){
				$this->session->set_flashdata('message', array('content'=>'Offer Joining Date cannot be before the Offer Application Deadline. Please Try Again.','color'=>'red'));
				redirect(base_url('add-new-offer'));
			}


			if($compensationType == 1){
				if($compensation == ''){
					$this->session->set_flashdata('message', array('content'=>'Incomplete Data. Please Try Again.','color'=>'red'));
					redirect(base_url('add-new-offer'));
				}
				$data['compensation'] = $compensation;
			}else if($compensationType == 2){
				if($maxCompensation == '' || $minCompensation == ''){
					$this->session->set_flashdata('message', array('content'=>'Incomplete Data. Please Try Again.','color'=>'red'));
					redirect(base_url('add-new-offer'));
				}
				if($maxCompensation < $minCompensation){
					if($offerType == 2){
						$this->session->set_flashdata('message', array('content'=>'Maximum Stipend Cannot be less than Minimum Stipend. Please Try Again.','color'=>'red'));
					}else{
						$this->session->set_flashdata('message', array('content'=>'Maximum Compensation Cannot be less than Minimum Compensation. Please Try Again.','color'=>'red'));
					}
					redirect(base_url('add-new-offer'));
				}

				$data['minCompensation'] = $minCompensation;
				$data['maxCompensation'] = $maxCompensation;

			}

			if($workHome == 2){
				if($location == 0){
					$this->session->set_flashdata('message', array('content'=>'Incomplete Data. Please Try Again.1','color'=>'red'));
					redirect(base_url('add-new-offer'));
				}
			}	

			if($offerType == 2){
				if($duration == ''){
					$this->session->set_flashdata('message', array('content'=>'Incomplete Data. Please Try Again.2','color'=>'red'));
					redirect(base_url('add-new-offer'));
				}else{
					$data['duration'] = $duration;
				}
			}

			if($applicantType == 2){
				if($selectedSkills == ''){
					$this->session->set_flashdata('message', array('content'=>'Incomplete Data. Please Try Again.3','color'=>'red'));
					redirect(base_url('add-new-offer'));
				}
			}

			if($offerType == '' || $offerTitle == '' || $offerDescription == '' || $openings == '' || $joiningDate == '' || $applicationDeadline == ''){
				$this->session->set_flashdata('message', array('content'=>'Incomplete Data. Please Try Again.4','color'=>'red'));
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
				
				$result = $this->function_lib->addOffer($data);
				if($result){
					$offerID = $this->function_lib->getCurrentOfferID($_SESSION['user_data']['userID']);
					if($applicantType == 2){
						$skills = json_decode($selectedSkills);
						$i = 0;
						foreach ($skills as $key => $value) {
							$dat[$i]['offerID'] = $offerID;
							$dat[$i]['skillID'] = $value->skillID;
							$i++;
						}
						$result1 = $this->function_lib->addOfferSkills($dat);
					}else{
						$result1 = true;
					}
					if($workHome == 2){
						$dats = array(
							'offerID' => $offerID,
							'cityID' => $location
						);
						$result2 = $this->function_lib->addOfferLocation($dats);
					}else{
						$result2 = true;
					}	
					if($result1 && $result2){
						$this->session->set_flashdata('message', array('content'=>'Offer added Successfully.','color'=>'green'));
						redirect(base_url('add-new-offer'));
					}
				}else{
					$this->session->set_flashdata('message', array('content'=>'Something Went Wrong. Please Try Again.','color'=>'red'));
					redirect(base_url('add-new-offer'));
				}
			}
		}
		else{
			$this->session->set_flashdata('message', array('content'=>'Something Went Wrong. Please Try Again.','color'=>'red'));
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

}
