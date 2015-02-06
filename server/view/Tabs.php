<?php
require_once (realpath ( dirname ( __FILE__ ) ) . '/../model/Test.php');
require_once (realpath ( dirname ( __FILE__ ) ) . '/../model/Person.php');
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
		$tests = Person::getWrittenTests ( $_SESSION ['id'] );
		
		$this->content = "";
		$actualDate = "";
		foreach ( $tests as $test ) {
			if ($actualDate != $test->getTestTemplate()->getMonthYear ()) {
				// if it's not the first heading
				if (empty ( $actualDate )) {
					$this->content .= '</ul>';
				}
				$actualDate = $test->getTestTemplate()->getMonthYear ();
				$this->content .= '<h1>'.$actualDate.'</h1>
							<ul class="list-group">';
			}
			$this->content .= '<li class="list-group-item">';
			$this->content .= '<a href="' . PATH . 'server/view/ViewResult.php">';
			$this->content .= $test->getTestTemplate()->getDayMonth() . '&nbsp;&nbsp;&mdash;&nbsp;&nbsp;'. $test->getTestTemplate()->getCourse()->getName();
			$this->content .= '<span style="float: right">'.$test->getResult().'/'.$test->getTestTemplate()->getMaxPoints().'</span>';
			$this->content .= '</a></li>';
		}
	}
	public $id = "view_res";
	public $title = "View Results";
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
	public $content = "";
}
class CourseManagementTab extends Tab {
	public $id = "course_mgr";
	public $title = "Manage Courses";
	public $content = "";
}
class AccountManagementTab extends Tab {
	public $id = "acc_mgr";
	public $title = "Manage Accounts";
	public $content = "";
}

?>