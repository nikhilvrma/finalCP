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

	public function updateGeneralDetails($data, $userID){
		$this->db->where('userID', $userID);
		return $this->db->update('users', $data);
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





////////////////////////////////////////////////////////////
//Skills

	public function getActiveSkills(){
		$result = $this->db->get_where('skills', array('active' => 1));
		return $result->result_array();
	}

	public function getNotAddedSkills($userID){
		$this->db->select('skillID');
		$result = $this->db->get_where('userSkills', array('userID'=>$userID))->result_array();
		$this->db->where_not_in($result);
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
////////////////////////////////////////////////////////////
}