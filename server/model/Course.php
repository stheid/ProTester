<?php
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Student.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Controller/CourseManager.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Teacher.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/TestTemplate.php');

/**
 * @access public
 * @author gamer01
 * @package Server.Model
 */
class Course {
	private $_courseID;
	private $_name;
	private $_syllabus;
	private $_schedule;
	/**
	 * @AssociationType Server.Model.Student
	 * @AssociationMultiplicity *
	 */
	public $_is_in__ = array();
	/**
	 * @AssociationType Server.Controller.CourseManager
	 */
	public $_unnamed_CourseManager_;
	/**
	 * @AssociationType Server.Model.Teacher
	 * @AssociationMultiplicity 1
	 */
	public $_runs__;
	/**
	 * @AssociationType Server.Model.TestTemplate
	 * @AssociationKind Aggregation
	 */
	public $_.._;
}
?>