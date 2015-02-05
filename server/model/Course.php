<?php
require_once(realpath(dirname(__FILE__)) . '/Person.php');
require_once(realpath(dirname(__FILE__)) . '/../controller/CourseManager.php');
require_once(realpath(dirname(__FILE__)) . '/Teacher.php');
require_once(realpath(dirname(__FILE__)) . '/TestTemplate.php');

/**
 * @access public
 * @author gamer01
 * @package Server.Model
 */
class Course {
	/**
	 * @AttributeType int
	 */
	private $_courseID;
	/**
	 * @AttributeType String
	 */
	private $_name;
	/**
	 * @AttributeType String
	 */
	private $_syllabus;
	/**
	 * @AttributeType String
	 */
	private $_schedule;
	/**
	 * @AttributeType int
	 */
	private $_group;
	/**
	 * @AssociationType Server.Model.Person
	 * @AssociationMultiplicity *
	 */
	public $_students = array();
	/**
	 * @AssociationType Server.Controller.CourseManager
	 */
	public $_unnamed_CourseManager_;
	/**
	 * @AssociationType Server.Model.Teacher
	 * @AssociationMultiplicity 1
	 */
	public $_courses;
	/**
	 * @AssociationType Server.Model.TestTemplate
	 * @AssociationMultiplicity 1..*
	 * @AssociationKind Aggregation
	 */
	public $_templates = array();
}
?>