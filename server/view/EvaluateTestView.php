<?php
require_once (realpath ( dirname ( __FILE__ ) ) . '/../model/Test.php');
include_once 'TestViewer.php';

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
		}
		
		// display test questions, 
		// answers and evaluationcriteria
		
		// print sidebar
		
		echo'<div class="panel-group">
					<div class="panel panel-info">
						<a class="panel-info" data-toggle="collapse"
							data-parent="#accordion1" href="#collapseOne">
							<div class="panel-heading">
								<h4 class="panel-title">
									Open Question 1<span class="glyphicon glyphicon-ok"
										style="float: right;" aria-hidden="true"></span>
								</h4>
							</div>
						</a>
						<div id="collapseOne" class="panel-collapse collapse">
							<div class="panel-body">
								<textarea class="bg-success" style="width: 100%" disabled>Student Answer</textarea>
								<form action="../controller/TestManager.php" method="post"  size="2">
								<div align="right"></form><input style="width: 2em" type="points" id="1" points="points"
									onchange="checkFilled();">/3</div>
								<p class="bg-info" style="width: 100%" disabled="disabled">Critarias:
									Spirituality means waking up. Most people, even though they
									don\'t know it, are asleep. They\'re born asleep, they live
									asleep, they marry in their sleep, they breed children in their
									sleep, they die in their sleep without ever waking up. They
									never understand the loveliness and the beauty of this thing
									that we call human existence. You know � all mystics �
									Catholic, Christian, non-Christian, no matter what their
									theology, no matter what their religion � are unanimous on one
									thing: that all is well, all is well. Though everything is a
									mess, all is well. Strange paradox, to be sure. But,
									tragically, most people never get to see that all is well
									because they are asleep. They are having a nightmare.</p>
							</div>
				<script> function checkFilled() {
									var inputVal = document.getElementById("1").value;
								    if (inputVal == "") {
								        document.getElementById("1").style.backgroundColor = "red";
							       								    }
								    else{
								        document.getElementById("1").style.backgroundColor = "white";
								        								    }
								}
								 
								checkFilled();
								</script>
						</div>
					</div>
							<div class="panel panel-success">
					<a class="panel-success" data-toggle="collapse"
						data-parent="#accordion1" href="#collapse2">
						<div class="panel-heading">
							<h4 class="panel-title">
								Closed Question 2<span class="glyphicon glyphicon-remove"
									style="float: right;" aria-hidden="true"></span>
							</h4>
						</div>
					</a>
					<div id="collapse2" class="panel-collapse collapse">
						<div class="panel-body">
							<ul class="input-list">
								<li class="bg-danger disabled"><label><input type="checkbox"
										id="chk1" name="chk1" disabled checked> Answer 1<label></li>
								<li class="bg-success disabled"><label><input type="checkbox"
										id="chk2" name="chk2" disabled> Answer 2</label></li>
							</ul>
							<div align="right">0/1</div>
						</div>
					</div>
				</div>
				<div class="panel panel-success">
					<a class="panel-success" data-toggle="collapse"
						data-parent="#accordion1" href="#collapse3">
						<div class="panel-heading">
							<h4 class="panel-title">
								Gap Question <span class="glyphicon glyphicon-remove"
									style="float: right;" aria-hidden="true"></span>
							</h4>
						</div>
					</a>
					<div class="panel-body">
						Ala ma kota,
						<textarea class="bg-success" style="width: 20em; height: 2em"
							disabled>kot</textarea>
						ma Ale.
						<div align="right">2/2</div>

					</div>
				</div>
				<div class="panel panel-success">
					<a class="panel-success" data-toggle="collapse"
						data-parent="#accordion1" href="#collapse4">
						<div class="panel-heading">
							<h4 class="panel-title">
								Question 4<span class="glyphicon glyphicon-minus"
									style="float: right;" aria-hidden="true"></span>
							</h4>
						</div>
					</a>
					<div id="collapse4" class="panel-collapse collapse">
						<div class="panel-body">
							<textarea class="bg-warning" style="width: 100%" disabled>My open Answer</textarea>
							<span style="float: right;">4/5</span>
						</div>
					</div>
				</div>
			</div>

			<div class="panel-group">
				<div class="panel panel-success">
					<a class="panel-success" data-toggle="collapse"
						data-parent="#accordion2" href="#collapse5">
						<div class="panel-heading">
							<h4 class="panel-title">
								Question 5<span class="glyphicon glyphicon-ok"
									style="float: right;" aria-hidden="true"></span>
							</h4>
						</div>
					</a>
					<div id="collapse5" class="panel-collapse collapse">
						<div class="panel-body">Content</div>
					</div>
				</div>
				<div class="panel panel-success">
					<a class="panel-success" data-toggle="collapse"
						data-parent="#accordion2" href="#collapse6">
						<div class="panel-heading">
							<h4 class="panel-title">
								Question 6<span class="glyphicon glyphicon-ok"
									style="float: right;" aria-hidden="true"></span>
							</h4>
						</div>
					</a>
					<div id="collapse6" class="panel-collapse collapse">
						<div class="panel-body">Content</div>
					</div>
				</div>
				<div class="panel panel-success">
					<a class="panel-success" data-toggle="collapse"
						data-parent="#accordion2" href="#collapse7">
						<div class="panel-heading">
							<h4 class="panel-title">
								Question 7<span class="glyphicon glyphicon-remove"
									style="float: right;" aria-hidden="true"></span>
							</h4>
						</div>
					</a>
					<div id="collapse7" class="panel-collapse collapse">
						<div class="panel-body">Content</div>
					</div>
				</div>
				<div class="panel panel-success">
					<a class="panel-success" data-toggle="collapse"
						data-parent="#accordion2" href="#collapse8">
						<div class="panel-heading">
							<h4 class="panel-title">
								Another question<span class="glyphicon glyphicon-ok"
									style="float: right;" aria-hidden="true"></span>
							</h4>
						</div>
					</a>
					<div id="collapse8" class="panel-collapse collapse">
						<div class="panel-body">Content</div>
					</div>
				</div>
			</div>
		</div>';
		$this->printSidebar();
		echo '</div>
			</div>
				</form>';
	}
	
	private function printSidebar(){
		$buttons = '<input type="submit" name="unev" class="btn" value="Previous"/>
				 Not Evaluated 
				<input type="submit" name="unev" class="btn" value="Next"/><br>';
		$buttons .= '<input type="submit" name="ev" class="btn" value="Previous"/>
				 Evaluated 
				<input type="submit" name="ev" class="btn" value="Next"/><br>';
		$buttons .= '<input type="submit" name="Homepage" class="btn" value="Back To Homepage"/>';
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