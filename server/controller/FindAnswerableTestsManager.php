<?php
require_once(realpath(dirname(__FILE__)) . '/../../Server/Controller/AnswerPointController.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Student.php');

/**
 * @access public
 * @author gamer01
 * @package Server.Controller
 */
class FindAnswerableTestsManager {
	/**
	 * @AssociationType Server.Controller.AnswerPointController
	 */
	public $_delegates_;
	/**
	 * @AssociationType Server.Model.Student
	 * @AssociationMultiplicity *
	 */
	public $_unnamed_Student_ = array();

	/**
	 * @access public
	 * @param aStudentID
	 * @param aDate
	 */
	public function getTest($aStudentID, $aDate) {
		// Not yet implemented
	}
}
?>