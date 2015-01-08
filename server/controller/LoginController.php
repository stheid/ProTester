<?php

define("PATH", "http://localhost/ProTester/");

$hasNowTest=false;
if ($hasNowTest) {
	$target=PATH."";
}else {
	$target=PATH."server/view/MainView.php";
}
header("Location: $target");
die();
?>