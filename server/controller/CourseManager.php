<?php
require_once(realpath(dirname(__FILE__)) . '/../../Server/Controller/CourseController.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Controller/AnswerPointController.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Course.php');

/**
 * @access public
 * @author gamer01
 * @package Server.Controller
 */
class CourseManager {
	/**
	 * @AssociationType Server.Controller.CourseController
	 */
	public $_delegates_;
	/**
	 * @AssociationType Server.Controller.AnswerPointController
	 */
	public $_unnamed_AnswerPointController_;
	/**
	 * @AssociationType Server.Model.Course
	 */
	public $_unnamed_Course_;
}
?>