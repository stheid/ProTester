<?php
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Test.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Course.php');

/**
 * @access public
 * @author gamer01
 * @package Server.Model
 */
class Person {
	/**
	 * @AttributeType int
	 */
	private $_iD;
	/**
	 * @AttributeType String
	 */
	private $_name;
	/**
	 * @AttributeType String
	 */
	private $_surname;
	/**
	 * @AssociationType Server.Model.Person
	 */
	public $_unnamed_Person_;
	/**
	 * @AssociationType Server.Model.Test
	 * @AssociationMultiplicity 1
	 */
	public $_tests = array();
	/**
	 * @AssociationType Server.Model.Course
	 * @AssociationMultiplicity *
	 */
	public $_courses = array();
}
?>