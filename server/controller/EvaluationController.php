<?php
require_once (realpath ( dirname ( __FILE__ ) ) . '/../model/TestTemplate.php');

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
		if (isset ( $_POST )) {
			$this->uploadPointsAndSolutions ();
		}
		
		if (empty ( $testTempl->getTests () ) || isset ( $_POST ['Homepage'] )) {
			require_once (realpath ( dirname ( __FILE__ ) ) . '/../controller/LoginController.php');
		}
		
		foreach ( $testTempl->getTests () as $test ) {
			if ($test->isEvaluated ()) {
				array_push ( $this->tests ['ev'], $test );
			} else {
				array_push ( $this->tests ['unev'], $test );
			}
		}
		
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
	private function uploadPointsAndSolutions() {
		// TODO
	}
	private function setButtonSelectors() {
		if ($this->indexes ['unev'] == 0) {
			$_SESSION ['disableNav'] ['unevBack'] = TRUE;
		}
		if ($this->indexes ['ev'] == 0) {
			$_SESSION ['disableNav'] ['evBack'] = TRUE;
		}
		if ($this->indexes ['unev'] == count ( $this->tests ['unev'] )) {
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