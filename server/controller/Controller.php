<?php
/**
 * @author gamer01
 * 
 */
abstract class Controller {
	
	/**
	 * Handles includes for the controllers and initializes constants
	 */
	protected static function includes() {
		@session_start ();
		include '../controller/settings.php';
	}
	
	/**
	 *
	 * will calculate the points and upload the result for this test and return the result
	 * 
	 * @param        	
	 *
	 * @see Test $test
	 * @return number : Grade
	 *        
	 */
	public static function calculateResult($test) {
		$points = 0;
		foreach ( $test->getAnswers () as $answer ) {
			$points += $answer->getPoints ();
		}
		Test::updateResult ( $test->getID (), $points );
		return $points;
	}
	
	/**
	 * will calculate the grade and upload the result for this test and return the grade
	 * 
	 * @param        	
	 *
	 * @see Test $test
	 * @return number: Grade
	 */
	public static function calculateGrade($test) {
		static::calculateResult ( $test );
		$points = 0;
		foreach ( $test->getAnswers () as $answer ) {
			$points += $answer->getPoints ();
		}
		$maxpoints = $test->getTestTemplate ()->getMaxPoints ();
		if (2 * $points < $maxpoints) {
			$grade = 2;
		} elseif (10 * $points < 6 * $maxpoints) {
			$grade = 3;
		} elseif (10 * $points < 7 * $maxpoints) {
			$grade = 3.5;
		} elseif (10 * $points < 8 * $maxpoints) {
			$grade = 4;
		} elseif (10 * $points < 9 * $maxpoints) {
			$grade = 4.5;
		} else {
			$grade = 5;
		}
		
		Test::updateGrade ( $test->getID (), $grade );
		return $grade;
	}
}