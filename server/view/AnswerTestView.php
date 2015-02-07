<?php
include_once 'View.php';
class AnswerTestView extends View {
	protected $title = 'Answer Test';
	protected function includes() {
		parent::includes ();
	}
	public function __construct($test) {
		parent::includes ();
		parent::header ();
		$this->content ( $test );
		parent::footer ();
	}
	protected function content($test) {
		$person = new Person ( $_SESSION ['id']);
		if ($test->answerableFor ( $person )) {
			// timerbar
			$questions = $test->getQuestions ();
			echo '<form action="../controller/AnswerPointController.php" method="POST">
						<div class="container">
						<div class="row">
						<div class="col-md-9 col-xs-8">
						<div class="panel-group">';
			$i = 0;
			foreach ( $questions as $question ) {
				if ( $i++ % 5==0 && $i!=1) {
					echo '</div>				
					<div class="panel-group">';
				}
				
				echo  '<div class="panel panel-default">
				<a class="panel-default" data-toggle="collapse"
						href="#collapse'.$i.'">
								<div class="panel-heading">
								<h4 class="panel-title">'.$question->getText () .'</h4>
								</div>
								</a>
								<div id="collapse'.$i.'" class="panel-collapse collapse">
								<div class="panel-body">';
				if ($question instanceof ClosedQuestion){
					echo '<ul class="input-list">';
					
					$j=1;
					foreach ($question->getAnswerSet() as $answer){
						echo '<li><label><input type="checkbox" id="chk'.$j.'" name="answer['.$i.']"> '.$answer.'<label></li>';
					}
					echo '</ul>';
				} elseif ($question instanceof GapQuestion){
					echo '<input type="input" id="chk2" name="answer['.$i.']">';
				} else {
					echo '<textarea name="answer['.$i.']" style="width: 100%"></textarea>';
				}
				echo '</div></div></div>';
			}
			
			echo '</div></div>';
			$this->printSidebar();
			$this->printModal ();
			echo '</form>';
		} else {
			echo "<h1>You have no Permission to see this results, please login again</h1>";
		}
	}
	
	public function printSidebar(){
		echo '<div class="col-md-3 col-xs-4" style="height: 300px;">
		<div style="position: fixed;">
		<div>list of all questions</div>
		</div>
		<div style="position: absolute; bottom: 0; right: 0; width: 82px;">
		<div style="position: fixed;">
		<button type="button" class="btn btn-primary" data-toggle="modal"
				data-target="#submit"
						>submit</button>
						</div>
						</div>
						</div>
						</div>
						</div>';
	}
	public function printModal() {
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
require_once (realpath ( dirname ( __FILE__ ) ) . '/../model/TestTemplate.php');
if (isset ( $_GET ['TestTemplateID'] )) {
	new AnswerTestView ( new TestTemplate ( $_GET ['TestTemplateID'] ) );
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