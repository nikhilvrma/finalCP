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

}
