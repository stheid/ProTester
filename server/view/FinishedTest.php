<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Main</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="answerTest.css">

</head>
<body>
	<nav class="navbar navbar-fixed-top navbar-default" role="navigation">
		<div class="container-fluid">	
			<a class="navbar-brand" href="main.html">ProTester</a>
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header navbar-right">
				<ul class="nav navbar-nav">
					<li>
						<a href="#">Stefan <span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>


	<div class="container">
		<div class="col-md-9 col-xs-8">
		<h3>Test has been finished because your time was over</h3>
		<!-- or because you finished -->

		<?php
			//var_dump($_POST["answer"]);
		?>

		<strong data-toggle="tooltip" title="Only for Closed and Gap questions">Result: 10/50</strong>
		<a class="btn btn-default" style="float:right" href="main.html">Back to Homepage</a>

	</div>
	</div>




	<script src="jquery-2.1.1-min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>