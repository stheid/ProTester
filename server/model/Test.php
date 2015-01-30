<?php
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/TestTemplate.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Student.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Person.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Controller/TestManager.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Controller/AnswerPointsManager.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Answer.php');

/**
 * @access public
 * @author gamer01
 * @package Server.Model
 */
class Test {
	/**
	 * @AttributeType int
	 */
	private $_iD;
	/**
	 * @AttributeType Integer
	 */
	private $_result;
	/**
	 * @AttributeType BigDecimal
	 */
	private $_grade;
	/**
	 * @AttributeType int
	 */
	private $_answerID;
	/**
	 * @AttributeType int
	 */
	private $_personID;
	/**
	 * @AttributeType int
	 */
	private $_personPersonalID;
	/**
	 * @AttributeType int
	 */
	private $_personStudentID;
	/**
	 * @AttributeType int
	 */
	private $_testID;
	/**
	 * @AssociationType Server.Model.TestTemplate
	 * @AssociationMultiplicity 1
	 */
	public $_is_a__;
	/**
	 * @AssociationType Server.Model.Student
	 * @AssociationMultiplicity 1
	 */
	public $_student;
	/**
	 * @AssociationType Server.Model.Person
	 * @AssociationMultiplicity 1
	 */
	public $_person;
	/**
	 * @AssociationType Server.Controller.TestManager
	 * @AssociationMultiplicity 1
	 */
	public $_unnamed_TestManager_;
	/**
	 * @AssociationType Server.Controller.AnswerPointsManager
	 */
	public $_updates_;
	/**
	 * @AssociationType Server.Model.Answer
	 * @AssociationMultiplicity *
	 * @AssociationKind Aggregation
	 */
	public $_answers = array();

	/**
	 * @access public
	 * @param aAnswers
	 */
	public function setAnswers($aAnswers) {
		// Not yet implemented
	}

	/**
	 * @access public
	 */
	public function getAnswers() {
		// Not yet implemented
	}
}
?>