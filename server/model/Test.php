<?php
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/TestTemplate.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Person.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Controller/TestManager.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Controller/ActiveTestManager.php');

/**
 * @access public
 * @author gamer01
 * @package Server.Model
 */
class Test {
	private $_result;
	private $_grade;
	/**
	 * @AssociationType Server.Model.TestTemplate
	 */
	public $;
	/**
	 * @AssociationType Server.Model.Person
	 */
	public $_can_access_;
	/**
	 * @AssociationType Server.Controller.TestManager
	 * @AssociationMultiplicity 1
	 */
	public $_unnamed_TestManager_;
	/**
	 * @AssociationType Server.Controller.ActiveTestManager
	 * @AssociationMultiplicity 1
	 */
	public $_unnamed_ActiveTestManager_;
}
?>