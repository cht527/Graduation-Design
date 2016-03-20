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
$vformat=$_POST['format'];
$vformat_name=".".$vformat;
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
$sql= "UPDATE `video` SET `format_treat_mark` = '*' WHERE `id` ='$videoId'";
	if (!mysql_query($sql)) {
		die('Could not update data' . mysql_error());
	}
exec("/usr/bin/sudo /var/www/ffmpeg/ffmpeg/transcoding.sh $ID $vformat_name > /dev/null & ",$output,$return);
?>
</br></br>
		<p style="font-size:18px">
		  正在转码的视频：<?php echo $vname;?>
		</p></br>
		<p style="font-size:18px">
		  转码格式：<?php echo $vformat;?>
		</p>

	<a id="authButton" class="btn btn-danger" style="margin-top:50px;"><img src="img/loading.gif" width="12" style="margin-right:5px;" />正在转码...</a>
</div>
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript">
jQuery(function($){
	var Timer1 = setInterval(function(){
		$.post(
			'file_exist.php',
			{
				'fileName': "<?php echo $ID.$vformat_name; ?>"
			},
			function (data) {
				if (data!="") {
					clearInterval(Timer1);
					setTimeout(function () {
						alert("视频转码成功，您可下载视频");
						$("#authButton").removeClass('btn-danger')
										.addClass('btn-success').html('下载观看')
										.attr('href', 'fdowntranscode.php?ID=' + "<?php echo $ID;?>"+'&format='+"<?php echo $vformat;?>");
						$('<a style="margin-top:50px;margin-left:50px;"/>').addClass("btn btn-success")
									
						$('<a style="margin-top:50px;margin-left:100px;color:#000000"/>').addClass("btn")
									.attr('href', 'dealVideo.php').text('返回')
									.appendTo(".authBody");
					}, 3000);				
				};
			}
		);
	}, 10000);
});
</script>
<?php include "lib/footer.php"; ?>
