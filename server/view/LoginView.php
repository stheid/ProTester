<?php
include_once 'View.php';
class LoginView extends View{
	
	static $tabs;
	protected static $title='Login';
	
	static protected function includes(){
		parent::includes();
	}
	
	static protected function content(){
		echo '<div class="row">';
				if (isset(Session::$loginError)){
				echo '<div class="alert alert-danger" role="alert">No Username</div>';
		};
		echo '<div class="col-md-4 col-md-offset-4 col-xs-6 col-xs-offset-3">
				<form action="'.PATH.'server/controller/LoginController.php" method="post">
		<div class="form-group">
		<label for="usrName">Username</label>
		<input class="form-control" id="inputUsrName" placeholder="Enter Username" name="usr">
		</div>
		<div class="form-group">
		<label for="inputPasswd">Password</label>
		<input type="password" class="form-control" id="inputPasswd" placeholder="Enter Password" name="pwd">
		</div>
		<button type="submit" class="btn btn-default pull-right">Login</button>
		</form></div>
		</div>';
	}
}

new LoginView();
	?>