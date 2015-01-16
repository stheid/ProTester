<?php
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Question.php');

/**
 * @access public
 * @author gamer01
 * @package Server.Model
 */
class ClosedQuestion extends Question {
	private $_solution_String_0..4_;
	/**
	 * @AttributeType String[0..4]
	 */
	private $_answers;
}
?>