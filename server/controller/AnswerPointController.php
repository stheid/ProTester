<?php

/**
 * @access public
 * @author gamer01
 * @package Server.Controller
 */
class AnswerPointController {
	/**
	 * @AssociationType Server.View.LoginView
	 */
	public $_unnamed_LoginView_;
	/**
	 * @AssociationType Server.View.TestRunnerView
	 */
	public $_redirects;
	/**
	 * @AssociationType Server.Controller.FindAnswerableTestsManager
	 */
	public $_delegates_;
	/**
	 * @AssociationType Server.Controller.CourseManager
	 */
	public $_unnamed_CourseManager_;
	/**
	 * @AssociationType View.EvaluateTestView
	 */
	public $_unnamed_EvaluateTestView_;
}

echo var_dump($_POST['answer']);
?>