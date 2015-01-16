<?php
class Tab {
	public $id;
	public $title;
	// contains the whole content of the tab,
	// generated with information, stored in the database
	public $content;
}

class NewsTab extends Tab {
	public $id = "news";
	public $title = "News";
	public $content = "no news atm.";
}

class ViewResultTab extends Tab {
	function __construct() {
		$this->content = '<h1>November 2014</h1>
<ul class="list-group">
<li class="list-group-item"><a href="' . PATH . 'server/view/viewResult.php">11.
Nov - Software System Development Exam<span style="float: right">35/40</span>
</a></li>
<li class="list-group-item"><a href="' . PATH . 'server/view/viewResult.php">11.
Nov - Software System Development Exam<span style="float: right">35/40</span>
</a></li>
<li class="list-group-item"><a href="' . PATH . 'server/view/viewResult.php">11.
Nov - Software System Development Exam<span style="float: right">35/40</span>
</a></li>
<li class="list-group-item"><a href="' . PATH . 'server/view/viewResult.php">11.
Nov - Software System Development Exam<span style="float: right">35/40</span>
</a></li>
<li class="list-group-item"><a href="' . PATH . 'server/view/viewResult.php">11.
Nov - Software System Development Exam<span style="float: right">35/40</span>
</a></li>
<li class="list-group-item"><a href="' . PATH . 'server/view/viewResult.php">11.
Nov - Software System Development Exam<span style="float: right">35/40</span>
</a></li>
</ul>
<h1>October 2014</h1>
<ul class="list-group">
<li class="list-group-item"><a href="' . PATH . 'server/view/viewResult.php">11.
Nov - Software System Development Exam<span style="float: right">35/40</span>
</a></li>
<li class="list-group-item"><a href="' . PATH . 'server/view/viewResult.php">11.
Nov - Software System Development Exam<span style="float: right">35/40</span>
</a></li>
<li class="list-group-item"><a href="' . PATH . 'server/view/viewResult.php">11.
Nov - Software System Development Exam<span style="float: right">35/40</span>
</a></li>
<li class="list-group-item"><a href="' . PATH . 'server/view/viewResult.php">11.
Nov - Software System Development Exam<span style="float: right">35/40</span>
</a></li>
<li class="list-group-item"><a href="' . PATH . 'server/view/viewResult.php">11.
Nov - Software System Development Exam<span style="float: right">35/40</span>
</a></li>
<li class="list-group-item"><a href="' . PATH . 'server/view/viewResult.php">11.
Nov - Software System Development Exam<span style="float: right">35/40</span>
</a></li>
</ul>';
	}
	public $id = "view_res";
	public $title = "View Results";
	// TODO
	public $content;
}

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
class TestManagementTab extends Tab {
	public $id = "test_mgr";
	public $title = "Manage Tests";
	// TODO
	public $content = "";
}
class CourseManagementTab extends Tab {
	public $id = "course_mgr";
	public $title = "Manage Courses";
	// TODO
	public $content = "";
}
class AccountManagementTab extends Tab {
	public $id = "acc_mgr";
	public $title = "Manage Accounts";
	// TODO
	public $content = "";
}

?>