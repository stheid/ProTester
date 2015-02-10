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
		echo '
<form action="../controller/EvaluationController.php" method="POST">
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-xs-8">';
		
		// put name of the test owner
		if ($test->isEvaluated ()) {
			echo '<h2>' . $test->getPerson ()->getFullName () . '</h2>';
			// display all questions with evaluationcriteria
			
			$i = 0;
			foreach ( $test->getTestTemplate ()->getQuestions () as $question ) {
				$this->getQuestionHtmlCode ( $question, $test, $i );
				$i ++;
			}
		}
		
		// display only open questions and their answers and evaluationcriteria
		$i = 0;
		foreach ( $test->getTestTemplate ()->getQuestions () as $question ) {
			if ($question instanceof OpenQuestion) {
				$this->getQuestionHtmlCode ( $question, $test, $i );
				$i ++;
			}
		}
		echo '
			</div>';
		
		$this->printSidebar ();
		echo '
		</div>
	</div>
</form>';
	}
	private function getQuestionHtmlCode($question, $test, $i) {
		if ($i % 5 == 0 && $i != 0) {
			echo '</div>
				  <div class="panel-group">';
		}
		
		echo '
				<div class="panel panel-default">
				<a class="panel-default" data-toggle="collapse"	href="#collapse' . $i . '">
				  <div class="panel-heading">
				    <h4 class="panel-title">' . $question->getText () . '</h4>
				  </div>
		        </a>
		    	<div id="collapse' . $i . '" class="panel-collapse collapse">
			    	<div class="panel-body">';
		if ($question instanceof ClosedQuestion) {
			parent::printClosedQuestion($test,$question);
		} elseif ($question instanceof GapQuestion) {
			echo '		<input type="input" class="bg-';
			parent::getColorCode ( $test->getAnswer ( $question->getID () ), $question );
			echo '" value=' . $test->getAnswer ( $question->getID () )->getAnswer () . ' disabled>';
		} else {
			$this->printOpenQuestion($test,$question);
		}
		echo '			<span style="float:right;">' . ( float ) $test->getAnswer ( $question->getID () )->getPoints () . ' / ' . $question->getMaxPoints () . '</span>
					</div>
				</div>
			</div>';
	}
	
	private function printOpenQuestion($test,$question){
		echo '		<textarea style="width: 100%" class="bg-';
		parent::getColorCode ( $test->getAnswer ( $question->getID () ), $question );
		echo '" disabled>' . $test->getAnswer ( $question->getID () )->getAnswer () . '</textarea>';
	}
	
	protected function printSidebar($questions = NULL, $buttons = NULL) {
		$buttons = '<input type="submit" name="unev" class="btn btn-default" value="Previous"/>
				 Not Evaluated 
				<input type="submit" name="unev" class="btn btn-default" value="Next"/><br>';
		$buttons .= '<input type="submit" name="ev" class="btn btn-default" value="Previous"/>
				 Evaluated 
				<input type="submit" name="ev" class="btn btn-default" value="Next"/><br>';
		$buttons .= '<input type="submit" name="Homepage" class="btn btn-default" value="Back To Homepage"/>';
		parent::printSidebar ( "list of all questions", $buttons );
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