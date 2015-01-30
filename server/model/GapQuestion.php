<?php
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Question.php');

/**
 * @access public
 * @author gamer01
 * @package Server.Model
 */
class GapQuestion extends Question {
	/**
	 * @AttributeType String
	 */
	private $_solution;
}
?>