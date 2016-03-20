<?php
	//$fileName = "/var/www/ffmpeg/ffmpeg/tmp/".$_POST['fileName'];
	$fileName = "/var/www/ffmpeg/ffmpeg/transcodevideo/".$_POST['fileName'];
	echo file_exists($fileName);
?>
