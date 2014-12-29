<?php

include ("settings.php");

$hasNowTest=false;
if ($hasNowTest) {
	$target=PATH."";
}else {
	$target=PATH."server/view/MainView.php";
}
header("Location: $target");
die();
?>