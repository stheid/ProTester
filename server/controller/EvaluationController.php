<?php
require_once (realpath ( dirname ( __FILE__ ) ) . '/../model/TestTemplate.php');
require_once (realpath ( dirname ( __FILE__ ) ) . '/../model/Question.php');
require_once (realpath ( dirname ( __FILE__ ) ) . '/../model/Answer.php');
require_once (realpath ( dirname ( __FILE__ ) ) . '/../model/Test.php');

/**
 *
 * @access public
 * @author gamer01
 * @package Server.Controller
 */
class EvaluationController extends Controller {
	private $index = 0;
	private $tests = array ();
	private $nextTest;
	public function __construct($testTempl) {
		parent::includes ();
		$this->loadTest ( $testTempl );
	}
	
	/**
	 *
	 * @param        	
	 *
	 * @see TestTemplate $testTempl
	 */
	private function loadTest($testTempl) {
		if (isset ( $_POST ['points'] ) && isset ( $_POST ['evalRule'] ) && isset ( $_SESSION ['TestID'] )) {
			$test = new Test ( $_SESSION ['TestID'] );
			$this->uploadPointsAndSolutions ( $_SESSION ['TestID'], $_POST ['points'], $_POST ['evalRule'] );
		}
		
		$tests = $testTempl->getTests ();
		foreach ( $tests as $test ) {
			
			if ($test->areAllAnswerpointsSet ()) {
				parent::calculateGrade ( $test );
			}
			
			// reload from DB
			$test = new Test ( $test->getID () );
			
			array_push ( $this->tests, $test );
		}
		
		if (empty ( $tests ) || isset ( $_POST ['Homepage'] )) {
			require_once (realpath ( dirname ( __FILE__ ) ) . '/../controller/LoginController.php');
		} else {
			
			$this->setIndex ();
			
			$this->setNextTest ();
			$this->setButtonSelectors ();
			
			header ( "Location: " . PATH . "server/view/EvaluateTestView.php?TestID=" . $this->nextTest );
		}
	}
	
	/**
	 * Selects the next test from index
	 */
	private function setNextTest() {
		$this->nextTest = $this->tests [$this->index]->getID ();
	}
	
	/**
	 *
	 * @param String $key
	 *        	selects the right index to be updated
	 */
	private function setIndex() {
		if (isset ( $_SESSION ['index'] )) {
			$this->index = $_SESSION ['index'];
		}
		if (isset ( $_POST ['nav'] )) {
			$this->index += $_POST ['nav'] == "Next" ? 1 : - 1;
		}
		
		// check ranges
		if ($this->index < 0) {
			$this->index = 0;
		} elseif ($this->index >= count ( $this->tests )) {
			$this->index = count ( $this->tests );
		}
		$_SESSION ['index'] = $this->index;
	}
	
	/**
	 *
	 * @param array $points
	 *        	questionID => points
	 * @param array $solutions
	 *        	questionID => evaluationrule
	 */
	private function uploadPointsAndSolutions($testID, $points, $solutions) {
		foreach ( $points as $questionID => $point ) {
			if ($point != "") {
				Answer::update ( $testID, $questionID, $point );
			}
		}
		
		foreach ( $solutions as $questionID => $solution ) {
			OpenQuestion::update ( $questionID, $solution );
		}
	}
	
	/**
	 * selects in the session variable, which buttons are to be enabled in the @see EvaluateTestView
	 */
	private function setButtonSelectors() {
		unset ( $_SESSION ['disableNav'] );
		if ($this->index == 0) {
			$_SESSION ['disableNav'] ['Back'] = TRUE;
		}
		if ($this->index >= count ( $this->tests ) - 1) {
			$_SESSION ['disableNav'] ['Next'] = TRUE;
		}
	}
}
session_start ();
if (isset ( $_GET ['TestTemplateID'] )) {
	$_SESSION ['TestTemplateID'] = $_GET ['TestTemplateID'];
	new EvaluationController ( new TestTemplate ( $_SESSION ['TestTemplateID'] ) );
} else {
	require_once (realpath ( dirname ( __FILE__ ) ) . '/../controller/LoginController.php');
}
?>