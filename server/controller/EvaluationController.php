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
	private $indexes = array (
			'unev' => 0,
			'ev' => 0 
	);
	private $tests = array (
			'unev' => array (),
			'ev' => array () 
	);
	private $nextTest;
	public function __construct($testTempl) {
		parent::includes ();
		$this->loadTest ( $testTempl );
	}
	private function loadTest($testTempl) {
		$tests = $testTempl->getTests ();
		foreach ( $tests as $test ) {
			if ($test->isEvaluated ()) {
				array_push ( $this->tests ['ev'], $test );
			} else {
				array_push ( $this->tests ['unev'], $test );
			}
		}
		
		if (isset ( $_POST ['points'] ) && isset ( $_POST ['evalRule'] ) && isset ( $_SESSION ['TestID'] )) {
			$test = new Test ( $_SESSION ['TestID'] );
			$this->uploadPointsAndSolutions ( $_SESSION ['TestID'], $_POST ['points'], $_POST ['evalRule'] );
			parent::calculateGrade ( $test );
		}
		
		if (empty ( $tests ) || isset ( $_POST ['Homepage'] )) {
			require_once (realpath ( dirname ( __FILE__ ) ) . '/../controller/LoginController.php');
		} else {
			
			if (! empty ( $this->tests ['unev'] )) {
				$this->setIndex ( "unev" );
			}
			
			if (! empty ( $this->tests ['ev'] )) {
				$this->setIndex ( "ev" );
			}
			
			if (isset ( $_POST ['unev'] )) {
				$this->nextTest = $this->tests ['unev'] [$this->indexes ['unev']]->getID ();
			} elseif (isset ( $_POST ['ev'] )) {
				$this->nextTest = $this->tests ['ev'] [$this->indexes ['ev']]->getID ();
			} else {
				if (! empty ( $this->tests ['unev'] )) {
					$this->nextTest = $this->tests ['unev'] [$this->indexes ['unev']]->getID ();
				} else {
					$this->nextTest = $this->tests ['ev'] [$this->indexes ['ev']]->getID ();
				}
			}
			
			$this->setButtonSelectors ();
			
			header ( "Location: " . PATH . "server/view/EvaluateTestView.php?TestID=" . $this->nextTest );
		}
	}
	
	/**
	 *
	 * @param String $key
	 *        	selects the right index to be updated
	 */
	private function setIndex($key) {
		if (isset ( $_SESSION ['indexes'] [$key] )) {
			$this->indexes [$key] = $_SESSION ['indexes'] [$key];
		}
		if (isset ( $_POST [$key] )) {
			$this->indexes [$key] += $_POST [$key] == "Next" ? 1 : - 1;
		}
		// check ranges
		if ($this->indexes [$key] < 0) {
			$this->indexes [$key] = 0;
		} elseif ($this->indexes [$key] > count ( $this->tests [$key] )) {
			$this->indexes [$key] = count ( $this->tests [$key] );
		}
		$_SESSION ['indexes'] [$key] = $this->indexes [$key];
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
			Answer::update ( $testID, $questionID, $point );
		}
		
		foreach ( $solutions as $questionID => $solution ) {
			OpenQuestion::update ( $questionID, $solution );
		}
	}
	
	/**
	 */
	private function setButtonSelectors() {
		if ($this->indexes ['unev'] == 0) {
			$_SESSION ['disableNav'] ['unevBack'] = TRUE;
		}
		if ($this->indexes ['ev'] == 0) {
			$_SESSION ['disableNav'] ['evBack'] = TRUE;
		}
		if ($this->indexes ['unev'] == count ( $this->tests ['unev'] ) - 1) {
			$_SESSION ['disableNav'] ['unevNext'] = TRUE;
		}
		if ($this->indexes ['ev'] == count ( $this->tests ['ev'] )) {
			$_SESSION ['disableNav'] ['evNext'] = TRUE;
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