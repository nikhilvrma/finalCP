<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Psych_functions extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library(array('session', 'function_lib', 'skill_lib', 'psych_lib'));
		$this->load->helper(array('url'));
		$this->data = array();

		$this->data['message'] = ($v = $this->session->flashdata('message'))?$v:array('content'=>'','color'=>'');

		// $this->data['csrf_token_name'] = $this->security->get_csrf_token_name();
	}

	 public function beginTest(){
			$_SESSION['userData']['intest'] = false;
			$testTime = $this->psych_lib->getTestSettings()[0]['testTime'];
			$_SESSION['userData']['psychTest']['totalTime'] = $testTime;
			$numberQuestions = $this->psych_lib->getTestSettings()[0]['numberOfQuestions'];
			$_SESSION['userData']['psychTest']['numberQuestions'] = $numberQuestions;
			$_SESSION['userData']['psychTest']['responses'] = array();

			// $_SESSION['categories'] = $this->psych_lib->getPsychCategories();
			$question = $this->getQuestionDetails();
			$question = $question[0];
			$options = json_decode($question['psychometricE1psychometricEvaluationQuestionOptions']);
			$options = (array) $options;
			$i = 1;
			foreach ($options as $key => $value) {
				$option['option'.$i] = (array)$options['option'.$i];
				$i++;
			}
			$questionDetails[0]['questionID'] = $question['psychometricEvaluationQuestionID'];
			$questionDetails[0]['question'] = $question['psychometricEvaluationQuestion'];
			$i = 1;
			foreach ($option as $key => $value) {
				$questionDetails[0]['option'.$i] = $option['option'.$i]['option'];
					$questionDetails[0]['category'.$i] = $option['option'.$i]['category'];
				$i++;
			}
			$_SESSION['questionData'] = $questionDetails;
			$_SESSION['numberQuestions'] = 1;
			$_SESSION['userData']['psychTest']['userResponses'] = array();

			if($_SESSION['userData']['psychTest']['numberQuestions'] != NULL && $_SESSION['numberQuestions'] > $_SESSION['userData']['psychTest']['numberQuestions']){
				redirect(base_url('psych_functions/endTest'));
			}
			redirect(base_url('psychometric-evaluation-test'));
		}

		public function nextQuestion(){
			if(!$_SESSION['userData']['intest']){
				$this->session->set_flashdata('message', array('content'=>'You Need to Start or Resume a test to Answer.','color'=>'red'));
				redirect(base_url('skill-tests'));
			}
			$answer = $this->input->get('answer');
			$_SESSION['userData']['psychTest']['totalTime'] = $this->input->get('totalTime');
			$data = array(
				'userID' => $_SESSION['user_data']['userID'],
				'questionID' => $_SESSION['questionData'][0]['questionID'],
				'responseOption' => $answer,
				'psychometricEvaluationCategoryID' => $_SESSION['questionData'][0]['category'.$answer],
				'responseAt' => date('Y-m-d H:i:s')
				);
				array_push($_SESSION['userData']['psychTest']['userResponses'], $data);
				array_push($_SESSION['userData']['psychTest']['responses'], $_SESSION['questionData'][0]['questionID']);
				$question = $this->getQuestionDetails();
				if(empty($question)){
					echo 'false';die;
				}
				$question = $question[0];
				$options = json_decode($question['psychometricE1psychometricEvaluationQuestionOptions']);
				$options = (array) $options;
				$i = 1;
				foreach ($options as $key => $value) {
					$option['option'.$i] = (array)$options['option'.$i];
					$i++;
				}
				$questionDetails[0]['questionID'] = $question['psychometricEvaluationQuestionID'];
				$questionDetails[0]['question'] = $question['psychometricEvaluationQuestion'];
				$i = 1;
				foreach ($option as $key => $value) {
					$questionDetails[0]['option'.$i] = $option['option'.$i]['option'];
						$questionDetails[0]['category'.$i] = $option['option'.$i]['category'];
					$i++;
				}
				$_SESSION['questionData'] = $questionDetails;
				$_SESSION['numberQuestions']++;
				$testData['questionData'] = $_SESSION['questionData'][0];
				if($_SESSION['userData']['psychTest']['numberQuestions'] != NULL && $_SESSION['numberQuestions'] > $_SESSION['userData']['psychTest']['numberQuestions']){
					echo 'false';die;
				}
					echo json_encode($testData);
		}

	public function endTest(){
		$userID = $_SESSION['user_data']['userID'];
		if($this->psych_lib->updateResponse($_SESSION['userData']['psychTest']['userResponses'])){
			$this->session->set_flashdata('message', array('content'=>'Congratulations, you completed the test your behaviour traits has been added to your profile.','color'=>'green'));
		}else{
			$this->session->set_flashdata('message', array('content'=>'Something went wrong. Please Try Again','color'=>'red'));
		}
		$this->updateInfo();
		redirect(base_url('psychometric-evaluation'));
	}

	public function updateInfo(){
		$_SESSION['questionData'] = NULL;
		$_SESSION['userData']['psychTest']['totalTime'] = NULL;
		$_SESSION['userData']['psychTest']['responses'] = NULL;
		$_SESSION['userData']['psychTest']['userResponses'] = NULL;
		$_SESSION['userData']['psychTest']['numberQuestions'] = NULL;
		$_SESSION['userData']['intest'] = false;
	}

	private function getQuestionDetails(){
		$questionDetails = $this->psych_lib->getQuestionDetails();
		return $questionDetails;
	}

	private function calculateScore($difficulty_level = 1, $expert_time, $timeConsumed, $correct){
		$score = 0;
		if($correct == 0){
			$correct = -1;
		}
		$score = pow(((pow(3, ($difficulty_level/2)) * ((2*$expert_time)-$timeConsumed))/(2*$expert_time)), (2/$difficulty_level));
		$score = $score * $correct;
		if($correct == -1){
			$score = $score/2;
		}
		return $score;
	}



}
