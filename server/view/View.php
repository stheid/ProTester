<?php
class View {

	protected static $title='';
	
	function __construct(){
		$this->includes();
		$this->header();
		$this->content();
		$this->footer();
	}
	
	static protected function includes(){
		include '../controller/settings.php';
	}
	
	static protected function header(){
		echo '<!DOCTYPE html>
		<html>
		<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>' . static::$title. '</title>
		<link rel="stylesheet"
				href="' . PATH . 'client/bootstrap/css/bootstrap.min.css">
				<link rel="stylesheet" type="text/css"
						href="' . PATH . 'client/navbar_mod.css">
						</head>
						<body>';
		include 'navbar.php';
	}
	
	static protected function content(){}
	
	static protected function update(){}
	
	static protected function footer(){
		echo '<script src="' . PATH . 'client/jquery-2.1.1-min.js"
				type="text/javascript"></script>
				<script src="' . PATH . 'client/bootstrap/js/bootstrap.min.js"
						type="text/javascript"></script>
						</body>
						</html>';
	}
	
}
?>