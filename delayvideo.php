<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link href="css/redmond/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/base.css" />
<title>视频处理平台</title>
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
	text-align: center;
}
.authBody h1 {
	font-family:Microsoft YaHei;
	text-align:center;
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
<body><style type="text/css">
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
<div id="header" style="width:800px;margin:0 auto;">
	<img style="width:710px;height:240px;margin-left:0px;" src="img/logo_3.jpg" />
</div>
<div style="height:400px;width:600px;margin-top:10px;" class="authBody">
	<h1 style="font-family:simsun;">视频下载与推送</h1>
	<hr style="width:80%;margin:20px auto" />		
<?php
	//date_default_timezone_set('Asia/Shanghai');
	include "lib/connect.php";
	$formPostData = array(
		'videoName'	=>	$_POST['v_name'],
		'videoHz'	=>	$_POST['Hz'],
		'delayType'     =>      $_POST['delaytype']
	);
	$videoHz=$formPostData['videoHz'];//抽帧频率
	$vname=$formPostData['videoName'];//选择的处理视频名称
	$delay=$formPostData['delayType'];
	//$treat_dt=date('Y-m-d H:i:s');//数据库里插入处理视频时的时间
	$v_time=time();//重定向到txt文件名称的后缀，用时间戳防止txt重名
	
	$query = "SELECT * FROM `video` WHERE `record_video`='{$formPostData['videoName']}'";
	$result = mysql_query($query);
	$row    = mysql_fetch_row($result);
	$videoId = $row[0];
	$camera1Status=$row[6];
	$camera2Status=$row[7];	
	$vId="";
	if($camera1Status=='*'){
		$vId=$videoId.'v1';//视频命名方式:Id+对应摄像头符号
	}
	if($camera2Status=='*'){
		$vId=$videoId.'v2';
	}
	$vtxtname=$vId.$v_time;
	$sql= "UPDATE `video` SET `delay_treat_mark` = '*' WHERE `id` ='$videoId'";
	if (!mysql_query($sql)) {
		die('Could not update data' . mysql_error());
	}

	if($delay=="p"){
		$delaytype="正向延时";
		exec("/usr/bin/sudo /var/www/ffmpeg/ffmpeg/delayP.sh $videoHz $vId $vtxtname  > /dev/null & ",$output,$return);//-  > /dev/null &   -->将shell进程放置后台处理，否则submit之后不会跳转
	}
	if($delay=="n"){
		$delaytype="逆向延时";
		exec("/usr/bin/sudo /var/www/ffmpeg/ffmpeg/delayN1.sh $vId $videoHz",$output,$return);
		$dir="./tmp/";
		$dirtemp="./tmp2/";
		$file=scandir($dir);//读取文件返回文件名数组
		array_splice($file,0,2);//删除2个目录标记，只保存文件名
		$len=count($file)-1;
		for($i=0;$i<=$len;$i++){
			$temp="-1";
			rename($dir.$file[$i],$dirtemp.$file[$len-$i]);//移动、重命名
		}
		exec("/usr/bin/sudo /var/www/ffmpeg/ffmpeg/delayN2.sh $vId $vtxtname > /dev/null & ",$output,$return);
	}
	
?>
</br></br>
		<p style="font-size:18px">
			所选择的视频：<?php echo $vname;?>
		</p>
		<p style="font-size:18px;margin-top:30px">
			视频延时方式：<?php echo $delaytype;?>
		</p>
<!-------------------------------抽帧进度条------begin-------------------------------->

	<div id="ibox" class="progress progress-striped active">
		<div id="iLoading" class="bar">
		</div>
	</div>
<!-------------------------------------end--------------------------------------------->
	<a id="authButton" class="btn btn-danger" style="margin-top:50px;"><img src="img/loading.gif" width="12" style="margin-right:5px;" />正在处理</a>
</div>

<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript">
jQuery(function($){
	var idiv=document.getElementById('iLoading');
	var ibox=document.getElementById('ibox');//获取进度条
	var Timer = setInterval(function(){
		$.post(
			'getTime.php',
			{
				'vIdTime'	: "<?php echo $vId.$v_time;?>"
			},
			function (data) {		
				var patt1 = new RegExp("Traceback");
				if(patt1.test(data)){
					idiv.style.width = 0 + 'px';
					idiv.innerHTML = 0 + "%";
				}else{
					var num = parseInt(data);
						idiv.style.width = num * 3 + 'px';
						idiv.innerHTML =Math.ceil(num) + "%";
						if(num == 100){
							$("#ibox").fadeOut(2000);
							clearInterval(Timer);
							alert("新视频生成成功，您可下载或推送视频！");
//--------------------------------进度100%时改变页面元素----start--------------------------
						$("#authButton").removeClass('btn-danger')
										.addClass('btn-success').html('下载观看')
										.attr('href', 'fdowndelay.php?name=' + "<?php echo $vId;?>");
						
						$('<a style="margin-top:50px;margin-left:50px;"/>').addClass("btn btn-success")
									.attr('id','tuibutton')
									.text('推送视频')
									.appendTo(".authBody");
						$('<a style="margin-top:50px;margin-left:100px;color:#000000"/>').addClass("btn")
									.attr('href', 'dealVideo.php').text('返回')
									.appendTo(".authBody");
							
						}
				}
	
			}
		)
	},3000);
});
</script>
<script>	
var vId="<?php echo $vId;?>";
var vname="<?php echo $vname;?>";
$(document).on("click","#tuibutton",function(){
	$("#tuibutton").html('<img src="img/loading.gif" width="12">正在推送...');
	var p=setTimeout(function(){
 	$.ajax({
                type:'get',
                dataType:'text', 
                url:'./tui.php',
                data:"id="+vId+"&name="+vname,
                success:function(data){
                   	if(data){
				$("#tuibutton").html('推送成功');
				$("#myModal").modal()
	    			return true;		
			}   
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                                alert(XMLHttpRequest.status);
                                alert(XMLHttpRequest.readyState);
                                alert(textStatus);
                            }, 
        });
	},3000);
       
})
</script>
<div id="myModal" class="modal hide fade" aria-lableledby="myModalLabel" aria-hidden="true" style="width:350px;margin-top:-175px;margin-left:-175px">
	<p style="color:green;font-size:18px">推送成功,可扫描二维码查看视频</p>
  <div style="width:100%" class="modal-body" style="display:table-cell;text-align:center;vertical-align:middle">
  <img style="display:block;width:92%;vertical-align:middle" src="img/mobileqrcode.png" />  
  </div>
</div>
<?php include "lib/footer.php"; ?>

