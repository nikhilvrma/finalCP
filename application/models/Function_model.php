<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Function_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function login($email,$password){
		$result = $this->db->get_where('users', array('email' => $email,'password' => $password, 'active'=>1), 1, 0);
		if ($result->num_rows()>0) {
			return $result;
		}
		return false;
	}

	public function getAllLocations(){
		return $this->db->get('indianCities')->result_array();
	}

	public function getUserData($email){
		$result = $this->db->get_where('users', array('email' => $email));
		return $result->result_array();
	}

	public function checkEMailExist($email){
		$result = $this->db->get_where('users', array('email' => $email), 1, 0);
		if ($result->num_rows()>0) {
			return true;
		}
		return false;
	}

	public function checkMobileExist($mobile){
		$result = $this->db->get_where('users', array('mobile' => $mobile), 1, 0);
		if ($result->num_rows()>0) {
			return true;
		}
		return false;
	}

	public function getPreferredLocations($userID){
		$this->db->join('indianCities', 'preferredLocations.cityID = indianCities.cityID');
		$result = $this->db->get_where('preferredLocations', array('userID'=>$userID));
		return $result->result_array();
	}

	public function insertPreferredLocation($data){
		return $this->db->insert('preferredLocations', $data);
	}

	public function checkPreferredLocationUnique($location, $userID){
		$result = $this->db->get_where('preferredLocations', array('cityID'=> $location, 'userID' => $userID));
		if($result->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function deletePreferredLocation($location, $userID){
		$this->db->where(array('userID' => $userID, 'cityID' => $location));
		return $this->db->delete('preferredLocations');
	}

	public function deleteEducationalDetail($education){
		$this->db->where(array('educationID' => $education));
		return $this->db->delete('educationalDetails');
	}

	public function deleteWorkExperience($experience){
		$this->db->where(array('workExperienceID' => $experience));
		return $this->db->delete('workExperience');
	}

	public function updateGeneralDetails($data, $userID){
		$this->db->where('userID', $userID);
		return $this->db->update('users', $data);
	}

	public function updateCompanyDetails($data, $userID){
		$this->db->where('userID', $userID);
		return $this->db->update('employerUsers', $data);
	}

	public function updateCompanyLogo($userId, $logo){
		$CI =& get_instance();
		$_SESSION['user_data']['companyLogo'] = $image['companyLogo'];
		$this->db->where('userID', $userId);
		return $this->db->update('employerUsers', $logo);
	}

	public function getFilename($type, $userId){
		if($type == 'company'){
			$this->db->select('companyName');
			$this->db->where('userID', $userId);
			$result = $this->db->get('employerUsers')->result_array();
			$result = $result[0]['companyName'];
		}else{
			$this->db->select('name');
			$this->db->where('userID', $userId);
			$result = $this->db->get('users')->result_array();
			$result = $result[0]['name'];
		}
		return str_replace(' ', '_', $result).$userId;
	}

	public function updateProfileImage($userId, $image){
		$CI =& get_instance();
		$_SESSION['user_data']['profileImage'] = $image['profileImage'];
		$this->db->where('userID', $userId);
		return $this->db->update('users', $image);
	}

	public function register($data){
		return $this->db->insert('users', $data);
	}

	public function addOffer($data){
		return $this->db->insert('offers', $data);
	}

	public function checkPasswordMatch($email, $password){
		$result = $this->db->get_where('users', array('email' => $email,'password' => $password), 1, 0);
		if ($result->num_rows()>0) {
			return true;
		}
		return false;
	}

	public function changePassword($email, $password){
		$query = "UPDATE users SET password='$password' WHERE email='$email'";
		return $this->db->query($query);
	}

	public function checkEducationUnique($userID, $type){
		$result = $this->db->get_where('educationalDetails', array('userID' => $userID, 'educationType' => $type));
		if($result->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function addEducation($data){
		return $this->db->insert('educationalDetails', $data);
	}

	public function updateEducation($data, $educationID){
		$this->db->where('educationID', $educationID);
		return $this->db->update('educationalDetails', $data);
	}

	public function getUserEducationalDetails($userID){
		$result = $this->db->get_where('educationalDetails', array('userID'=>$userID));
		return $result->result_array();
	}

	public function getUserWorkExperience($userID){
		$result = $this->db->get_where('workExperience', array('userID'=>$userID));
		return $result->result_array();
	}

	public function addWorkExperience($data){
		return $this->db->insert('workExperience', $data);
	}

	public function updateWorkExperience($data, $workExperience){
		$this->db->where('workExperienceID', $workExperience);
		return $this->db->update('workExperience', $data);
	}



////////////////////////////////////////////////////////////
//Skills

	public function getActiveSkills(){
		$result = $this->db->get_where('skills', array('active' => 1));
		return $result->result_array();
	}

	public function getNotAddedSkills($userID){
		$this->db->select('skillID');
		$result = $this->db->get_where('userSkills', array('userID'=>$userID));
		// echo "string";
		// var_dump($result);die;
		$i = 0;
		$result1 = $result->result_array();
		if($result->num_rows()>0){
		foreach ($result1 as $key => $value) {
			$res[$i] = $value['skillID'];
			$i++;
		}

		$this->db->where_not_in('skillID',$res);
		}
		$result = $this->db->get_where('skills', array('active' => 1));
		return $result->result_array();
	}

	public function getPremiumSkills($userID){
		$this->db->join('skills','skills.skillID = userSkills.skillID');
		$result = $this->db->get_where('userSkills', array('type' => 2, 'userID' => $userID));
		return $result->result_array();
	}

	public function getOtherSkills($userID){
		$this->db->join('skills','skills.skillID = userSkills.skillID');
		$result = $this->db->get_where('userSkills', array('type' => 1, 'userID' => $userID));
		return $result->result_array();
	}

	public function getTestSettings($skillID){
		return $this->db->get_where('testSettings', array('skillID' => $skillID))->result_array();
	}

	public function getSkillData($skill_id)
	{
		$this->db->select('*');
		$this->db->where('skillID', $skill_id);
		return $this->db->get('skills')->result_array();
	}

	public function getQuestionDetails($skillID, $max = 0){
		$this->db->select('question_id, question, option1, option2, option3, option4, expert_time');
		$this->db->where_in('difficulty_level', [1,2]);
		if(!empty($_SESSION['userData'][$skillID]['responses']))
		$this->db->where_not_in('question_id', $_SESSION['userData'][$skillID]['responses']);
		$this->db->where('skill_id', $skillID);
		$this->db->order_by('RAND()');
		$result = $this->db->get('skillQuestions',1);
		return $result->result_array();
	}

	public function getAnswer($questionID){
		$this->db->select('answer');
		$this->db->where('question_id', $questionID);
		return $this->db->get('skillQuestions')->result_array();
	}

	public function updateResponse($data){
		return $this->db->insert('skillResponses', $data);
	}

	public function addSkilltoUser($skill_id, $user_id, $score){
		$data = ['skillID'=> $skill_id, 'userID'=> $user_id, 'score'=> $score, 'status'=> 4, 'type' => 1];
		// var_dump($data);die;
		return $this->db->insert('userSkills', $data);
	}

	public function testAvailable($skillID){
		$this->db->select('testAvailable');
		$result = $this->db->get_where('skills', array('skillID'=>$skillID))->result_array();
		return $result[0]['testAvailable'];
	}

	public function getSkills(){
		$result = $this->db->get_where('skills', array('active'=>1));
		return $result->result_array();
	}


////////////////////////////////////////////////////////////
}
