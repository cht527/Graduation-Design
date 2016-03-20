<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<META http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8">
<?php date_default_timezone_set("Asia/Shanghai");?>
<?php
	include "./lib/connect.php";
	$ID    = $_GET['id'];
	$name  = $_GET['name']; 
	$time  = date('Y-m-d H:i:s');
	$file  = '/var/www/ffmpeg/ffmpeg/delayvideo/'.$ID.'.mp4';
	$vtime = exec("/usr/local/bin/ffmpeg -i ".$file." 2>&1 | grep 'Duration' | cut -d '' -f 4 | sed s/,//");
	$duration = explode(":",$vtime); 
	$duration_in_seconds = $duration[1]*3600 + $duration[2]*60+ round($duration[3]);
	$sql = mysql_query("INSERT INTO `video_send` (`title`,`datetime`,`time`) Values ('$name','$time','$duration_in_seconds')");
	$query = "SELECT * FROM video_send order by ID desc limit 0,1";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$id  = $row[0];
	exec("/usr/bin/sudo /var/www/ffmpeg/ffmpeg/tui.sh $ID $id",$output,$return);
	echo $id.'mp4';
?>
<!--<script Language="JavaScript"> 
	if(confirm("推送成功,是否观看视频？")){
		
	}else{
		window.location.href="./dealVideo.php";
	}
</script>-->
</html>
