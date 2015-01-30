<?php
require_once(realpath(dirname(__FILE__)) . '/../../Server/Controller/AnswerPointController.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/TestTemplate.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Test.php');

/**
 * @access public
 * @author gamer01
 * @package Server.Controller
 */
class AnswerPointsManager {
	/**
	 * @AssociationType Server.Controller.AnswerPointController
	 */
	public $_delegates_;
	/**
	 * @AssociationType Server.Model.TestTemplate
	 */
	public $_unnamed_TestTemplate_;
	/**
	 * @AssociationType Server.Model.Test
	 */
	public $_updates_;

	/**
	 * @access public
	 */
	public function updateAnswer() {
		// Not yet implemented
	}

	/**
	 * @access public
	 */
	public function updatePoints() {
		// Not yet implemented
	}
}
?>