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
class AnswerPointController extends Controller {
	public function __construct() {
		parent::includes ();
		
		$person = new Person ( $_SESSION ['ID'] );
		$testTemplate = new TestTemplate ( $_SESSION ['TestTemplateID'] );
		if (! $testTemplate->isAnsweredFrom ( $person )) {
			// create new Test in DB
			$test = new Test ( Test::upload ( $testTemplate->getID (), $person->getID () ) );
			
			if (isset ( $_POST ['answer'] )) {
				/* make sure that all keys in the array are present */
				foreach ( $testTemplate->getQuestions () as $question ) {
					$emptyAnswers [$question->getID ()] = "";
				}
				$answers = $_POST ['answer'] + $emptyAnswers;
				
				foreach ( $answers as $questionID => $answer ) {
					$question = Question::getQuestion ( $questionID );
					if ($question instanceof ClosedQuestion) {
						$this->uploadClosedQuestion ( $test, $question, $answer );
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
		
		parent::calculateResult ( $test );
		
		$_SESSION ['ResultString'] = $points . ' / ' . $testTemplate->getMaxPoints ();
		$_SESSION ['FinishReason'] = 'you submitted the Test';
		
		header ( "Location: " . PATH . "server/view/AfterTestView.php" );
	}
	
	
	
	//
	private function uploadClosedQuestion($test, $question, $answer) {
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
		
		$answerObj = new Answer ( Answer::upload ( $test->getID (), $question->getID (), $answer, $points ) );
	}
}
new AnswerPointController ();
?>