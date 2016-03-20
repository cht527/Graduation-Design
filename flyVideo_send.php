
<?php
	include "./lib/connect.php";

	$name  = $_GET['sendfileName']; 
	//$tokenarray=array_slice(array_reverse(str_split("$fullname")),1);
	//$name=implode(array_reverse($tokenarray));	
	$time  = date('Y-m-d H:i:s');
	$file  = '/var/www/ffmpeg/ffmpeg/aerial_video/tmp_video/'.$name.'.mp4';
	$vtime = exec("/usr/local/bin/ffmpeg -i ".$file." 2>&1 | grep 'Duration' | cut -d '' -f 4 | sed s/,//");
	$duration = explode(":",$vtime); 
	$duration_in_seconds = $duration[1]*3600 + $duration[2]*60+ round($duration[3]);
	$sql = mysql_query("INSERT INTO `video_send` (`title`,`datetime`,`time`) Values ('$name','$time','$duration_in_seconds')");
	$query = "SELECT * FROM video_send order by ID desc limit 0,1";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$id  = $row[0];
	exec("/usr/bin/sudo /var/www/ffmpeg/ffmpeg/tui_fly.sh $name $id",$output,$return);
	echo $name;
?>

