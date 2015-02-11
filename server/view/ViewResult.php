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
			
			$questionAnchor="";
			$i = 0;
			foreach ( $questions as $question ) {
				$this->printQuestionHTML($question, $test, $i);
				$questionAnchor .= parent::getQuestionAnchor ( $i+1 );
				$i++;
			}
			
			echo '</div></div>';
			$this->printSidebar ($questionAnchor);
			
			echo '</div></div>';
		} else {
			echo "<h1>You have no Permission to see this results, please login again</h1>";
		}
	}
	
	private function printQuestionHTML( $question, $test, $i ){
		if ($i % 5 == 0 && $i != 0) {
			echo '</div>
					<div class="panel-group">';
		}
		$this->printPanelHead ( $test, $question, $i );
		echo '<div class="panel-body">';
		if (NULL !== (@$test->getAnswer ( $question->getID () ))) {
			if ($question instanceof ClosedQuestion) {
				parent::printClosedQuestion ( $test, $question );
			} elseif ($question instanceof GapQuestion) {
				echo '<input type="input" class="bg-';
				parent::getColorCode ( $test->getAnswer ( $question->getID () ), $question );
				echo '" value=' . $test->getAnswer ( $question->getID () )->getAnswer () . ' disabled>';
			} else {
				echo '<textarea style="width: 100%" class="bg-';
				parent::getColorCode ( $test->getAnswer ( $question->getID () ), $question );
				echo '" disabled>' . $test->getAnswer ( $question->getID () )->getAnswer () . '</textarea>';
			}
			echo '<span style="float:right;">' . ( float ) $test->getAnswer ( $question->getID () )->getPoints () . ' / ' . $question->getMaxPoints () . '</span>';
			echo '</div></div></div>';
		} else {
			echo "<h1>Some Database Problem (This Test seems to have no Answers)</h1>";
		}
	}
	
	private function printPanelHead($test, $question, $i) {
		echo '<div class="panel panel-';
		parent::getColorCode ( $test->getAnswer ( $question->getID () ), $question );
		echo '" id="question';
		echo $i + 1;
		echo '">
				<a class="panel-';
		parent::getColorCode ( $test->getAnswer ( $question->getID () ), $question );
		echo '" data-toggle="collapse" href="#collapse' . $i . '">
					<div class="panel-heading">
					<h4 class="panel-title">';
		echo $i + 1 ;
		echo '. '. $question->getText ();
		static::getGlyphiconCode ( $test->getAnswer ( $question->getID () ), $question );
		echo '</h4>
								</div>
								</a>
								<div id="collapse' . $i . '" class="panel-collapse collapse">';
	}
	
	//
	protected function printSidebar($questions = "list of all questions", $buttons = NULL) {
		$buttons = '<a class="btn btn-primary" href="' . PATH . 'server/controller/LoginController.php">Back to Homepage</a>';
		
		parent::printSidebar ($questions , $buttons );
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