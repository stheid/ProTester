<?php
require_once(realpath(dirname(__FILE__)) . '/TestTemplate.php');
require_once(realpath(dirname(__FILE__)) . '/Answer.php');

/**
 * @access public
 * @author gamer01
 * @package Server.Model
 */
class Question {
	/**
	 * @AttributeType int
	 */
	private $_iD;
	/**
	 * @AttributeType Integer
	 */
	private $_max_points;
	/**
	 * @AttributeType String
	 */
	private $_text;
	/**
	 * @AssociationType Server.Model.TestTemplate
	 * @AssociationMultiplicity 1
	 */
	public $_unnamed_TestTemplate_;
	/**
	 * @AssociationType Server.Model.Answer
	 * @AssociationMultiplicity *
	 */
	public $_answer = array();
	/**
	 * @AssociationType Server.Model.Answer
	 * @AssociationMultiplicity *
	 */
	public $_for__ = array();
}
?>