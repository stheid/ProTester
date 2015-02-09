<?php
include_once 'View.php';
include_once '../model/Test.php';
class ResultView extends View {
	protected $title = 'View Results';
	public function __construct($test) {
		parent::includes ();
		parent::header ();
		$this->content ( $test );
		parent::footer ();
	}
	public function content($test) {
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
				
				echo '<div class="panel panel-default">
				<a class="panel-default" data-toggle="collapse"
						href="#collapse' . $i . '">
								<div class="panel-heading">
								<h4 class="panel-title">' . $question->getText () . '</h4>
								</div>
								</a>
								<div id="collapse' . $i . '" class="panel-collapse collapse">
								<div class="panel-body">';
				if ($question instanceof ClosedQuestion) {
					echo '<ul class="input-list">';
					
					$j = 1;
						// create 2 equal lengthed arrays of solutions and answer
					$dbAnswerSet = explode ( ";;;", $test->getAnswer ( $question->getID () )->getAnswer () );
					$studentAnswerSet = array ();
					foreach ( range ( 0, count ( $question->getAnswerSet()) - 1, 1 ) as $key ) {
						$studentAnswerSet [$key] = "";
					}
					
					foreach ( $dbAnswerSet as $key => $value ) {
						$studentAnswerSet [$value - 1] = $value;
					}
					
					$dbAnswerSet = $question->getSolutionSet();
					$teacherAnswerSet = array ();
					foreach ( range ( 0, count ($question->getAnswerSet() ) - 1, 1 ) as $key ) {
						$teacherAnswerSet [$key] = "";
					}
					
					foreach ( $dbAnswerSet as $key => $value ) {
						$teacherAnswerSet [$value - 1] = $value;
					}
					
					foreach ( $question->getAnswerSet () as $answer ) {
						echo '<li class="';

						// solution is picked, but wrong
						if ($teacherAnswerSet[$j - 1] == $studentAnswerSet [$j - 1]) {
							echo "bg-success";
						} elseif ($teacherAnswerSet[$j - 1]== $j && $studentAnswerSet [$j - 1] == "") {
							echo "bg-warning";
						} else {
							echo "bg-danger";
						}
						echo '"><label><input type="checkbox" ';
						echo $studentAnswerSet [$j - 1] == $j ? "checked" : "";
						echo ' disabled> ' . $answer . '<label></li>';
						$j ++;
					}
					echo '</ul>';
				} elseif ($question instanceof GapQuestion) {
					echo '<input type="input" value=' . $test->getAnswer ( $question->getID () )->getAnswer () . ' disabled>';
				} else {
					echo '<textarea style="width: 100%" disabled>' . $test->getAnswer ( $question->getID () )->getAnswer () . '</textarea>';
				}
				echo '<span style="float:right;">' . ( float ) $test->getAnswer ( $question->getID () )->getPoints () . ' / ' . $question->getMaxPoints () . '</span>';
				echo '</div></div></div>';
			}
			
			echo '</div></div>';
			$this->printSidebar ();
		} else {
			echo "<h1>You have no Permission to see this results, please login again</h1>";
		}
	}
	
	//
	public function printSidebar() {
		echo '<div class="col-md-3 col-xs-4" style="height: 300px;">
		<div style="position: fixed;">
		<div>list of all questions</div>
		</div>
		<div style="position: absolute; bottom: 0; left: 0; width: 82px;">
		<a class="btn btn-primary" href="' . PATH . 'server/controller/LoginController.php">Back to Homepage</a>
						</div>
						</div>
						</div>
						</div>';
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