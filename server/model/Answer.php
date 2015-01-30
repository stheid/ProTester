<?php
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Question.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Test.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Evaluation_Rule.php');

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
	/**
	 * @AttributeType String
	 */
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
}
?>