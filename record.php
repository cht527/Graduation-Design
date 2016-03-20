<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<?php date_default_timezone_set("Asia/Shanghai");?>

<?php
include "lib/connect.php";
    //error_reporting( E_ALL&~E_NOTICE );
$name1=$_POST['name1'];
$name2=$_POST['name2'];
$recordDur=$_POST['recordDur'];
$realTime=date('Y-m-d H:i:s');
//$showtime=date("Y-m-d");
//$extime=explode('-',$showtime);
//$year = substr($extime[0], 2, 2);
	//-----------------1号摄像头---------------------------
	if($name1!=""&&$name2==""){
	$sql = mysql_query("INSERT INTO `video`(`record_video`,`record_time`,`camera1`) Values('$name1','$realTime','*')") ;
	$query = "SELECT * FROM video order by ID desc limit 0,1";//只取一条--limit 0,1
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$id1=$row['id'];
	$id2="-1";
	$ID1=$row['id'].'v1';
	$ID2="-1";
	exec("/usr/bin/sudo /var/www/ffmpeg/ffmpeg/record.sh $ID1 $ID2 $recordDur $id1 $id2" ,$output,$return);
	//exec可以把执行的结果全部返回到$output函数里(数组),$status(此处是$return)是执行的状态 0为成功 1为失败
	//echo $return;
	}
	//----------------------------2号摄像头---------------------------
	if($name2!=""&&$name1==""){
	$sql = mysql_query("INSERT INTO `video`(`record_video`,`record_time`,`camera2`) Values('$name2','$realTime','*')") ;
	$query = "SELECT * FROM video order by ID desc limit 0,1";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$id2=$row['id'];
	$id1="-1";
	$ID2=$row['id'].'v2';
	$ID1="-1";
	exec("/usr/bin/sudo /var/www/ffmpeg/ffmpeg/record.sh $ID1 $ID2 $recordDur $id1 $id2" ,$output,$return);
	}
	//----------------------------双摄像头联动-----------------------
	if($name1!=""&&$name2!=""){
	$sql1= mysql_query("INSERT INTO `video`(`record_video`,`record_time`,`camera1`) Values ('$name1','$realTime','*')");
	$sql2= mysql_query("INSERT INTO `video`(`record_video`,`record_time`,`camera2`) Values ('$name2','$realTime','*')");
	$query = "SELECT id FROM video order by ID desc limit 0,2";//取两条
	$result = mysql_query($query, $conn);
        $IDtwo=mysql_fetch_row($result);
	$ID2=$IDtwo[0].'v2';
	$id2=$IDtwo[0];
	mysql_data_seek($result,1);
	$IDone=mysql_fetch_row($result);
	$ID1=$IDone[0].'v1';
	$id1=$IDone[0];
	exec("/usr/bin/sudo /var/www/ffmpeg/ffmpeg/record.sh $ID1 $ID2 $recordDur $id1 $id2" ,$output,$return);
	}
?>
<script>
	if(confirm("录制完成,是否进行下一步处理？")){
		window.location.href="./dealVideo.php";
	}else{
		window.location.href="./main.php";	
	}
</script>
<?php include "lib/footer.php"; ?>
