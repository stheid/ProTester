<?php
include_once 'View.php';
class TestRunnerView extends View {
	protected $title = 'Tests';
	protected function includes() {
		parent::includes ();
		require_once (realpath ( dirname ( __FILE__ ) ) . '/../model/Person.php');
	}
	protected function content() {
		$person = new Person ( $_SESSION ['id'] );
		$testTempls = $person->getScheduledTests ();
		
		$todayTests = array ();
		$laterTests = array ();
		foreach ( $testTempls as $test ) {
			if (strtotime ( $test->getDate () ) == strtotime ( date ( "Y-m-d" ) )) {
				array_push ( $todayTests, $test );
			} elseif (strtotime ( $test->getDate () ) > strtotime ( date ( "Y-m-d" ) )) {
				array_push ( $laterTests, $test );
			}
		}
		usort ( $laterTests, 'TestTemplate::isLater' );
		
		echo '<div class="container">
				<div role="tabpanel">
				<h1>Today</h1>
				<ul class="list-group btn-list">';
		foreach ( $todayTests as $test ) {
			echo '<li class="list-group-item">
					<a class="btn btn-lg btn-block" href="' . PATH . 'server/view/AnswerTest.php?TestTemplateID=' . $test->getID () . '" role="button">' . $test->getCourse ()->getName () . '&nbsp;&nbsp;&mdash;&nbsp;&nbsp;' . $test->getCourse ()->getGroupName () . '</a></li>';
		}
		echo '</ul>';
		
		if (! empty ( $laterTests )) {
			echo '<h1>In the Future</h1>
					<ul class="list-group btn-list disabled">';
			foreach ( $laterTests as $test ) {
				echo '<li class="list-group-item disabled">
						<a class="btn btn-lg btn-block disabled" href="' . PATH . 'server/view/AnswerTest.php?TestTemplateID=' . $test->getID () . '" role="button">' . $test->getDayMonth () . '&nbsp;&nbsp;&mdash;&nbsp;&nbsp;' . $test->getCourse ()->getName () . ' ' . $test->getCourse ()->getGroupName () . '</a></li>';
			}
		}
	}
}

new TestRunnerView ();
?>