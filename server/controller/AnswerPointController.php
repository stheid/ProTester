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
	
	
	public static function main(){
		$answers = array();
		//create new Test in DB
		//create all the Answers in DB
		// while calculating the points for closed and gap questions
		foreach ($_POST['answer'] as $answer){
			array_pop($answers,new Answer());
		}
		//calculate result
		//redirect to after test view
	}
}
?>