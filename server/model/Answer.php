<?php
require_once (realpath ( dirname ( __FILE__ ) ) . '/Question.php');
require_once (realpath ( dirname ( __FILE__ ) ) . '/Test.php');

/**
 *
 * @access public
 * @author gamer01
 * @package Server.Model
 */
class Answer {
	private $_answerID;
	private $_test;
	private $_question;
	private $_answer;
	private $_points;
	public function __construct($id) {
			$mysqli = DBController::getConnection ();
			$result = $mysqli->query ( "SELECT * FROM Answer WHERE AnswerID=" . $id );
			$row = $result->fetch_array ( MYSQLI_ASSOC );
			
			$this->_answerID = $row ['AnswerID'];
			$this->_test = new Test ( $row ['TestID'] );
			$this->_question = new Question ( $row ['QuestionID'] );
			$this->_answer = $row ['Answer'];
			$this->_points = $row ['Points'];
			
			$result->close ();
	}
	
	//
	public function getAnswer() {
		return $this->_answer;
	}
	
	//
	public function getQuestion() {
		return $this->_question;
	}
	/*
	 * public static function getAnswer($id) {
	 * $mysqli = DBController::getConnection ();
	 * $result = $mysqli->query ( "SELECT Discriminator FROM Question WHERE AnswerID=" . $id );
	 * $row = $result->fetch_array ( MYSQLI_ASSOC );
	 *
	 *
	 * $result->close ();
	 * $this->_solution = $row ['Solution'];
	 * return $answer;
	 * }
	 */
}
?>