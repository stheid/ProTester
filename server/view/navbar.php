<nav class="navbar navbar-fixed-top navbar-default" role="navigation">
	<div class="container-fluid">
		<a class="navbar-brand" href="<?php echo PATH; ?>server/controller/LoginController.php">ProTester</a>
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header navbar-right">
			<ul class="nav navbar-nav">
				<?php				
				if( isset($_SESSION['id'])){
					echo '<li><a href="'.PATH.'server/controller/LoginController.php"> '.$_SESSION['username'].'<span class="glyphicon glyphicon-user"
						aria-hidden="true"></span></a></li>';
					
					echo '<li><a href="'. PATH . 'server/controller/LogoutController.php"><span class="glyphicon glyphicon-off"
						aria-hidden="true"></span></a></li>';
				}
				?>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container-fluid -->
</nav>