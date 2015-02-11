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
		if ($result = $mysqli->query ( 'SELECT * FROM Answer WHERE AnswerID="' . $id . '"' )) {
			$row = $result->fetch_array ( MYSQLI_ASSOC );
			
			$this->_answerID = $row ['AnswerID'];
			$this->_test = new Test ( $row ['TestID'] );
			$this->_question = Question::getQuestion ( $row ['QuestionID'] );
			$this->_answer = $row ['Answer'];
			$this->_points = $row ['Points'];
			
			$result->free ();
		} else {
			echo "<script>console.log(\"" . __CLASS__ . "->" . __METHOD__ . " failed DB response\")</script>";
		}
		$mysqli->close ();
	}
	
	//
	public static function upload($testID, $questionID, $answer, $points = NULL) {
		$mysqli = DBController::getConnection ();
		
		$query = 'INSERT INTO Answer (TestID, QuestionID, Answer, Points)
				VALUES (' . $testID . ',' . $questionID . ',"' . $answer . '",' . (isset ( $points ) ? $points : "NULL") . ');';
		if ($result = $mysqli->query ( $query )) {
			return $mysqli->insert_id;
		} else {
			// insert failed
			echo "<script>console.log(\"Answer upload of\n\n" . 'VALUES (' . $testID . ',' . $questionID . ',' . $answer . ',' . (isset ( $points ) ? $points : "NULL") . ');' . "\n\nfailed\")</script>";
			return $mysqli->error;
		}
	}
	
	//
	public static function update($testID, $questionID, $points) {
		$mysqli = DBController::getConnection ();
		
		$query = 'UPDATE Answer SET Points=' .(float) $points . '
				WHERE TestID="' . $testID . '" AND QuestionID="' . $questionID . '";';
		
		if ($result = $mysqli->query ( $query )) {
			return TRUE;
		} else {
			// insert failed
			echo "<script>console.log(\"Answer update of\n\n" . 'VALUES (' . $testID . ',' . $questionID . ',' . $points . ');' . "\n\nfailed\")</script>";
			return $mysqli->error;
		}
	}
	
	//
	public function getAnswer() {
		return $this->_answer;
	}
	
	//
	public function getPoints() {
		return $this->_points;
	}
	
	//
	public function getQuestion() {
		return $this->_question;
	}
}
?>