<?php
require_once (realpath ( dirname ( __FILE__ ) ) . '/../model/Test.php');
require_once (realpath ( dirname ( __FILE__ ) ) . '/../model/Answer.php');
require_once (realpath ( dirname ( __FILE__ ) ) . '/../model/Question.php');

/**
 *
 * @access public
 * @author gamer01
 * @package Server.Controller
 */
class AnswerPointController {
	public static function main() {
		$answers = $_POST ['answer'];
		// create new Test in DB
		$test = new Test ( Test::upload ( $_SESSION ['TestTemplateID'], $_SESSION ['ID'] ) );
		
		// create all the Answers in DB
		foreach ( $answers as $questionID => $answer ) {
			$question = Question::getQuestion ( $questionID );
			if ($question instanceof ClosedQuestion) {
				// convert answer and question to arrays
				$solutionSet = $question->getSolutionSet ();
				$answerSet = array ();
				foreach ( $answer as $key => $value ) {
					$answerSet [] = "" . $key;
				}
				
				/*
				 * nothing wrong and at least the half correct:
				 *
				 * answer array \ solution array is empty
				 * and count(solution \ answer)< (count(solution)/2)
				 */
				if (empty ( array_diff ( $answerSet, $solutionSet ) ) && (count ( array_diff ( $solutionSet, $answerSet ) ) < (count ( $solutionSet ) / 2))) {
					
					/* if everything correct */
					if (empty ( array_diff ( $solutionSet, $answerSet ) )) {
						$points = $question->getMaxPoints ();
					} else {
						$points = .5 * $question->getMaxPoints ();
					}
				} else {
					$points = 0;
				}
				$answer = implode ( ";;;", $answerSet );
				
				$answerObj = new Answer ( Answer::upload ( $test->getID (), $questionID, $answer, $points ) );
			} elseif ($question instanceof GapQuestion) {
				if ($question->getSolution () == $answer) {
					$points = $question->getMaxPoints ();
				} else {
					$points = 0;
				}
				$answerObj = new Answer ( Answer::upload ( $test->getID (), $questionID, $answer, $points ) );
			} else {
				$answerObj = new Answer ( Answer::upload ( $test->getID (), $questionID, $answer ) );
			}
		}
		// calculate result
		// redirect to Finished Test (not yet implemented)
		require_once (realpath ( dirname ( __FILE__ ) ) . '/../controller/LoginController.php');
	}
}
session_start ();
AnswerPointController::main ();
?>