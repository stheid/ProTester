<?php
class EvaluateTestTab extends Tab {
	function __construct() {
		$this->content = '<h1>Course 1</h1>
<ul class="list-group">
<li class="list-group-item"><a href="' . PATH . 'server/view/viewEvaluateTest.php">
Lecture
		<ul class="list-group">
<li class="list-group-item"><a href="' . PATH . 'server/view/viewEvaluateTest.php">
First exam
</a></li><li class="list-group-item"><a href="' . PATH . 'server/view/viewEvaluateTest.php">
Second exam
</a></li></ul>
</a></li>
<li class="list-group-item"><a href="' . PATH . 'server/view/viewEvaluateTest.php">
Proj 1
</a></li>
<li class="list-group-item"><a href="' . PATH . 'server/view/viewEvaluateTest.php">
Proj 2
</a></li>
</ul>
		<h1>Course 2</h1>
<ul class="list-group">
<li class="list-group-item"><a href="' . PATH . 'server/view/viewEvaluateTest.php">
Lecture
		<ul class="list-group">
<li class="list-group-item"><a href="' . PATH . 'server/view/viewEvaluateTest.php">
Lecture
</a></li></ul>
</a></li>
<li class="list-group-item"><a href="' . PATH . 'server/view/viewEvaluateTest.php">
Proj 1
</a></li>
<li class="list-group-item"><a href="' . PATH . 'server/view/viewEvaluateTest.php">
Proj 2
</a></li>
</ul>';
	}
	public $id = "eval";
	public $title = "Evaluate Tests";
	// TODO
	public $content = "";
}
?>