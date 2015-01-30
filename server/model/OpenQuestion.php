<?php
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Evaluation_Rule.php');
require_once(realpath(dirname(__FILE__)) . '/../../Server/Model/Question.php');

/**
 * @access public
 * @author gamer01
 * @package Server.Model
 */
class OpenQuestion extends Question {
	/**
	 * @AssociationType Server.Model.Evaluation Rule
	 * @AssociationMultiplicity 1
	 * @AssociationKind Aggregation
	 */
	public $_unnamed_Evaluation_Rule_;
}
?>