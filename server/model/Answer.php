<?php
require_once(realpath(dirname(__FILE__)) . '/Question.php');
require_once(realpath(dirname(__FILE__)) . '/Test.php');

/**
 * @access public
 * @author gamer01
 * @package Server.Model
 */
class Answer {
	/**
	 * @AttributeType int
	 */
	private $_iD;
	private $_answer;
	/**
	 * @AttributeType Integer
	 */
	private $_points;
	/**
	 * @AssociationType Server.Model.Question
	 * @AssociationMultiplicity 1
	 */
	public $_for__;
	/**
	 * @AssociationType Server.Model.Test
	 * @AssociationMultiplicity 1
	 */
	public $_unnamed_Test_;
	/**
	 * @AssociationType Server.Model.Evaluation Rule
	 * @AssociationMultiplicity 1
	 */
	public $_evaluationRules;
	/**
	 * @AssociationType Server.Model.Question
	 * @AssociationMultiplicity 1
	 */
	public $_questions;
	
	public function __construct() {
		
	}
	
	public function loafro
	
	//
	public function getAnswer() {
		return $this->_answer;
	}
/*	public static function getAnswer($id) {
		$mysqli = DBController::getConnection ();
		$result = $mysqli->query ( "SELECT Discriminator FROM Question WHERE AnswerID=" . $id );
		$row = $result->fetch_array ( MYSQLI_ASSOC );
	
		
		$result->close ();
		$this->_solution = $row ['Solution'];
		return $answer;
	}*/
}
?>