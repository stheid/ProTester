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
				$isStudent = true;
				if ($isStudent) {
					include StudentMain . php;
				}
				$isLecturer = true;
				if ($isLecturer) {
					include StudentMain . php;
				}
				$isAdmin = true;
				if ($isAdmin) {
					include StudentMain . php;
				}
				?>
    </body>
	</noframes>
</frameset>
</html>