<?php
require_once(realpath(dirname(__FILE__)) . '/OpenQuestion.php');
require_once(realpath(dirname(__FILE__)) . '/Answer.php');

/**
 * @access public
 * @author gamer01
 * @package Server.Model
 */
class Evaluation_Rule {
	/**
	 * @AttributeType int
	 */
	private $_iD;
	/**
	 * @AttributeType String
	 */
	private $_evaluationRule;
	/**
	 * @AssociationType Server.Model.OpenQuestion
	 */
	public $_unnamed_OpenQuestion_;
	/**
	 * @AssociationType Server.Model.Answer
	 * @AssociationMultiplicity 1
	 */
	public $_answers;
}
?>