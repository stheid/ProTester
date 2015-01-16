<?php
require_once(realpath(dirname(__FILE__)) . '/../../Server/Controller/TestController.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Controller/TestManager.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Test.php');

/**
 * @access public
 * @author gamer01
 * @package Server.Model
 */
class Person {
	private $_name;
	private $_surname;
	/**
	 * @AssociationType Server.Model.Person
	 */
	public $_unnamed_Person_;
	/**
	 * @AssociationType Server.Controller.TestController
	 */
	public $_checks_;
	/**
	 * @AssociationType Server.Controller.TestManager
	 */
	public $_unnamed_TestManager_;
	/**
	 * @AssociationType Server.Model.Test
	 */
	public $_can_access_;
}
?>