<?php
require_once(realpath(dirname(__FILE__)) . '/../../Server/Controller/CourseManager.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Controller/ActiveTestManager.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Controller/TestManager.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Course.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Test.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Person.php');

/**
 * @access public
 * @author gamer01
 * @package Server.Model
 */
class Student extends Person {
	private $_studentID;
	/**
	 * @AssociationType Server.Controller.CourseManager
	 */
	public $_unnamed_CourseManager_;
	/**
	 * @AssociationType Server.Controller.ActiveTestManager
	 * @AssociationMultiplicity 1
	 */
	public $_unnamed_ActiveTestManager_;
	/**
	 * @AssociationType Server.Controller.TestManager
	 * @AssociationMultiplicity 1
	 */
	public $_unnamed_TestManager_;
	/**
	 * @AssociationType Server.Model.Course
	 * @AssociationMultiplicity *
	 */
	public $_is_in__ = array();
	/**
	 * @AssociationType Server.Model.Test
	 */
	public $_..2;
}
?>