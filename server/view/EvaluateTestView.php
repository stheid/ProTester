<?php
require_once (realpath ( dirname ( __FILE__ ) ) . '/../model/Test.php');
include_once 'TestViewer.php';

/**
 * @author gamer01
 *
 */
class EvaluateTestView extends TestViewer {
	protected $title = 'Evaluate Tests';
	
	protected function content($test) {
		echo '<form action="../controller/EvaluationController.php" method="POST">
				<div class="container">
		<div class="row">
			<div class="col-md-9 col-xs-8">';

		// put name of the test owner
		if ($test->isEvaluated()){
			echo '<h2>'.$test->getPerson()->getFullName().'</h2>';
			// display all questions with evaluationcriteria
			foreach ($test->getTestTemplate()->getQuestions() as $question){
				$this->getQuestionHtmlCode($question);				
			}
		}
		
		// display only open questions and their answers and evaluationcriteria
		foreach ($test->getTestTemplate()->getQuestions() as $question){
			if ($question instanceof OpenQuestion){
				
			$this->getQuestionHtmlCode($question);
			}
		}
		
		$this->printSidebar();
		echo '</div>
			</div>
				</form>';
	}
	
	private function getQuestionHtmlCode($question){
		if ($i ++ % 5 == 0 && $i != 1) {
			echo '</div>
					<div class="panel-group">';
		}
		
		echo '<div class="panel panel-';
		static::getColorCode ( $test->getAnswer ( $question->getID () ), $question );
		echo '">
				<a class="panel-';
		static::getColorCode ( $test->getAnswer ( $question->getID () ), $question );
		echo '" data-toggle="collapse"
						href="#collapse' . $i . '">
								<div class="panel-heading">
								<h4 class="panel-title">' . $question->getText ();
		static::getGlyphiconCode( $test->getAnswer ( $question->getID () ), $question );
		echo '</h4>
								</div>
								</a>
								<div id="collapse' . $i . '" class="panel-collapse collapse">
								<div class="panel-body">';
		if ($question instanceof ClosedQuestion) {
			echo '<ul class="input-list">';
				
			// create 2 equal lengthed arrays of solutions and answer
			$studentAnswerSet = static::expandValuesToArrayLength ( explode ( ";;;", $test->getAnswer ( $question->getID () )->getAnswer () ), count ( $question->getAnswerSet () ) );
			$teacherAnswerSet = static::expandValuesToArrayLength ( $question->getSolutionSet (), count ( $question->getAnswerSet () ) );
				
			$j = 0;
			foreach ( $question->getAnswerSet () as $answer ) {
				echo '<li class="';
		
				// solution is picked, but wrong
				if ($teacherAnswerSet [$j] == $studentAnswerSet [$j]) {
					echo "bg-success";
				} elseif ($teacherAnswerSet [$j] && $studentAnswerSet [$j]) {
					echo "bg-warning";
				} else {
					echo "bg-danger";
				}
				echo '"><label><input type="checkbox" ';
				echo $studentAnswerSet [$j] ? "checked" : "";
				echo ' disabled> ' . $answer . '<label></li>';
				$j ++;
			}
			echo '</ul>';
		} elseif ($question instanceof GapQuestion) {
			echo '<input type="input" class="bg-';
			static::getColorCode ( $test->getAnswer ( $question->getID () ), $question );
			echo '" value=' . $test->getAnswer ( $question->getID () )->getAnswer () . ' disabled>';
		} else {
			echo '<textarea style="width: 100%" class="bg-';
			static::getColorCode ( $test->getAnswer ( $question->getID () ), $question );
			echo '" disabled>' . $test->getAnswer ( $question->getID () )->getAnswer () . '</textarea>';
		}
		echo '<span style="float:right;">' . ( float ) $test->getAnswer ( $question->getID () )->getPoints () . ' / ' . $question->getMaxPoints () . '</span>';
		echo '</div></div></div>';
	}
	
	protected function printSidebar($questions=NULL,$buttons=NULL){
		$buttons = '<input type="submit" name="unev" class="btn btn-default" value="Previous"/>
				 Not Evaluated 
				<input type="submit" name="unev" class="btn btn-default" value="Next"/><br>';
		$buttons .= '<input type="submit" name="ev" class="btn btn-default" value="Previous"/>
				 Evaluated 
				<input type="submit" name="ev" class="btn btn-default" value="Next"/><br>';
		$buttons .= '<input type="submit" name="Homepage" class="btn btn-default" value="Back To Homepage"/>';
		parent::printSidebar("list of all questions", $buttons);
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