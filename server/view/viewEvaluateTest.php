<?php
include '../controller/settings.php';
include '../controller/TestManager.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>View Result</title>
<link rel="stylesheet"
	href="<?php echo PATH;?>client/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css"
	href="<?php echo PATH;?>client/navbar_mod.css">

</head>
<body>
	<?php
	include "navbar.php";
	?>

	<div class="container">
		<div class="row">
			<div class="col-md-9 col-xs-8">
				<div class="panel-group">
					<div class="panel panel-success">
						<a class="panel-success" data-toggle="collapse"
							data-parent="#accordion1" href="#collapseOne">
							<div class="panel-heading">
								<h4 class="panel-title">
									Open Question 1<span class="glyphicon glyphicon-ok"
										style="float: right;" aria-hidden="true"></span>
								</h4>
							</div>
						</a>
						<div id="collapseOne" class="panel-collapse collapse">
							<div class="panel-body">
								<textarea class="bg-success" style="width: 100%" disabled>Student Answer</textarea>
								<form action='../controller/TestManager.php' method="post"  size="2">
								<div align="right" ></form><input style="width: 2em" type="points" points="points">/3</div>
								<p class="bg-info" style="width: 100%" disabled="disabled">Critarias:
									Spirituality means waking up. Most people, even tho ugh they
									don't know it, are asleep. They're born asleep, they live
									asleep, they marry in their sleep, they breed children in their
									sleep, they die in their sleep without ever waking up. They
									never understand the loveliness and the beauty of this thing
									that we call human existence. You know — all mystics —
									Catholic, Christian, non-Christian, no matter what their
									theology, no matter what their religion — are unanimous on one
									thing: that all is well, all is well. Though everything is a
									mess, all is well. Strange paradox, to be sure. But,
									tragically, most people never get to see that all is well
									because they are asleep. They are having a nightmare.</p>
							</div>
						</div>
					</div>
					<div class="panel panel-danger">
						<a class="panel-danger" data-toggle="collapse"
							data-parent="#accordion1" href="#collapse2">
							<div class="panel-heading">
								<h4 class="panel-title">
									Closed Question 2<span class="glyphicon glyphicon-remove"
										style="float: right;" aria-hidden="true"></span>
								</h4>
							</div>
						</a>
						<div id="collapse2" class="panel-collapse collapse">
							<div class="panel-body">
								<ul class="input-list">
									<li class="bg-danger disabled"><label><input type="checkbox"
											id="chk1" name="chk1" disabled checked> Answer 1<label></li>
									<li class="bg-success disabled"><label><input type="checkbox"
											id="chk2" name="chk2" disabled> Answer 2</label></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="panel panel-danger">
						<a class="panel-danger" data-toggle="collapse" 
							data-parent="#accordion1" href="#collapse3">
							<div class="panel-heading">
								<h4 class="panel-title">
									Question 3<span class="glyphicon glyphicon-remove"
										style="float: right;" aria-hidden="true"></span>
								</h4>
							</div>
						</a>
						<div id="collapse3" class="panel-collapse collapse">
							<div class="panel-body">bla</div>
						</div>
					</div>
					<div class="panel panel-warning">
						<a class="panel-warning" data-toggle="collapse"
							data-parent="#accordion1" href="#collapse4">
							<div class="panel-heading">
								<h4 class="panel-title">
									Question 4<span class="glyphicon glyphicon-minus"
										style="float: right;" aria-hidden="true"></span>
								</h4>
							</div>
						</a>
						<div id="collapse4" class="panel-collapse collapse">
							<div class="panel-body">
								<textarea class="bg-warning" style="width: 100%" disabled>My open Answer</textarea>
								<span style="float: right;">4/5</span>
							</div>
						</div>
					</div>
				</div>

				<div class="panel-group">
					<div class="panel panel-success">
						<a class="panel-success" data-toggle="collapse"
							data-parent="#accordion2" href="#collapse5">
							<div class="panel-heading">
								<h4 class="panel-title">
									Question 5<span class="glyphicon glyphicon-ok"
										style="float: right;" aria-hidden="true"></span>
								</h4>
							</div>
						</a>
						<div id="collapse5" class="panel-collapse collapse">
							<div class="panel-body">Content</div>
						</div>
					</div>
					<div class="panel panel-success">
						<a class="panel-success" data-toggle="collapse"
							data-parent="#accordion2" href="#collapse6">
							<div class="panel-heading">
								<h4 class="panel-title">
									Question 6<span class="glyphicon glyphicon-ok"
										style="float: right;" aria-hidden="true"></span>
								</h4>
							</div>
						</a>
						<div id="collapse6" class="panel-collapse collapse">
							<div class="panel-body">Content</div>
						</div>
					</div>
					<div class="panel panel-danger">
						<a class="panel-danger" data-toggle="collapse"
							data-parent="#accordion2" href="#collapse7">
							<div class="panel-heading">
								<h4 class="panel-title">
									Question 7<span class="glyphicon glyphicon-remove"
										style="float: right;" aria-hidden="true"></span>
								</h4>
							</div>
						</a>
						<div id="collapse7" class="panel-collapse collapse">
							<div class="panel-body">Content</div>
						</div>
					</div>
					<div class="panel panel-success">
						<a class="panel-success" data-toggle="collapse"
							data-parent="#accordion2" href="#collapse8">
							<div class="panel-heading">
								<h4 class="panel-title">
									Another question<span class="glyphicon glyphicon-ok"
										style="float: right;" aria-hidden="true"></span>
								</h4>
							</div>
						</a>
						<div id="collapse8" class="panel-collapse collapse">
							<div class="panel-body">Content</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-xs-4" style="height: 300px;">
				<div style="position: fixed;">
					<div>list of all questions</div>
				</div>
				<div style="position: absolute; bottom: 0; width: 262px;">
					<div style="position: fixed;">
						<a href="main.html" class="btn btn-default">Prevoius test</a> 
						<a href="main.html" class="btn btn-default">Next test</a> 
						<a href="main.html" class="btn btn-default">Back to Homepage</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="<?php echo PATH;?>client/jquery-2.1.1-min.js"></script>
	<script src="<?php echo PATH;?>client/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>