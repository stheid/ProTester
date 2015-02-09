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
		$person = new Person ( $_SESSION ['ID'] );
		$testTemplate = new TestTemplate ( $_SESSION ['TestTemplateID'] );
		if (! $testTemplate->isAnsweredFrom ( $person )) {
			$test = new Test ( Test::upload ( $testTemplate->getID (), $person->getID () ) );
			
			if (isset ( $_POST ['answer'] )) {
				/* make sure that all keys in the array are present */
				// create a empty array with 1-testtemplate->get answers
				$emptyAnswers = array ();
				foreach ( range ( 1, count ( $testTemplate->getQuestions () ), 1 ) as $key ) {
					$emptyAnswers [$key] = array ();
				}
				
				$answers = $_POST ['answer'];
				$answers = $answers + $emptyAnswers;
				// create new Test in DB
				
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
						 * and count(solution \ answer)<= (count(solution)/2)
						 */
						if (empty ( array_diff ( $answerSet, $solutionSet ) ) && (count ( array_diff ( $solutionSet, $answerSet ) ) <= (count ( $solutionSet ) / 2))) {
							
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
			}
		} else {
			$test = $testTemplate->getTest ( $person );
		}
		
		// calculate result
		$points = 0;
		foreach ( $test->getAnswers () as $answer ) {
			$points += $answer->getPoints ();
		}
		Test::updateResult ( $test->getID (), $points );
		
		$_SESSION ['ResultString'] = $points . ' / ' . $testTemplate->getMaxPoints ();
		$_SESSION ['FinishReason'] = 'you submitted the Test';
		
		header ( "Location: " . PATH . "server/view/AfterTestView.php" );
	}
}
session_start ();
AnswerPointController::main ();
?>