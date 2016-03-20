<?php
	
$partNum  = $_POST['partnum'];
$token    = $_POST['token'];
$eof	  = $_POST['eof'];
		
$filePath = dirname(__FILE__) . '/aerial_video/tmp_upload/'. $token;

if ($_FILES['part']['error'] == 0) {
	move_uploaded_file($_FILES["part"]["tmp_name"], $filePath . "-" . $partNum);
}
if($eof==1){
	exec("/usr/bin/sudo /var/www/ffmpeg/ffmpeg/fly_upload.sh $partNum $token > /dev/null & ");
}

?>
