<?php
include '../controller/settings.php';
include 'navbar.php';
include 'tabs/NewsTab.php';
include 'tabs/ViewResultTab.php';
include 'tabs/EvaluateTestTab.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Main</title>
<link rel="stylesheet"
	href="<?php echo PATH; ?>client/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css"
	href="<?php echo PATH; ?>client/navbar_mod.css">

</head>
<body>
<?php
class MainView {
	static $tabs;
}

MainView::$tabs [] = new NewsTab ();

$isStudent =true;
if ($isStudent) {
	MainView::$tabs [] = new ViewResultTab ();
}
 
$isLecturer = false;
if ($isLecturer) {
	MainView::$tabs [] = new TestManagementTab ();
	MainView::$tabs [] = new EvaluateTestTab ();
}

$isAdmin = false;
if ($isAdmin) {
	MainView::$tabs [] = new CourseManagementTab ();
	MainView::$tabs [] = new AccountManagementTab ();
}

$navtabs = '
			<ul class="nav nav-tabs" role="tablist">';
$i = 0;
foreach ( MainView::$tabs as $tab ) {
	
	$navtabs = $navtabs . '
				<li role="presentation"' . ($i == 0 ? ' class="active"' : '') . '>
					<a href="#' . $tab->id . '" aria-controls="' . $tab->title . '" role="tab" data-toggle="tab">' . $tab->title . '
					</a>
				</li>';
	$i ++;
}
$navtabs = $navtabs . "
			</ul>";

$navpanes = '<div class="tab-content">';
$i = 0;
foreach ( MainView::$tabs as $tab ) {
	$navpanes = $navpanes . '
				<div role="tabpanel" class="tab-pane' . ($i == 0 ? ' active' : '') . '" id="' . $tab->id . '">
						' . $tab->content . '
				</div>';
	$i ++;
}

$navpanes = $navpanes . '</div>';

echo '<div class="container">
		<div role="tabpanel">' . $navtabs . $navpanes . '</div>
	</div>';
?>
<script src="<?php echo PATH; ?>client/jquery-2.1.1-min.js"
		type="text/javascript"></script>
	<script src="<?php echo PATH; ?>client/bootstrap/js/bootstrap.min.js"
		type="text/javascript"></script>
</body>
</html>