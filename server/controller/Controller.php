<?php
class Controller {

	static protected function includes(){
		session_start();
		include '../controller/settings.php';
	}
}