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
			$_SESSION['userData']['psychTest']['totalScore'] = 0;
			$_SESSION['userData']['psychTest']['skips'] = 3;
			$_SESSION['userData']['psychTest']['skipStatus'] = 0;
			$_SESSION['userData']['psychTest']['level'] = 1;
			$testTime = $this->psych_lib->getTestSettings()[0]['testTime'];
			$_SESSION['userData']['psychTest']['totalTime'] = $testTime;
			$numberQuestions = $this->psych_lib->getTestSettings()[0]['numberOfQuestions'];
			$_SESSION['userData']['psychTest']['numberQuestions'] = $numberQuestions;
			$_SESSION['userData']['psychTest']['responses'] = array();
			$_SESSION['questionData'] = $this->getQuestionDetails();
			var_dump($_SESSION['questionData']);die;
			redirect(base_url('skill-test'));
		}

		public function nextQuestion(){
			if(!$_SESSION['userData']['intest']){
				$this->session->set_flashdata('message', array('content'=>'You Need to Start or Resume a test to Answer.','color'=>'red'));
				redirect(base_url('skill-tests'));
			}
			$answer = $this->input->get('answer');
			$timeConsumed = $this->input->get('timeConsumed');
			$correct = $this->skill_lib->checkAnswer($_SESSION['questionData'][0]['question_id'], $answer);
			'psychTest' = $_SESSION['userData']['currentSkill'];
			$_SESSION['userData']['psychTest']['totalTime'] = $this->input->get('totalTime');
			$score = $this->calculateScore(1, $_SESSION['questionData'][0]['expert_time'], $timeConsumed, $correct);
			if($correct == 1){
				$correct = '1';
			}else{
				$correct = '0';
			}
			if($answer == 0){
				$timeConsumed++;
			}
			$data = array(
				'userID' => $_SESSION['user_data']['userID'],
				'questionID' => $_SESSION['questionData'][0]['question_id'],
				'answer' => $answer,
				'score' => $score,
				'timeConsumed' => $timeConsumed,
				'correct' => $correct
				);
			if($this->skill_lib->updateResponse($data, $score)){
				$this->updateSkip('psychTest', $score);
				$_SESSION['userData']['psychTest']['totalScore'] += $score;
				$totalScore = $_SESSION['userData']['psychTest']['totalScore'];
				$level = $this->getLevel($totalScore);
				$_SESSION['userData']['psychTest']['level'] = $level;
				array_push($_SESSION['userData']['psychTest']['responses'], $_SESSION['questionData'][0]['question_id']);
				$_SESSION['questionData'] = $this->getQuestionDetails($level, 'psychTest');
				$testData['questionData'] = $_SESSION['questionData'][0];
					if($_SESSION['userData']['psychTest']['skips'] > 0){
						$testData['skipsLeft'] = $_SESSION['userData']['psychTest']['skips'];
						$testData['skips'] = true;
					}
					else{
						$testData['skipsLeft'] = 0;
						$testData['skips'] = false;
					}
					$testData['level'] = $level;
					$testData['totalScore'] = $totalScore;
					$testData['totalTime'] = $_SESSION['userData']['psychTest']['totalTime'];
					if($totalScore >= 100 || $totalScore <= -10){
						$testData['questionData'] = null;
					}
					echo json_encode($testData);
			}else{
				echo "string"; die;
				$this->logout();
			}
		}

	public function endTest(){
		$userID = $_SESSION['user_data']['userID'];
		'psychTest' = $_SESSION['userData']['currentSkill'];
		$score = $_SESSION['userData']['psychTest']['totalScore'];
		if($score >= 10){
			$result = $this->skill_lib->addSkill($score, $userID, 'psychTest');
			if(!$result){
				$this->session->set_flashdata('message', array('content'=>'Some Error Occured. Please Try Again.','color'=>'red'));
				$this->updateInfo();
				redirect('skills');
			}
			$this->session->set_flashdata('message', array('content'=>'Congratulations, you cleared the skill Test and your skill was Successfully added to your Profile.','color'=>'green'));
		}else{
			$this->session->set_flashdata('message', array('content'=>'Sorry, you were unable to clear the skill Test. Better Luck Next Time.','color'=>'red'));
		}
		$this->updateInfo();
		redirect('skills');
	}

	public function updateInfo(){
		'psychTest' = $_SESSION['userData']['currentSkill'];
		$totalScore = $_SESSION['userData']['psychTest']['totalScore'];
		$_SESSION['questionData'] = NULL;
		$_SESSION['userData']['currentSkill'] = NULL;
		$_SESSION['userData']['currentSkillName'] = NULL;
		$_SESSION['userData']['psychTest']['totalScore'] = NULL;
		$_SESSION['userData']['psychTest']['skips'] = NULL;
		$_SESSION['userData']['psychTest']['skipStatus'] = NULL;
		$_SESSION['userData']['psychTest']['totalTime'] = NULL;
		$_SESSION['userData']['psychTest']['responses'] = NULL;
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
