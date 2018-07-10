<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Psych_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function getTestSettings(){
		return $this->db->get('psychometricEvaluationTestSettings')->result_array();
	}

	public function getQuestionDetails(){
		$this->db->select('psychometricEvaluationQuestionID, psychometricEvaluationQuestion, psychometricE1psychometricEvaluationQuestionOptions');
		if(!empty($_SESSION['userData']['psychTest']['responses']))
		$this->db->where_not_in('psychometricEvaluationQuestionID', $_SESSION['userData']['psychTest']['responses']);
		$this->db->order_by('RAND()');
		$result = $this->db->get('psychometricEvaluationQuestions',1);
		return $result->result_array();
	}

	public function updateResponse($data){
		$c = 0;

		foreach($data as $dat){
			 if($this->db->insert('psychometricEvaluationResponses', $dat)){
				 $c = $c;
			 }else{
				 $c++;
			 }
		}

		if($c > 0){
			return false;
		}else{
			return true;
		}
	}

	public function addSkilltoUser($skill_id, $user_id, $score){
		$data = ['skillID'=> $skill_id, 'userID'=> $user_id, 'score'=> $score, 'status'=> 4, 'type' => 1];
		// var_dump($data);die;
		return $this->db->insert('userSkills', $data);
	}


	public function getResponses($userID, $skillID){
		$this->db->select('count(*) as responses');
		$this->db->join('psychometricEvaluationQuestions', 'psychometricEvaluationQuestions.psychometricEvaluationQuestionID = psychometricEvaluationResponses.questionID');
		$result = $this->db->get_where('psychometricEvaluationResponses', array('psychometricEvaluationQuestions.skill_id'=> $skillID, 'psychometricEvaluationResponses.userID' => $userID))->result_array()[0];
		return $result;
	}

	public function getCorrectResponses($userID, $skillID){
		$this->db->select('count(*) as responses');
		$this->db->join('psychometricEvaluationQuestions', 'psychometricEvaluationQuestions.psychometricEvaluationQuestionID = psychometricEvaluationResponses.questionID');
		$result = $this->db->get_where('psychometricEvaluationResponses', array('psychometricEvaluationQuestions.skill_id'=> $skillID, 'psychometricEvaluationResponses.userID' => $userID, 'psychometricEvaluationResponses.correct' => 1))->result_array()[0];
		return $result;
	}

	public function getIncorrectResponses($userID, $skillID){
		$this->db->select('count(*) as responses');
		$this->db->join('psychometricEvaluationQuestions', 'psychometricEvaluationQuestions.psychometricEvaluationQuestionID = psychometricEvaluationResponses.questionID');
		$result = $this->db->get_where('psychometricEvaluationResponses', array('psychometricEvaluationQuestions.skill_id'=> $skillID, 'psychometricEvaluationResponses.userID' => $userID, 'psychometricEvaluationResponses.correct' => 0))->result_array()[0];
		return $result;
	}

	public function getSkillMax($skillID){
		$this->db->select('max(score) as max');
		$result = $this->db->get_where('userSkills', array('skillID' => $skillID))->result_array()[0];
		return $result;
	}

	public function skillAdded($userID, $skillID){
		$result = $this->db->get_where('userSkills', array('userID' => $userID, 'skillID' => $skillID));
		if($result->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

}
