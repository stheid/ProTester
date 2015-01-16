<?php
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Question.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Test.php');

/**
 * @access public
 * @author gamer01
 * @package Server.Model
 */
class Answer {
	private $_answer;
	private $_points;
	/**
	 * @AssociationType Server.Model.Question
	 * @AssociationMultiplicity 1
	 */
	public $_for__;
	/**
	 * @AssociationType Server.Model.Test
	 */
	public $;
}
?>