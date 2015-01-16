<?php
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/TestTemplate.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Answer.php');

/**
 * @access public
 * @author gamer01
 * @package Server.Model
 */
class Question {
	private $_max_points;
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
	public $_for__ = array();
}
?>