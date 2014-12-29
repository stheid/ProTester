<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>
<frameset>
	<frame>
	<frame>
	<noframes>
		<body>
			<p>This page uses frames. The current browser you are using does not
				support frames.</p>
    <?php
				include 'navbar.php';
				class MainView{
					public static $tabs[] = new NewsTab ();
				}
				
				$isStudent = true;
				if ($isStudent) {
					MainView::$tabs[]=new ViewResultTab();
				}
				
				$isLecturer = false;
				if ($isLecturer) {
					MainView::$tabs[]=new TestManagementTab();
					MainView::$tabs[]=new EvaluateTestTab();
				}
				
				$isAdmin = false;
				if ($isAdmin) {
					MainView::$tabs[]=new CourseManagementTab();
					MainView::$tabs[]=new AccountManagementTab();
				}
				
				$navtabs='<ul class="nav nav-tabs" role="tablist">';
				foreach(MainView::$tabs as $tab){
					$navtabs= $navtabs.'<li role="presentation" class="active"><a
						href="#'.$tab->$id.'"
						aria-controls="'.$tab->$title.'" role="tab"
						data-toggle="tab">' .$tab->$title.'</a></li>'; 
				}
				$navtabs=	$navtabs."</ul>";

				
				
				$navpanes='<div class="tab-content">';
				foreach(MainView::$tabs as $tab){
					$navtabs= $navtabs.'<div role="tabpanel" class="tab-pane active" id="'.$tab->$id.
					'">'.$tab->$content.'</div>';
				}
				
				$navpanes=$navpanes.'</div>';

				
				echo $navtabs.$navpanes;
				?>
		</body>
	</noframes>
</frameset>
</html>