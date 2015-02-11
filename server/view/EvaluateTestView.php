<?php
require_once (realpath ( dirname ( __FILE__ ) ) . '/../model/Test.php');
include_once 'TestViewer.php';

/**
 *
 * @author gamer01
 *        
 */
class EvaluateTestView extends TestViewer {
	protected $title = 'Evaluate Tests';
	protected function content($test) {
		$person = new Person ( $_SESSION ['ID'] );
		if ($person->canEvaluate ( $test->getTestTemplate () )) {
			echo '
<form action="../controller/EvaluationController.php?TestTemplateID=' . $test->getTestTemplate ()->getID () . '&TestID=' . $test->getID () . '" method="POST">
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-xs-8">';
			$questionAnchor = "";
			// put name of the test owner
			if ($test->isEvaluated ()) {
				echo '<h2>' . $test->getPerson ()->getFullName () . '</h2>';
				// display all questions with evaluationcriteria
				
				$i = 0;
				echo '<div class="panel-group">';
				foreach ( $test->getTestTemplate ()->getQuestions () as $question ) {
					if (NULL !== (@$test->getAnswer ( $question->getID () ))) {
						$this->printQuestionHtmlCode ( $question, $test, $i );
						$questionAnchor .= parent::getQuestionAnchor ( $i+1 );
						$i ++;
					} else {
						echo "<h1>Some Database Problem (This Test seems to have no Answers)</h1>";
					}
				}
				echo '</div>';
			} else {
				
				// display only open questions and their answers and evaluationcriteria
				$i = 0;
				foreach ( $test->getTestTemplate ()->getQuestions () as $question ) {
					if (NULL !== (@$test->getAnswer ( $question->getID () ))) {
						if ($question instanceof OpenQuestion) {
							$this->printQuestionHtmlCode ( $question, $test, $i );
							$questionAnchor .= parent::getQuestionAnchor ( $i+1 );
							$i ++;
						}
					} else {
						echo "<h1>Some Database Problem (This Test seems to have no Answers)</h1>";
					}
				}
			}
			echo '
			</div>';
			
			$this->printSidebar ( $questionAnchor );
			echo '
		</div>
	</div>
</form>';
		} else {
			echo "<h1>You have no Permission to see this results, please login again</h1>";
		}
	}
	private function printQuestionHtmlCode($question, $test, $i) {
		if ($i % 5 == 0 && $i != 0) {
			echo '</div>
				  <div class="panel-group">';
		}
		
		echo '
				<div class="panel panel-default"';
		echo ' id="question';
		echo $i + 1;
		echo '">
				<a class="panel-default" data-toggle="collapse"	href="#collapse' . $i . '">
				  <div class="panel-heading">
					<h4 class="panel-title">';
		echo $i + 1 . '. ' . $question->getText ();
		echo '</h4>
				  </div>
		        </a>
		    	<div id="collapse' . $i . '" class="panel-collapse collapse">
			    	<div class="panel-body">';
		if ($question instanceof ClosedQuestion) {
			parent::printClosedQuestion ( $test, $question );
			echo '			<span style="float:right;">' . ( float ) $test->getAnswer ( $question->getID () )->getPoints () . ' / ' . $question->getMaxPoints () . '</span>';
		} elseif ($question instanceof GapQuestion) {
			echo '		<input type="input" class="bg-';
			parent::getColorCode ( $test->getAnswer ( $question->getID () ), $question );
			echo '" value=' . $test->getAnswer ( $question->getID () )->getAnswer () . ' disabled>';
			echo '			<span style="float:right;">' . ( float ) $test->getAnswer ( $question->getID () )->getPoints () . ' / ' . $question->getMaxPoints () . '</span>';
		} else {
			$this->printOpenQuestion ( $test, $question );
		}
		echo '
					</div>
				</div>
			</div>';
	}
	
	/**
	 *
	 * @param        	
	 *
	 * @see Test $test
	 * @param        	
	 *
	 * @see Question $question
	 */
	private function printOpenQuestion($test, $question) {
		echo '<textarea style="width: 100%" class="bg-';
		parent::getColorCode ( $test->getAnswer ( $question->getID () ), $question );
		echo '" disabled>' . $test->getAnswer ( $question->getID () )->getAnswer () . '</textarea>';
		echo '<textarea style="width: 100%" name="evalRule[' . $question->getID () . ']">' . $question->getSolution () . '</textarea>';
		echo '<span style="float:right;"><input style="width:40px;" name="points[' . $question->getID () . ']" value="' . ($test->getAnswer ( $question->getID () )->getPoints () != NULL ? ( float ) $test->getAnswer ( $question->getID () )->getPoints () : '') . '"/> / ' . $question->getMaxPoints () . '</span>';
	}
	
	/*
	 * (non-PHPdoc)
	 * @see TestViewer::printSidebar()
	 */
	protected function printSidebar($questions = "list of all questions", $buttons = NULL) {
		$buttons = $this->getButtonHTML ( 'Back' );
		$buttons .= $this->getButtonHTML ( 'Next' );
		$buttons .= '<br>';
		
		$buttons .= '<input type="submit" name="Homepage" class="btn btn-default" value="Back To Homepage"/>';
		parent::printSidebar ( $questions, $buttons );
	}
	
	/**
	 *
	 * @param string $name        	
	 * @return string
	 */
	private function getButtonHTML($name) {
		$result = '<input style="width:50%" type="submit" name="nav" class="btn btn-default" value="' . $name . '"';
		$result .= (isset ( $_SESSION ['disableNav'] [$name] ) && $_SESSION ['disableNav'] [$name]) ? ' disabled/>' : '/>';
		return $result;
	}
}

session_start ();
if (isset ( $_GET ['TestID'] )) {
	$_SESSION ['TestID'] = $_GET ['TestID'];
	new EvaluateTestView ( new Test ( $_SESSION ['TestID'] ) );
} else {
	require_once (realpath ( dirname ( __FILE__ ) ) . '/../controller/LoginController.php');
}
?>