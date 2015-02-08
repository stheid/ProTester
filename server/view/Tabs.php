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
		$person=new Person($_SESSION ['ID'] );
		$tests = $person->getWrittenTests ();
		
		$this->content = "";
		$actualDate = "";
		foreach ( $tests as $test ) {
			if ($actualDate != $test->getTestTemplate ()->getMonthYear ()) {
				// if it's not the first heading
				if (! empty ( $actualDate )) {
					$this->content .= "\n".'</ul>';
				}
				$actualDate = $test->getTestTemplate ()->getMonthYear ();
				$this->content .= "\n".'<h1>' . $actualDate . '</h1>'."\n  ".'<ul class="list-group">';
			}
			$this->content .= "\n".'<li class="list-group-item">';
			$this->content .= '<a href="' . PATH . 'server/view/ViewResult.php?TestID=' . $test->getID () . '">';
			$this->content .= $test->getTestTemplate ()->getDayMonth () . '&nbsp;&nbsp;&mdash;&nbsp;&nbsp;' . $test->getTestTemplate ()->getCourse ()->getName ();
			$this->content .= '<span style="float: right">' . $test->getResult () . '/' . $test->getTestTemplate ()->getMaxPoints () . '</span>';
			$this->content .= '</a></li>';
		}
		$this->content .= "\n".'</ul>';
	}
	public $id = "view_res";
	public $title = "View Results";
	public $content;
}
class EvaluateTestTab extends Tab {
	function __construct() {
		/*
		 * getTestTemplates for a teacher sorted by course and groupid
		 *
		 * courseid ""
		 * groupid ""
		 *
		 * foreach testtemplate
		 * if thiscourseid != courseid
		 * set courseid thiscourseid
		 * print testtemplate->getcourse()->name as heading
		 * if thisgroupid != groupid
		 * set groupid thisgroupid
		 * print testtemplate->getcourse()->name as strong paragraph//enum name
		 * list element for this testtemplate
		 */
		$testTemplates = $person->getCreatedTestTemplates ();
		
		$this->content = "";
		$actualCourseID = "";
		$actualGroupID = "";
		foreach ( $testTemplates as $testTempl ) {
			if (! $testTempl->getCourse ()->equalsCourse ( $actualCourseID )) {
				// if it's not the first heading
				if (!empty ( $actualCourseID )) {
					$this->content .= "\n\t\t".'</ul>'."\n\t".'</li>';
					$this->content .= "\n".'</ul>';
				}
				$actualCourseID = $testTempl->getCourse ()->getCourseID ();
				$this->content .= "\n".'<h1>' . $testTempl->getCourse ()->getName () . '</h1>'."\n".'<ul class="list-group">';
			}
			if (! $testTempl->getCourse ()->equals ( $actualCourseID, $actualGroupID )) {
				// if it's not the first heading
				$actualGroupID = $testTempl->getCourse ()->getGroupID ();
				$this->content .= "\n\t".'<li class="list-group-item">'.
						"\n\t\t".'<p><strong>' . $testTempl->getCourse ()->getGroupName () . '</strong></p>'.
						"\n\t\t".'<ul class="list-group">';
				$i = 1;
			}
			$this->content .= "\n\t\t\t".'<li class="list-group-item">';
			$this->content .= '<a href="' . PATH . 'server/view/EvaluateTestView.php?TestTemplateID=' . $testTempl->getID () . '">';
			$this->content .= 'Exam ' . $i;
			$i ++;
			$this->content .= '</a></li>';
		}
		$this->content .= "\n\t\t".'</ul>'."\n\t".'</li>';
		$this->content .= "\n".'</ul>';
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