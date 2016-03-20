<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=yes" />     
<meta name="apple-mobile-web-app-capable" content="yes" />    
<meta name="format-detection" content="telephone=no" />   
<?php date_default_timezone_set("Asia/Shanghai");?>
<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/base.css" />
<link type="text/css" href="css/jquery-ui-1.8.17.custom.css" rel="stylesheet" />
    <link type="text/css" href="css/jquery-ui-timepicker-addon.css" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
    <script type="text/javascript" src="js/jquery-ui-timepicker-zh-CN.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
 <script type="text/javascript">
    $(function () {
        $(".ui_timepicker").datetimepicker({
            showSecond: true,
            timeFormat: 'hh:mm:ss',
            stepHour: 1,
            stepMinute: 1,
            stepSecond: 1
        })
    })
    </script>
<title>视频生成与处理平台</title>
<?php include 'lib/header.php'; ?>
<style type="text/css">
	#authForm {
		margin-top: 50px;
	}
	#authForm p {
		font-family:simsun;

	}
	#ui-datepicker-div .ui-datepicker-title select {
		width: 42%;
	}
	form label{
  		margin-right: 10px;
	}
</style>
<div id="header" class="uptop" style="width:800px;margin:0 auto;">
	<img style="height:240px;width:700px" src="img/logo_1.jpg" alt=""/>
</div>
<div style="height:450px;width:680px;font-size:16px" class="authBody">
	<h1 style="font-family:simsun;">视频录制</h1>
	<form id="recordform" action="record.php" method="post" enctype="multipart/form-data">
		<p style="margin-top:30px">
		        请选择摄像头：
  			<select id="select">
			<option value="blank" selected="selected"></option>
   			<option value="one">1号摄像头录制</option>
   			<option value="two">2号摄像头录制</option>
   			<option value="both">双摄像头联动录制</option>
  			</select>
		 </p>
		<p style="margin-left:115px">
		<input class="input-xlarge focused" id="video_1" type="text" name="name1" style="display:none" placeholder="1号摄像头录制的视频名称">		
		</p>
		<p style="margin-left:115px">
 		<input class="input-xlarge focused" id="video_2" type="text" name="name2" style="display:none" placeholder="2号摄像头录制的视频名称"/>		
		</p>
		<p id="recordStyle" style="margin-bottom:15px">选择录制方式：
<input type="radio" name="recordStyle" id="manual" value="manual">&nbsp;手动
<input style="margin-left:115px" type="radio" name="recordStyle" id="auto" value="auto">&nbsp;自动
		</p>

		<p>输入录制时长:&nbsp;&nbsp;
		<input class="input-xlarge focused" id="recordDur" type="text" name="recordDur" placeholder="输入录制时长（秒）">
		</p>

		<p id="set_date" style="display:none" >设置录制时间：
		<input type="text" name="datetime" class="ui_timepicker" value="">
		</p>

		<p style="margin-top:20px">
	<input id="settime" type="button" value='完成设置' class="btn btn-primary" style="display:none">	
	<input id="record" type="submit" value='录制'  name="submit" class="btn btn-primary" style="margin-left:20px;"> 
	<a  href="monitor.php" type="button" id="monitor" class="btn btn-primary" target='_self' style="margin-left:85px" >监控室</a>
	<a  href="dealVideo.php" type="button" class="btn btn-success" target='_self' style="margin-left:20px" >处理视频</a>
		</p>
	   
	</form>	
</div>

<script type="text/javascript">//----------摄像头选择---start-----------------------
$(document).ready(function(){
 	$("#select").change(function(){
    	p=$("#select option:selected").val();			
    	if(p=='one'){
	    	$("#video_1").show();
	    	$("#video_2").hide(); 
    	}else if(p=='two'){
	    	$("#video_1").hide(); 
	    	$("#video_2").show(); 
    	}else if(p=='both'){
	    	$("#video_1").show();
	    	$("#video_2").show();
    	}else{
	    	$("#video_1").hide();
	    	$("#video_2").hide();
    	}
	});
});		//--------------------------end----------------------------------
</script>
<script type="text/javascript">//-------------录制方式选择--start----------------------
	$("#recordStyle").change(function(){
	         radioValue=$("input[name='recordStyle']:checked").val();
		 if(radioValue=="auto"){
			$("#set_date").show();
			$("#settime").show();
			$("#monitor").css("margin-left","20px")
		 }else if(radioValue=="manual"){
			$("#set_date").hide();
			$("#settime").hide();
			$("#monitor").css("margin-left","85px")
		 }else{
			alert("选择错误！");
		 }
	})	//---------------------------end----------------------------
</script>
<script>
$("#settime").click(function(){
	var str=$(".ui_timepicker").val();
	str = str.replace(/-/g,'/')
	var dt=new Date(str);
	var time = dt.getTime();

	var dt1=new Date();
	var dt2=dt1.getTime();
	var delayTime=setTimeout(function(){
		var dealytime=setTimeout(function(){
			$("#record").trigger("click");
		},1000);
	},dt-dt2);

})	
</script>	
<!--<script type="text/javascript">//---------------计时--start--------------------
function countTime(){
	var HH = 0;
	var mm = 0;
	var ss = 0;
	var str = '';
	var timer = setInterval(function(){
		str = "";
		if(++ss==60)
		{
			if(++mm==60)
			{
				HH++;
				mm=0;
			}
			ss=0;
		}
		str+=HH<10?"0"+HH:HH;
		str+=":";
		str+=mm<10?"0"+mm:mm;
		str+=":";
		str+=ss<10?"0"+ss:ss;
		document.getElementById("time").value = str;
	},1000);
	}; 	//-----------------------------end----------------------------
</script>-->
	
<div id="myModal" class="modal hide fade" aria-lableledby="myModalLabel" aria-hidden="true" style="width:400px;margin-left:-210px;">
  <div class="modal-body">
    <p align="center" style="font-family:微软雅黑; font-size:25px; margin-top:50px; margin-bottom:30px;">正在录制...<img src="img/loading.gif" /></p>   
  </div>
</div>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript">//----------------将表单视频名称传递到录制页面-----
/*var name1="";
var name2="";
$("#video_1").blur(function(){
	name1=$("#video_1").val();
});
$("#video_2").blur(function(){
	name2=$("#video_2").val();
});*/				//------------------------end---------------
$(function() {
	$("#recordform").submit(function() {
	if(($("input[name='name1']").val() == "")&&($("input[name='name2']").val() == ""))
	   {
	    alert("请输入名称！");
	    return false;
	   }
	  else{
		if($("#recordDur").val()==""){
			alert("请输入录制时长！");
		}else{
			$("#myModal").modal()
	    		return true;
		}

	    }
	  });
	})
</script>
<?php include "lib/footer.php"; ?>
