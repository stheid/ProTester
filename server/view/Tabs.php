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
		$mysqli = new mysqli (DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);
		
		/* check connection */
		if ($mysqli->connect_errno) {
			echo "Connect failed:  " . $mysqli->connect_error;
			exit ();
		}
		$result = $mysqli->query ( "SELECT DATE_FORMAT(date,'%M %Y') as date  FROM testtemplate order by testid;" );
		$row = $result->fetch_array(MYSQLI_ASSOC);
		
		
		$this->content = '<h1>' .$row['date']. '</h1>
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
<li class="list-group-item">
<p><strong>Lecture</strong></p>
		<ul class="list-group">
			<li class="list-group-item"><a href="' . PATH . 'server/view/EvaluateTestView.php">
				First exam
			</a></li>
			<li class="list-group-item">
				<a href="' . PATH . 'server/view/EvaluateTestView.php">
					Second exam
				</a>
			</li>
		</ul>
</li>
						<li class="list-group-item">
<p><strong>Project1</strong></p>
		<ul class="list-group">
			<li class="list-group-item"><a href="' . PATH . 'server/view/EvaluateTestView.php">
				First exam
			</a></li>
			<li class="list-group-item">
				<a href="' . PATH . 'server/view/EvaluateTestView.php">
					Second exam
				</a>
			</li>
		</ul>
</li>
</ul>
		<h1>Course 2</h1>
						<ul class="list-group">
<li class="list-group-item">
<p><strong>Lecture</strong></p>
		<ul class="list-group">
			<li class="list-group-item"><a href="' . PATH . 'server/view/EvaluateTestView.php">
				First exam
			</a></li>
			<li class="list-group-item">
				<a href="' . PATH . 'server/view/EvaluateTestView.php">
					Second exam
				</a>
			</li>
		</ul>
</li>
						<li class="list-group-item">
<p><strong>Project1</strong></p>
		<ul class="list-group">
			<li class="list-group-item"><a href="' . PATH . 'server/view/EvaluateTestView.php">
				First exam
			</a></li>
			<li class="list-group-item">
				<a href="' . PATH . 'server/view/EvaluateTestView.php">
					Second exam
				</a>
			</li>
		</ul>
</li>
</ul>'
		;
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