<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Function_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function login($username,$password){
		$result = $this->db->get_where('users', array('username' => $username,'password' => $password, 'active'=>1), 1, 0);
		if ($result->num_rows()>0) {
			return $result;
		}
		return false;
	}

	public function getUserData($username){
		$result = $this->db->get_where('adminAuth', array('username' => $username));
		return $result->result_array();
	}

	public function getCourses(){
		$result = $this->db->get('courses');
		return $result->result_array();
	}

	public function getColleges(){
		$result = $this->db->get('colleges');
		return $result->result_array();
	}

	public function getSkillQuestions(){
		$this->db->select('skillQuestions.question, skills.skill_name');
		$this->db->join('skills', 'skills.skillID=skillQuestions.skill_id');
		$result = $this->db->get('skillQuestions');
		return $result->result_array();
	}

}
