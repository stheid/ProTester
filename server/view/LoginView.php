<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Login</title>
<link rel="stylesheet" href="<?php echo PATH;?>client/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo PATH;?>client/navbar_mod.css">

</head>
<body>
	<?php
	include "navbar.php";
	?>
	<div class="row">
  <div class="col-md-4 col-md-offset-4 col-xs-6 col-xs-offset-3">
  <form action="server/controller/LoginController.php" method="post">
	  <div class="form-group">
	    <label for="inputUsrName">Username</label>
	    <input type="email" class="form-control" id="inputUsrName" placeholder="Enter Username">
	  </div>
	  <div class="form-group">
	    <label for="inputPasswd">Password</label>
	    <input type="password" class="form-control" id="inputPasswd" placeholder="Enter Password">
	  </div>
	  <button type="submit" class="btn btn-default pull-right">Login</button>
	</form></div>
</div>


	

	<script src="<?php echo PATH;?>client/jquery-2.1.1-min.js" type="text/javascript"></script>
	<script src="<?php echo PATH;?>client/bootstrap/js/bootstrap.min.js"
		type="text/javascript"></script>
</body>
</html>