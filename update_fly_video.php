<?php
include "lib/connect.php";

$token = $argv[2];
$realTime=date('Y-m-d H:i:s');

$queryinsert=mysql_query("INSERT INTO `video_fly`(`upload_time`,`token`) Values('$realTime','$token')");

//exec("/usr/bin/sudo /var/www/ffmpeg/ffmpeg/transcode_aerial.sh $token > /dev/null &",$output,$return);

unset($argv[0],$argv[1],$argv[2]);

?>

