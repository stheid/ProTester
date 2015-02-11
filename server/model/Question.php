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
	/**
	 * @AttributeType int
	 */
	private $_maxPoints;
	/**
	 * @AttributeType String
	 */
	private $_text;
	public $_testTemplate;
	public function __construct($id) {
		$mysqli = DBController::getConnection ();
		if ($result = $mysqli->query ( 'SELECT * FROM Question WHERE QuestionID="' . $id . '";' )) {
			$row = $result->fetch_array ( MYSQLI_ASSOC );
			
			$this->_questionID = $row ['QuestionID'];
			$this->_testTemplate = new TestTemplate ( $row ['TestTemplateID'] );
			$this->_text = $row ['Text'];
			$this->_maxPoints = $row ['Max points'];
			
			$result->free ();
		} else {
			echo "<script>console.log(\"" . __CLASS__ . "->" . __METHOD__ . " failed DB response\")</script>";
		}
		$mysqli->close ();
	}
	
	//
	public function getText() {
		return $this->_text;
	}
	
	//
	public function getID() {
		return $this->_questionID;
	}
	
	//
	public function getMaxPoints() {
		return $this->_maxPoints;
	}
	
	// returns the correct questionobject
	public static function getQuestion($id) {
		$mysqli = DBController::getConnection ();
		if ($result = $mysqli->query ( 'SELECT Discriminator FROM Question WHERE QuestionID="' . $id . '";' )) {
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
				default :
					echo "<script>console.log(\"QuestionType could not be detected\")</script>";
			}
			
			$result->free ();
		} else {
			echo "<script>console.log(\"" . __CLASS__ . "->" . __METHOD__ . " failed DB response\")</script>";
		}
		$mysqli->close ();
		
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
		$result->free ();
		$mysqli->close ();
		
		$this->_answerSet = explode ( ";;;", $row ['AnswerSet'] );
		$this->_solutionSet = explode ( ";;;", $row ['SolutionSet'] );
	}
	
	//
	public function getAnswerSet() {
		return $this->_answerSet;
	}
	
	//
	public function getSolutionSet() {
		return $this->_solutionSet;
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
		$result->free ();
		$mysqli->close ();
		
		$this->_solution = $row ['Solution'];
	}
	
	//
	public function getSolution() {
		return $this->_solution;
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
		$result->free ();
		$mysqli->close ();
		
		$this->_solution = $row ['Solution'];
	}
	
	//
	public function getSolution() {
		return $this->_solution;
	}
	
	//
	public static function update($questionID, $solution) {
		$mysqli = DBController::getConnection ();
		
		$query = 'UPDATE Question SET Solution="' . $solution . '"
				WHERE QuestionID="' . $questionID . '";';
		if ($result = $mysqli->query ( $query )) {
			return $mysqli->insert_id;
		} else {
			// insert failed
			echo "<script>console.log(\"Answer update of\n\n" . 'VALUES (' . $questionID . ',' . $solution . ');' . "\n\nfailed\")</script>";
			return $mysqli->error;
		}
	}
}
?>