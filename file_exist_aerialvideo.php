<?php
	$fileName = "/var/www/ffmpeg/ffmpeg/aerial_video/source_video/".$_POST['token'].".mp4";
	echo file_exists($fileName);
?>
