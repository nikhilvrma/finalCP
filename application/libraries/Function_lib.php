<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Function_lib {

	public function login($email,$password){
		$CI =& get_instance();
		$CI->load->model('function_model','function');
		$result = $CI->function->login($email,$password);
		$userData = $CI->function->getUserData($email);
		if ($result) {
			$data = array(
				'loggedIn' => true,
				'userID' => $userData[0]['userID'],
				'email' => $email,
				'name' => $userData[0]['name'],
				'profileImage'	=>	$userData[0]['profileImage'],
				'accountType' => $userData[0]['accountType'],
				'emailVerified' => $userData[0]['emailVerified'],
				'mobileVerified' => $userData[0]['mobileVerified']
				);
			$CI->session->set_userdata('user_data', $data);
			return 1;
		}
		return 0;
	}

	public function auth(){
		$CI = & get_instance();
		$CI->load->library('session');
		$data = $CI->session->userdata('user_data');
		if (isset($data['loggedIn']) && $data['loggedIn']) {
			return 1;
		}
		return 0;
	}

	public function insertCompanyData($userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->insertCompanyData($userID);
	}

	public function getCompanyData($userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getCompanyData($userID);
	}

	public function getPreferredLocations($userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getPreferredLocations($userID);
	}


	public function getUserGeneralData($userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getUserGeneralData($userID);
	}

	public function getUserEducationalDetails($userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getUserEducationalDetails($userID);
	}

	public function getUserWorkExperience($userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getUserWorkExperience($userID);
	}

	public function insertPreferredLocation($data){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->insertPreferredLocation($data);
	}

	public function checkPreferredLocationUnique($location, $userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->checkPreferredLocationUnique($location, $userID);
	}

	public function deletePreferredLocation($location, $userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->deletePreferredLocation($location, $userID);
	}

	public function deleteEducationalDetail($education){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->deleteEducationalDetail($education);
	}

	public function deleteWorkExperience($experience){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->deleteWorkExperience($experience);
	}

	public function getColleges(){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getColleges();
	}


	public function getCourses(){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getCourses();
	}


	public function getAllLocations(){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getAllLocations();
	}

	public function updateGeneralDetails($data, $userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->updateGeneralDetails($data, $userID);
	}

	public function updateCompanyDetails($data, $userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->updateCompanyDetails($data, $userID);
	}

	public function uploadImage($image, $type ,$path = 'assets/uploads/'){
		if(empty($image)){
			return false;
		}
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		var_dump(base_url());
		$upload_path = $path;
		$name = $CI->function->getFilename($type,$_SESSION['user_data']['userID']);
		$upload_path .= $name.'_'.str_replace(['-',':'],'',(new DateTime())->format('d-m-YH:i:s')).'.jpg';
		$ifp = fopen($upload_path, "wb");
		$data = explode(',', $image);
		fwrite($ifp, base64_decode($data[1]));
		fclose($ifp);
		var_dump($upload_path);
		if($this->validateImage($upload_path)){
			if($type == 'company' ){
				$logo['companyLogo'] = base_url($upload_path);
				return $CI->function->updateCompanyLogo($_SESSION['user_data']['userID'], $logo);
			}else{
				$picture['profileImage'] = base_url($upload_path);
				return $CI->function->updateProfileImage($_SESSION['user_data']['userID'], $picture);
			}
		}else{
			return false;
		}
		return false;
	}

	public function validateImage($file)
	{
		$data = getimagesize($file);
		if($data[0] > 400 || $data[1] > 400){
			$this->set_flashdata('error', 'Image dimensions must be under 300 * 300.');
			return false;
		}else if(filesize($file) > 2048000){
			$this->set_flashdata('error', 'The file size must be under 2MB.');
			return false;
		}else{
			return true;
		}
	}

	public function checkEMailExist($email){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->checkEMailExist($email);
	}

	public function checkMobileExist($mobile){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->checkMobileExist($mobile);
	}

	public function register($data){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->register($data);
	}

	public function getUserData($email){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getUserData($email);
	}

	public function addOffer($data){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->addOffer($data);
	}

	public function checkPasswordMatch($email, $password){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->checkPasswordMatch($email, $password);
	}

	public function changePassword($email, $password){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->changePassword($email, $password);
	}

	public function checkEducationUnique($userID, $type){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->checkEducationUnique($userID, $type);
	}

	public function addEducation($data){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->addEducation($data);
	}

	public function addWorkExperience($data){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->addWorkExperience($data);
	}

	public function updateEducation($data, $id){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->updateEducation($data, $id);
	}

	public function updateWorkExperience($data, $id){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->updateWorkExperience($data, $id);
	}


	public function getSkills(){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getSkills();
	}

	public function getCurrentOfferID($userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getCurrentOfferID($userID);
	}

	public function addOfferSkills($data){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->addOfferSkills($data);
	}

	public function addOfferLocation($data){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->addOfferLocation($data);
	}

	public function getAddedOffers($userID, $offset, $limit){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getAddedOffers($userID, $offset, $limit);
	}

	public function hasMoreOffers($userID, $limit, $offset){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->hasMoreOffers($userID, $limit, $offset);
	}

	public function getAllOffers($offset, $limit){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getAllOffers($offset, $limit);
	}

	public function hasMoreUserOffers($limit, $offset){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->hasMoreUserOffers($limit, $offset);
	}

	public function getOfferSkills($offerID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getOfferSkills($offerID);
	}

	public function getOfferDetails($offerID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getOfferDetails($offerID);
	}

	public function getOfferLocations($offerID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getOfferLocations($offerID);
	}

	public function contactUs($data){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->contactUs($data);
	}

}
