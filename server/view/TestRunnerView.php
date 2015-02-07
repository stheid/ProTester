<?php
include_once 'View.php';
class TestRunnerView extends View {
	protected $title = 'Tests';
	protected function includes() {
		parent::includes ();
	}
	protected function content() {
		echo '<div class="container">
		<div role="tabpanel">' . '
			<h1>Today</h1>
<ul class="list-group btn-list">
<li class="list-group-item"><a class="btn btn-lg btn-block" href="' . PATH . 'server/view/AnswerTest.php" role="button">
Software System Development - Project Questionaire
</a></li>
</ul><h1>Next week</h1>
<ul class="list-group btn-list disabled">
<li class="list-group-item disabled"><a class="btn btn-lg btn-block disabled" href="' . PATH . 'server/view/viewResult.php" role="button">
29. Jan - Software System Development Exam
</a></li><li class="list-group-item disabled"><a class="btn btn-lg btn-block disabled" href="' . PATH . 'server/view/viewResult.php" role="button">
2. Feb - Software Project Management Techniques Exam
</a></li>
</ul>' . '</div>
	</div>';
	}
}

new TestRunnerView ();
?>