<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Function_lib {

	public function login($username,$password){
		$CI =& get_instance();
		$CI->load->model('function_model','function');
		$result = $CI->function->login($username,$password);
		$userData = $CI->function->getUserData($username);
		if ($result) {
			$data = array(
				'loggedIn' => true,
				'username' => $username,
				'name' => $userData[0]['name'],
				'profileImage'	=>	$userData[0]['profileImage']
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

	public function getCourses(){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getCourses();
	}

	public function getColleges(){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getColleges();
	}

	public function getSkillQuestions(){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getSkillQuestions();
	}

}
