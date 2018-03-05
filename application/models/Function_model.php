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

	public function register($data){
		return $this->db->insert('users', $data);
	}

}
