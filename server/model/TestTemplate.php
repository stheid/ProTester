<?php
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Course.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Controller/AnswerPointsManager.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Test.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Question.php');

/**
 * @access public
 * @author gamer01
 * @package Server.Model
 */
class TestTemplate {
	/**
	 * @AttributeType int
	 */
	private $_testID;
	/**
	 * @AttributeType int
	 */
	private $_duration;
	/**
	 * @AttributeType Date
	 */
	private $_date;
	/**
	 * @AssociationType Server.Model.Course
	 * @AssociationMultiplicity 0..1
	 */
	public $_unnamed_Course_;
	/**
	 * @AssociationType Server.Controller.AnswerPointsManager
	 */
	public $_unnamed_AnswerPointsManager_;
	/**
	 * @AssociationType Server.Model.Test
	 * @AssociationMultiplicity *
	 */
	public $_tests = array();
	/**
	 * @AssociationType Server.Model.Question
	 * @AssociationMultiplicity *
	 * @AssociationKind Aggregation
	 */
	public $_questions = array();

	/**
	 * @access public
	 */
	public function maxpoints() {
		// Not yet implemented
	}
}
?>