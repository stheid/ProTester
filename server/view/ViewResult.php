<?php
include_once 'TestViewer.php';
include_once '../model/Test.php';

class ResultView extends TestViewer {
	protected $title = 'View Results';

	protected function content($test) {
		$person = new Person ( $_SESSION ['ID'] );
		if ($test->ownedBy ( $person )) {
			// timerbar
			$questions = $test->getTestTemplate ()->getQuestions ();
			echo '<div class="container">
						<div class="row">
						<div class="col-md-9 col-xs-8">
						<div class="panel-group">';
			$i = 0;
			foreach ( $questions as $question ) {
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
			
			echo '</div></div>';
			$this->printSidebar ();
			
			echo '</div></div>';
		} else {
			echo "<h1>You have no Permission to see this results, please login again</h1>";
		}
	}
	
	//
	public function printSidebar() {
		$buttons = '<a class="btn btn-primary" href="' . PATH . 'server/controller/LoginController.php">Back to Homepage</a>';
		
		parent::printSidebar("list of all questions", $buttons);
	}
	
	//
	private static function expandValuesToArrayLength($values, $length) {
		$result = array_fill ( 0, $length, FALSE );
		
		foreach ( $values as $key => $value ) {
			$result [$value - 1] = TRUE;
		}
		return $result;
	}
	
	//
	private static function getColorCode($answer, $question) {
		if ($answer->getPoints () == $question->getMaxPoints ()) {
			echo 'success"';
		} elseif ($answer->getPoints () >= ($question->getMaxPoints () / 2)) {
			echo 'warning';
		} else {
			echo 'danger';
		}
	}
	
	//
	private static function getGlyphiconCode($answer, $question) {
		if ($answer->getPoints () == $question->getMaxPoints ()) {
			echo '<span class="glyphicon glyphicon-ok" style="float:right;" aria-hidden="true"></span>';
		} elseif ($answer->getPoints () >= ($question->getMaxPoints () / 2)) {
			echo '<span class="glyphicon glyphicon-minus" style="float:right;" aria-hidden="true"></span>';
		} else {
			echo '<span class="glyphicon glyphicon-remove" style="float:right;" aria-hidden="true"></span>';
		}
	}
}
session_start ();
if (isset ( $_GET ['TestID'] )) {
	$_SESSION ['TestID'] = $_GET ['TestID'];
	new ResultView ( new Test ( $_SESSION ['TestID'] ) );
} else {
	require_once (realpath ( dirname ( __FILE__ ) ) . '/../controller/LoginController.php');
}
?>