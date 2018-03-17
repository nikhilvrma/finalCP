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

}
