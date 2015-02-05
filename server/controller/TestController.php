<?php
require_once(realpath(dirname(__FILE__)) . '/../../Server/View/ViewResultTab.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/View/ViewTest.php');
require_once(realpath(dirname(__FILE__)) . '/TestManager.php');

/**
 * @access public
 * @author gamer01
 * @package Server.Controller
 */
class TestController {
	/**
	 * @AssociationType Server.View.ViewResultTab
	 */
	public $_provides_test_for_a_person;
	/**
	 * @AssociationType Server.View.ViewTest
	 */
	public $_displays_;
	/**
	 * @AssociationType Server.Controller.TestManager
	 */
	public $_delegates_;
}
?>