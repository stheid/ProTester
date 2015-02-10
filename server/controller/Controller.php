<?php
class Controller {

	protected static function includes(){
		@session_start();
		include '../controller/settings.php';
	}
}