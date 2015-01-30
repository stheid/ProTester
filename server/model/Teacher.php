<?php
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Course.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Person.php');

/**
 * @access public
 * @author gamer01
 * @package Server.Model
 */
class Teacher extends Person {
	/**
	 * @AttributeType int
	 */
	private $_personalID;
	/**
	 * @AssociationType Server.Model.Course
	 * @AssociationMultiplicity *
	 */
	public $_teachers = array();
}
?>