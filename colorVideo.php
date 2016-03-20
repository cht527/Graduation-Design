<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/base.css" />
<title>视频生成与处理平台</title>
<style type="text/css">
.table th, .table .center{
	text-align:center;
}
.authBody {
	height:410px;
	width:774px;
	margin:auto;
	margin-top:0px;
	position:relative;
	background-image:url(img/background11.jpg);
	text-align:center;
}
.authBody h1 {
	font-family:Microsoft YaHei;
	text-align:center;
}
#authForm {
		margin-top: 50px;
	}
	#authForm p {
		font-family:Microsoft Hei;
	}
	#ui-datepicker-div .ui-datepicker-title select {
		width: 42%;
	}
#ibox{
	line-height:20px;
	width:300px;
	height:20px;
	background:#FFFFFF;
	text-align:left;
	margin:50px auto 0 auto; 
	border:1px solid #CFCFCF;
	}
#iLoading{
	color:#000000;
	font-size:12px;
	line-height:20px;
	width:0px;
	height:20px;
	text-align:center;
	position: absolute;
}
</style>
</head>
<body>
<div id="header" style="width:800px;margin:0 auto;">
<img style="width:710px;height:240px;margin-left:0px;" src="img/logo_3.jpg" />
</div>
<div style="height:340px;width:600px;margin-top:10px;" class="authBody">
<h1 style="font-family:simsun;">视频生成与处理平台</h1>
<?php
include "lib/connect.php";
$vname=$_POST['v_name'];
$vstyle=$_POST['videoStyle'];
//时间区间参数
$time_start=$_POST['time_start'];
$time_end=$_POST['time_end'];
if($time_start!="" && $time_end!=""){
$Tarrayend=explode(":",$time_end);
$Tarraystart=explode(":",$time_start);
$T_endHour=$Tarrayend[0];
$T_endMin=$Tarrayend[1];
$T_endSec=$Tarrayend[2];
$T_startHour=$Tarraystart[0];
$T_startMin=$Tarraystart[1];
$T_startSec=$Tarraystart[2];
	if(intval($T_endSec)-intval($T_startSec)<0){
		$SS=intval($T_endSec)+60-intval($T_startSec);
		if(intval($T_endMin)==0){
			$T_endMin=intval($T_endMin)+60-1;
			if(intval($T_endMin)-intval($T_startMin)<0){
				$MM=intval($T_endMin)+60-intval($T_startMin);	
				$T_endHour=intval($T_endHour)-1;	
			}else{
				$MM=intval($T_endMin)-intval($T_startMin);
			}		
		}else{
			$T_endMin=intval($T_endMin)-1;
			if(intval($T_endMin)-intval($T_startMin)<0){
				$MM=intval($T_endMin)+60-intval($T_startMin);	
				$T_endHour=intval($T_endHour)-1;	
			}else{
				$MM=intval($T_endMin)-intval($T_startMin);
			}
		}
		
	}else{
		$SS=intval($T_endSec)-intval($T_startSec);
		if(intval($T_endMin)-intval($T_startMin)<0){
			$MM=intval($T_endMin)+60-intval($T_startMin);
			$T_endHour=intval($T_endHour)-1;		
		}else{
			$MM=intval($T_endMin)-intval($T_startMin);
		}
	}
	$HH=intval($T_endHour)-intval($T_startHour);
	$HH=strval($HH);
	$MM=strval($MM);
	$SS=strval($SS);	
	if(intval($HH)<10){
		$HH="0".$HH;
	}
	if(intval($MM)<10){
		$MM="0".$MM;
	}
	if(intval($SS)<10){
		$SS="0".$SS;
	}
	$time_dur=$HH.":".$MM.":".$SS;
}
//模糊效果参数
$mohu_value_r=$_POST['mohu_value_r'];
$mohu_value_s=$_POST['mohu_value_s'];
$mohu_value_t=$_POST['mohu_value_t'];
//判断效果
if($vstyle=="reverse"){
$deal_signal="_daoying";
$ch_vstyle="倒影效果";
}elseif($vstyle=="heibai"){
$deal_signal="_heibai";
$ch_vstyle="黑白色调";
}elseif($vstyle=="mohu"){
$deal_signal="_mohu";
$ch_vstyle="模糊效果";
}elseif($vstyle=="fanxiang"){
$deal_signal="_fanxiang";
$ch_vstyle="反相";
}elseif($vstyle=="fugu"){
$deal_signal="_fugu";
$ch_vstyle="复古";
}else{

}
$query = "SELECT * FROM video where `record_video`='$vname'";
$result = mysql_query($query);
$row = mysql_fetch_row($result);
$camera1=$row[6];
$camera2=$row[7];
$videoId=$row[0];
if($camera1!=""&&$camera2==""){
	$ID=$videoId.'v1';
}else{
	$ID=$videoId.'v2';
}
$sql= "UPDATE `video` SET `color_treat_mark` = '*' WHERE `id` ='$videoId'";
	if (!mysql_query($sql)) {
		die('Could not update data' . mysql_error());
	}
//局部处理
if($time_start!="" && $time_end!=""){
exec("/usr/bin/sudo /var/www/ffmpeg/ffmpeg/colorVideoPart.sh $ID $vstyle $time_start $time_end $time_dur $deal_signal $mohu_value_r $mohu_value_s $mohu_value_t  > /dev/null & ",$output,$return);
}else{
exec("/usr/bin/sudo /var/www/ffmpeg/ffmpeg/colorVideoAll.sh $ID $vstyle $deal_signal $mohu_value_r $mohu_value_s $mohu_value_t > /dev/null & ",$output,$return);
}

?>
</br></br>
		<p style="font-size:18px">
		  正在处理的视频：<?php echo $vname;?>
		</p></br>
		<p style="font-size:18px">
		  视频风格：<?php echo $ch_vstyle;?>
		</p>

	<a id="authButton" class="btn btn-success btn-lg" style="margin-top:50px;width:112px"><img src="img/loading.gif" width="15" style="margin-right:5px;" />正在处理<span id="dealpoint"></span></a>
</div>
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript">
jQuery(function($){
	var Timer = setInterval(function(){
		$.post(
			'file_exist_colorvideo.php',
			{
				'fileName': "<?php echo $ID.$deal_signal.'.mp4'; ?>"
			},
			function (data) {
				if (data == 1) {		
					clearInterval(Timer);
					alert("视频处理完成，您可下载观看！");
//--------------------------------进度100%时改变页面元素----start--------------------------
					$("#authButton").removeClass('btn-danger')
										.addClass('btn-success').html('下载观看')
										.attr('href', 'fdowncolor.php?name=' + "<?php echo $ID.$deal_signal;?>");
						
						
					$('<a style="margin-top:50px;margin-left:100px;color:#000000"/>').addClass("btn")
									.attr('href', 'dealVideo.php').text('返回')
									.appendTo(".authBody");
				}				
			}
		)
	},3000);
});
</script>
<script>
window.onload=outtimer();
function outtimer(){
var dealPoint=document.getElementById("dealpoint");
var count=0;
var innerTimer=setInterval(function(){
		dealPoint.innerHTML+=".";
		count++;
		if(count>4){
			clearInterval(innerTimer);
			dealPoint.innerHTML="";
			outtimer();
		}		

	},1000);
}
</script>
<?php include "lib/footer.php"; ?>
