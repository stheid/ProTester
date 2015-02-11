<?php
require_once (realpath ( dirname ( __FILE__ ) ) . '/../model/TestTemplate.php');
include_once 'TestViewer.php';
class AnswerTestView extends TestViewer {
	protected $title = 'Answer Test';
	protected function content($test) {
		$person = new Person ( $_SESSION ['ID'] );
		if ($test->answerableFor ( $person )) {
			// timerbar
			$questions = $test->getQuestions ();
			echo '<form action="../controller/AnswerPointController.php" method="POST">
						<div class="container">
						<div class="row">
						<div class="col-md-9 col-xs-8">
						<div class="panel-group">';
			$i = 0;
			$questionAnchor = 0;
			foreach ( $questions as $question ) {
				$this->printQuestionHTML ( $question, $test, $i );
				$questionAnchor .= parent::getQuestionAnchor ( $i + 1 );
				$i ++;
			}
			
			echo '</div></div>';
			$this->printSidebar ();
			$this->printModal ();
			echo '</form>';
		} else {
			echo "<h1>You have no Permission to see this results, please login again</h1>";
		}
	}
	private function printQuestionHTML($question, $test, $i) {
		if ($i % 5 == 0 && $i != 0) {
			echo '</div>
					<div class="panel-group">';
		}
		
		echo '<div class="panel panel-default"';
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
			echo '<ul class="input-list">';
			
			$j = 1;
			foreach ( $question->getAnswerSet () as $answer ) {
				echo '<li><label><input type="checkbox" name="answer[' . $question->getID () . '][' . $j . ']"> ' . $answer . '<label></li>';
				$j ++;
			}
			echo '</ul>';
		} elseif ($question instanceof GapQuestion) {
			echo '<input type="input" name="answer[' . $question->getID () . ']">';
		} else {
			echo '<textarea name="answer[' . $question->getID () . ']" style="width: 100%"></textarea>';
		}
		echo '</div></div></div>';
	}
	protected function printSidebar($questions = NULL, $buttons = NULL) {
		$buttons = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#submit">submit</button>';
		
		parent::printSidebar ( "list of all questions", $buttons );
	}
	protected function printModal() {
		echo '<div class="modal fade" id="submit" tabindex="-1" role="dialog"
				aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
				<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
				<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Modal title</h4>
				</div>
				<div class="modal-body">
				<p>You have still x:x Minutes time and y unanswered questions</p>
				<p>When you submit you will not be able to do any more changes on
				your answers.</p>
				</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Return
				to Test</button>
				<input type="submit" class="btn btn-primary"
						value="Submit Answers now"
								/>
								</div>
								</div>
								</div>
								</div>';
	}
}
session_start ();
if (isset ( $_GET ['TestTemplateID'] )) {
	$_SESSION ['TestTemplateID'] = $_GET ['TestTemplateID'];
	new AnswerTestView ( new TestTemplate ( $_SESSION ['TestTemplateID'] ) );
} else {
	require_once (realpath ( dirname ( __FILE__ ) ) . '/../controller/LoginController.php');
}
?>

<!--<div class="progress" style="margin-top: -20px; height: 5px;">-->
<!-- 	<div class="progress-bar progress-bar-info" role="progressbar" -->
<!-- 		aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" -->
<!-- 		style="width: 30%;"	> -->
<!-- 		<span class="sr-only">30% Complete</span> -->
<!-- 	</div> -->
<!-- </div> -->