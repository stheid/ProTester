<?php
require_once (realpath ( dirname ( __FILE__ ) ) . '/TestTemplate.php');
// require_once (realpath ( dirname ( __FILE__ ) ) . '/Answer.php');

/**
 *
 * @access public
 * @author gamer01
 * @package Server.Model
 */
class Question {
	/**
	 * @AttributeType int
	 */
	private $_questionID;
	private $_maxPoints;
	/**
	 * @AttributeType String
	 */
	private $_text;
	public $_testTemplate;
	public function __construct($id) {
		$mysqli = DBController::getConnection ();
		$result = $mysqli->query ( "SELECT * FROM Question WHERE QuestionID=" . $id );
		$row = $result->fetch_array ( MYSQLI_ASSOC );
		
		$this->_questionID = $row ['QuestionID'];
		$this->_testTemplate = new TestTemplate ( $row ['TestTemplateID'] );
		$this->_text = $row ['Text'];
		$this->_maxPoints = $row ['Max points'];
		
		$result->close ();
	}
	
	//
	public function getText() {
		return $this->_text;
	}
	
	//
	public function getID() {
		return $this->_questionID;
	}
	
	// returns the correct questionobject
	public static function getQuestion($id) {
		$mysqli = DBController::getConnection ();
		$result = $mysqli->query ( "SELECT Discriminator FROM Question WHERE QuestionID=" . $id );
		$row = $result->fetch_array ( MYSQLI_ASSOC );
		
		switch ($row ['Discriminator']) {
			case "Closed" :
				$question = new ClosedQuestion ( $id );
				break;
			case "Gap" :
				$question = new GapQuestion ( $id );
				break;
			case "Open" :
				$question = new OpenQuestion ( $id );
				break;
		}
		
		$result->close ();
		
		return $question;
	}
}

/**
 *
 * @access public
 * @author gamer01
 * @package Server.Model
 */
class ClosedQuestion extends Question {
	private $_answerSet = array ();
	private $_solutionSet = array ();
	public function __construct($id) {
		parent::__construct ( $id );
		
		$mysqli = DBController::getConnection ();
		$result = $mysqli->query ( "SELECT AnswerSet, SolutionSet FROM Question WHERE QuestionID=" . $id );
		$row = $result->fetch_array ( MYSQLI_ASSOC );
		$result->close ();
		
		$this->_answerSet = explode ( ";;;", $row ['AnswerSet'] );
		$this->_solutionSet = explode ( ";;;", $row ['SolutionSet'] );
	}
	public function getAnswerSet() {
		return $this->_answerSet;
	}
}

/**
 *
 * @access public
 * @author gamer01
 * @package Server.Model
 */
class GapQuestion extends Question {
	/**
	 * @AttributeType String
	 */
	private $_solution;
	public function __construct($id) {
		parent::__construct ( $id );
		
		$mysqli = DBController::getConnection ();
		$result = $mysqli->query ( "SELECT Solution FROM Question WHERE QuestionID=" . $id );
		$row = $result->fetch_array ( MYSQLI_ASSOC );
		$result->close ();
		
		$this->_solution = $row ['Solution'];
	}
}

/**
 *
 * @access public
 * @author gamer01
 * @package Server.Model
 */
class OpenQuestion extends Question {
	private $_solution;
	public function __construct($id) {
		parent::__construct ( $id );
		
		$mysqli = DBController::getConnection ();
		$result = $mysqli->query ( "SELECT Solution FROM Question WHERE QuestionID=" . $id );
		$row = $result->fetch_array ( MYSQLI_ASSOC );
		$result->close ();
		
		$this->_solution = $row ['Solution'];
	}
}
?>