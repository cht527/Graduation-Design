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
<link type="text/css" href="css/upload_flyvideo.css" rel="stylesheet" />
<link type="text/css" href="css/bootstrap.min.css" rel="stylesheet" />
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<title>视频处理平台</title>
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
	.content{
	 width:90%;
	  margin:20px auto 40px;
	  border:1px solid white;
	 -moz-border-radius: 15px; /* Firefox */
  -webkit-border-radius: 15px; /* Safari 和 Chrome */
  border-radius: 15px; /* Opera 10.5+, 以及使用了IE-CSS3的IE浏览器 */
	}
	.f_lex{
	  display: -webkit-flex;
	  display: -ms-flex;
	   display: -moz-flex;	
	  display: flex;
	  flex-flow: row;
	  align-items: center;
	  justify-content:center;
	  margin:20px auto;
	}

</style>
<div id="header" class="uptop" style="width:800px;margin:20px auto;">
	<img style="height:240px;width:700px" src="img/logo_3.jpg" alt=""/>
</div>

<div style="height:780px;width:680px;font-size:16px" class="authBody" id="authBody">
	
	<ul class="nav nav-pills nav-justified" style="margin:10px auto;padding-top:20px;width:80%;">
	   <li class="active" style="padding:0 5px"><a href="#tab-change_format" id="format_" data-toggle="tab" role="tab">视频格式转换</a></li>
	   <li style="padding:0 5px"><a href="#tab-delay" id="delay_" data-toggle="tab" role="tab">延时摄影效果</a></li>
	   <li style="padding:0 5px"><a href="#tab-color" id="color_" data-toggle="tab" role="tab">视频艺术美化</a></li>
	   <li style="padding:0 5px"><a href="#tab-fly" id="fly_" data-toggle="tab" role="tab">航拍视频处理</a></li>
	</ul>
<hr style="width:80%;margin:0px auto 40px"/>
	
	<div class="tab-content" id="tab-content" style="height:650px">
	<?php
		include "lib/connect.php";
		error_reporting(E_ALL & ~E_NOTICE); 
		$svideo = $_POST['svideo'];
		$reply=$_POST['reply'];
		$videoname="";
		$sql= "SELECT `record_video` FROM `video` where `id`='$svideo'";
		$result = mysql_query($sql);
		$result_row = mysql_fetch_row($result);
		$videoname = $result_row[0];
		
	?>
<script>
var reply="<?php echo $reply;?>";
	switch(reply)
	{
	case "1":
	     setTimeout(function(){
		$("#format_").trigger("click");
		},200);
	  break;
	case "2":
	   setTimeout(function(){
		$("#delay_").trigger("click");
		},200);
	  break;
	case "3":
	   setTimeout(function(){
		$("#color_").trigger("click");
		},200);
	  break;
	case "4":
	   setTimeout(function(){
		$("#fly_").trigger("click");
		},200);
	  break;
	default:
	  
	}
</script>
<!---------------------------------------------------------------------------->
	<div class="tab-pane active" id="tab-change_format">
		<form action="transcoding.php" method="post" enctype="multipart/form-data">		
			<input type="text"  name="v_name" placeholder="视频名称" value="<?php echo $videoname;?>" />&nbsp;&nbsp;<a type="button" class="btn btn-primary" href='play.php?mark=1' target='_self' style="margin-top:-10px">选择视频</a>&nbsp;&nbsp;<a type="button" class="btn btn-default" href='main.php' style="margin-top:-10px;color:black" >返回</a>
		        <br>
			<h3>选择转换格式</h3>
			<div class="content">
			   <div class="f_lex">
			      <div style="width:120px">
				<img src="./img/mkv.png" alt="mkv.png" /> 
				<div class="v_format"><input type="radio" name="format" value="mkv"/><spn>mkv</span></div>
			      </div>
			      <div style="width:120px">
 				<img src="./img/mp4.png" alt="mp4.png" /> 
				<div class="v_format"><input type="radio" name="format" value="mp4" /><span>mp4</span></div>
			      </div> 
			      <div style="width:120px">
 				<img src="./img/mov.png" alt="mov.png" /> 
				<div class="v_format"><input type="radio" name="format" value="mov" /><span>mov</span></div>
			      </div> 
			       <div style="width:120px">
 				<img src="./img/avi.png" alt="avi.png" /> 
				<div class="v_format"><input type="radio" name="format" value="avi" /><span>avi</span></div>
			      </div> 
			  </div>
			 <div class="f_lex">
			      <div style="width:120px">
				<img src="./img/wmv.png" alt="wmv.png" /> 
				<div class="v_format"><input type="radio" name="format" value="wmv" /><spn>wmv</span></div>
			      </div>
			      <div style="width:120px">
 				<img src="./img/mpg.png" alt="mpg.png" /> 
				<div class="v_format"><input type="radio" name="format" value="mpg" /><span>mpg</span></div>
			      </div> 
			      <div style="width:120px">
 				<img src="./img/rmvb.png" alt="rmvb.png" /> 
				<div class="v_format"><input type="radio" name="format" value="rm" /><span>rm</span></div>
			      </div> 
			       <div style="width:120px">
 				<img src="./img/vob.png" alt="vob.png" /> 
				<div class="v_format"><input type="radio" name="format" value="vob" /><span>vob</span></div>
			      </div> 

			  </div>
			</div>
		<input type="submit" id="transcode" class="btn btn-success" style="margin:0 auto" value="点击转换" />
</form>
</div>
	          
<!---------------------------------------------------------------------------->
		<div class="tab-pane" id="tab-delay">
		  <form action="delayvideo.php" method="post" enctype="multipart/form-data">			
			<input type="text" name="v_name" placeholder="视频名称" value="<?php echo $videoname;?>" />&nbsp;&nbsp;<a type="button" class="btn btn-primary" href='play.php?mark=2' target='_self' style="margin-top:-10px">选择视频</a>&nbsp;&nbsp;<a type="button" class="btn btn-default" href='main.php' style="margin-top:-10px;color:black" >返回</a>
		        <br>
			<div class="content">
			<p style="margin-top:30px">输入抽帧频率：<input type="text" name="Hz" id="fHz" placeholder="输入1-25之间的数字" />
			<p style="margin-top:30px">选择延时方式：
			<input type="radio" name="delaytype" value="p" /><span style="display:inline-block;margin-right:60px">正向快进</span>
			<input type="radio" name="delaytype" value="n" /><span>逆向回放</span>&nbsp;&nbsp;<span id="checktype" style="color:red;display:none">未选择延时方式</span>
			</p>
			
		<div style="margin:40px auto"><input type="submit" id="delay" class="btn btn-success" style="margin:0 auto" value="点击处理" /></div>
			</div>
		</form>
		</div>
<script>
$("#delay").click(function(){
 var checktype = document.getElementsByName("delaytype");
 for(var i=0;i<checktype.length;i++){
  if(checktype[i].checked==true){
	$("#checktype").css("display","none");
	$("#transcode").attr("disabled","disabled");
   return true;
  }
 }
 $("#checktype").css("display","inline");
 $("#transcode").attr("disabled", "");
 return false;
});
</script>
<!---------------------------------------------------------------------------->
		<div class="tab-pane" id="tab-color">
			<form id="color_form" action="colorVideo.php" method="post" enctype="multipart/form-data">			
			<input type="text" name="v_name" placeholder="视频名称" value="<?php echo $videoname;?>" />&nbsp;&nbsp;<a type="button" class="btn btn-primary" href='play.php?mark=3' target='_self' style="margin-top:-10px">选择视频</a>&nbsp;&nbsp;<a type="button" class="btn btn-default" href='main.php' style="margin-top:-10px;color:black" >返回</a>
		        <br>
			<h3>选择处理模式</h3>
		<div class="content">
			<div class="f_lex"> 

			<div style="width:120px">
				<img src="./img/daoying.png" alt="daoying.png" /> 
				<div class="v_color"><br><input type="radio" id="daoying" name="videoStyle" value="reverse"/><span>倒影</span></div>

			</div>
			
			<div style="width:120px">
				<img src="./img/heibai.png" alt="heibai.png" /> 
				<div class="v_color"><br><input type="radio" id="heibai" name="videoStyle" value="heibai"/><span>黑白色调</span></div>
			</div>
			
			<div style="width:120px">
				<img src="./img/mohu.png" alt="mohu.png" /> 
				<div class="v_color"><br><input type="radio" id="mohu" name="videoStyle" value="mohu"/><span>模糊</span></div>
			</div>

			<div style="width:120px">
				<img src="./img/fanxiang.png" alt="fangxiang.png" /> 
				<div class="v_color"><br><input type="radio" id="fanxiang" name="videoStyle" value="fanxiang"/><span>反相</span></div>
			</div>	

			<div style="width:120px">
				<img src="./img/fugu.png" alt="fugu.png" /> 
				<div class="v_color"><br><input type="radio" id="fugu" name="videoStyle" value="fugu"/><span>复古</span></div>
			</div>			

			</div>
		</div>	
		<h5 style="width:200px;margin-top:-10px">设置处理区间</h5>
		<div class="f_lex" style="width:90%;height:100px;border:1px solid white;border-radius:12px; justify-content:space-around;">
			<div>
			<span style="width:30%;height:14px;color:white">开始时间</span><br>
			<input type="text" id="time_start" name="time_start" placeholder="00:00:00" style="width:70px;height:15px" /><br>
			<img src="./img/bo.png" />
			</div>
			<div>
			<img src="./img/bo2.png" />			
			</div>
			<div>
			<span style="width:30%;height:14px;color:white">结束时间</span><br>
			<input type="text" id="time_end" name="time_end" placeholder="00:00:00" style="width:70px;height:15px" /><br>
			<img src="./img/bo.png" />			
			</div>
		</div>
		<!------------------------------>
		<div id="mohu_set" style="width:300px;height:170px;display:none;margin:0 auto;id">
			<h4 style="margin:20px auto">设置模糊处理参数</h4>
			<p style="width:100%;height:40px">
			<input id="mohu_valueset_r" type="range" min="0.1" max="5" step="0.1" style="width:150px; height:20px; float:left" >
			<input type="text" name="mohu_value_r" id="mohu_value_r" style="width:25px;height:12px;float:right;">
			<span style="float:right;width:90px">模糊半径：&nbsp;</span>
			</p>
			<p style="width:100%;height:40px">
			<input id="mohu_valueset_s" type="range" min="-1" max="1" step="0.1" style="width:150px; height:20px; float:left" >
			<input type="text" name="mohu_value_s" id="mohu_value_s" style="width:25px;height:12px;float:right;">
			<span style="float:right;width:90px">模糊强度：&nbsp;</span>
			</p>
			<p style="width:100%;height:40px">
			<input id="mohu_valueset_t" type="range" min="-30" max="30" step="1" style="width:150px; height:20px; float:left" >
			<input type="text" name="mohu_value_t" id="mohu_value_t" style="width:25px;height:12px;float:right;">
			<span style="float:right;width:90px">阈值：&nbsp;</span>
			</p>
		</div>
		<!------------------------------>
		<input type="submit"  style="margin-top:20px" class="btn btn-primary" value="点击处理" id="deal" />
</form>
</div>	
<script>
	function getId(id){
		return document.getElementById(id);
	}
	getId("mohu").onclick=function(){
		if(this.checked==true){
			//getId("mohu_set").style.display="block";
			$("#mohu_set").slideDown();
			getId("tab-content").style.height=730+'px';
			getId("authBody").style.height=860+'px';
		}
	}
	getId("daoying").onclick=function(){
		if(this.checked==true){
			//getId("mohu_set").style.display="none";
			$("#mohu_set").slideUp();
			getId("tab-content").style.height=650+'px';
			getId("authBody").style.height=780+'px';
		}
	}
	getId("heibai").onclick=function(){
		if(this.checked==true){
			//getId("mohu_set").style.display="none";
			$("#mohu_set").slideUp();
			getId("tab-content").style.height=650+'px';
			getId("authBody").style.height=780+'px';
		}
	}
	getId("fanxiang").onclick=function(){
		if(this.checked==true){
			//getId("mohu_set").style.display="none";
			$("#mohu_set").slideUp();
			getId("tab-content").style.height=650+'px';
			getId("authBody").style.height=780+'px';
		}
	}
	getId("fugu").onclick=function(){
		if(this.checked==true){
			//getId("mohu_set").style.display="none";
			$("#mohu_set").slideUp();
			getId("tab-content").style.height=650+'px';
			getId("authBody").style.height=780+'px';
		}
	}
	getId("mohu_valueset_r").onchange=function(){
		getId("mohu_value_r").value=this.value;
	}
	getId("mohu_valueset_s").onchange=function(){
		getId("mohu_value_s").value=this.value;
	}
	getId("mohu_valueset_t").onchange=function(){
		getId("mohu_value_t").value=this.value;
	}
		
</script>		
<!---------------------------------------------------------------------------->
<div class="tab-pane" id="tab-fly">
	<div class="col-md-7">
		<div class="well" style="width:500px;margin:auto">
    			<form id="fileForm" enctype="multipart/form-data" method="post" action="upload.php">
				<div class="uploader blue">
				<input type="text" class="filename" placeholder="No file selected..." style="height:33px;padding:0px;margin-bottom:0px" readonly="readonly"/>
				<input type="button" name="file" class="button" value="选择文件"/>
				<input type="file" size="30" id="fileToUpload" multiple="" onchange="fileSelected()"/>
				</div>
				<div class="well" id="upinfo">
				<div id="fileName"></div>
				<div id="fileSize" style="margin-top:5px"></div>
				</div>
			<p></p>
			<div id="progress_id" class="progress progress-striped" style="width: 500px;">
				<div id="progressNumber" class="bar"></div>
			</div>	
			
			<input id="up_load" class="btn btn-primary" type="button" onclick="getToken()" value="上传"> <a id="predeal" style="display:none" class="btn btn-success btn-lg"><img src="img/loading.gif" width="13" style="margin-right:5px;" />视频预处理...</a>	
			</form>
			<!--preview------------->
			<div id="tmp_video" style="margin:10px auto 30px;width:400px;height:225px;display:none;border:1px solid #e3e3e3;border-radius:2px;display:none;box-shadow:8px 8px 8px #888888;-webkit-box-shadow:8px 8px 8px #888888;-moz-box-shadow:8px 8px 8px #888888;">


			</div>

			<form action="" method="post" enctype="multipart/form-data">
			<input type="hidden" id="file_name" name="file_name" />
			<p style="margin-top:30px"><b>选择处理方式：</b>
			<input type="radio" id="addcolor" name="fly_dealtype" value="addcolor" style="margin-left:45px" /><span style="display:inline-block;margin-right:65px">色彩调节</span>
			<input type="radio" id="changespeed" name="fly_dealtype" value="adjustspeed" /><span>视频调速</span>
			</p>
			<!--addcolor set-->
			<div id="addcolor_set" style="width:300px;height:170px;display:none;margin:0 auto;">
			<h4 style="margin:20px auto">设置处理参数</h4>
			<p style="width:100%;height:40px">
			<input id="color_bright" type="range" min="-1" max="1" step="0.1" style="width:150px; height:20px; float:left" >
			<input type="text" name="bright_value" id="bright_value" style="width:25px;height:12px;float:right;">
			<span style="float:right;width:90px">亮度：&nbsp;</span>
			</p>
			<p style="width:100%;height:40px">
			<input id="color_contrast" type="range" min="-2" max="2" step="0.1" style="width:150px; height:20px; float:left" >
			<input type="text" name="contrast_value" id="contrast_value" style="width:25px;height:12px;float:right;">
			<span style="float:right;width:90px">对比度：&nbsp;</span>
			</p>
			<p style="width:100%;height:40px">
			<input id="color_saturation" type="range" min="0" max="3" step="0.1" style="width:150px; height:20px; float:left" >
			<input type="text" name="saturation_value" id="saturation_value" style="width:25px;height:12px;float:right;">
			<span style="float:right;width:90px">饱和度：&nbsp;</span>
			</p>
			</div>
			<!--changespeed set-->
			<p id="changespeed_set" style="width:300px;height:40px;margin:40px auto;display:none">
			<input id="change_speed" type="range" min="1" max="24" step="1" style="width:150px; height:20px; float:left" >
			<input type="text" name="speed_value" id="speed_value" style="width:25px;height:12px;float:right;">
			<span style="float:right;width:90px">调速频率：&nbsp;</span>
			</p>

			<h5 style="width:200px;">设置处理区间</h5>
			<div class="f_lex" style="width:90%;height:100px;border:1px solid #DADADA;border-radius:12px; justify-content:space-around;">
				<div>
					<span style="width:30%;height:14px;color:#363F4E">开始时间</span><br>
					<input type="text" id="fly_time_start" name="fly_time_start" placeholder="00:00:00" style="width:70px;height:15px" /><br>
					<img src="./img/bo.png" />
				</div>
				<div>
					<img src="./img/bo2.png" />			
				</div>
				<div>
					<span style="width:30%;height:14px;color:#363F4E">结束时间</span><br>
					<input type="text" id="fly_time_end" name="fly_time_end" placeholder="00:00:00" style="width:70px;height:15px" /><br>
					<img src="./img/bo.png" />			
				</div>
			</div>
			<input id="deal_flyvideo" class="btn btn-primary" type="button" value="点击处理" />
			<a id="processa" class="btn btn-success" style="display:none"><img id="img" src="./img/loading.gif" width="13" style="margin-right:5px;" />正在处理</a>
			<a id="downfly_video" class="btn btn-success" style="display:none">下载</a>
			<a id="sendvideo" class="btn btn-success" style="display:none">推送视频</a>
			</form>
			
			
		</div>
	</div>
</div>
<script>

$(function(){
	$("input[type=file]").change(function(){
		$(this).parents(".uploader").find(".filename").val($(this).val());
	});
});

function fileSelected() {
		var file = document.getElementById('fileToUpload').files[0]; 
		if (file) {
			var fileSize = 0;
			if(file.size > 1024*1024) //文件小于1M
				fileSize = (Math.round(file.size * 100 / (1024 * 1024)) / 100).toString() + 'MB';
			else
								
				fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + 'KB';	
				document.getElementById('fileName').innerHTML = "视频名称:" +" "+ file.name;
				document.getElementById('fileSize').innerHTML = '视频大小:' +" "+ fileSize;
		} else {
			alert("请选择文件！");
		}
}
	
var range;
function uploadFile(start, end, token){
		var _eof = 0;
			xhr = new XMLHttpRequest(),
			fd = new FormData(),
			file = document.getElementById('fileToUpload').files[0];
			console.log(file);

		var part;
		if(end < file.size) {
			part = blobSlice(file, start, end);
			start = start+range;
			end = end+range;
		} else {
			part = blobSlice(file, start, file.size);
			start = start+range;
			end = file.size;
			_eof = 1;
		}
	
		fd.append("part", part);
		fd.append("partnum", start/range);
		fd.append("token", token);
		fd.append("eof", _eof);
		//fd.append("filename",file.name);
		//fd.append("filesize",file.size);
		/* 事件监听 */
		xhr.upload.addEventListener("progress", function(event) {
			if (event.lengthComputable) {
				var precentComputable;
				if (end < file.size) {
					precentComputable = Math.round((start+event.loaded) * 100 / file.size);
				}else{
					precentComputable = Math.round(file.size * 100 / file.size);
				}				
				document.getElementById('progressNumber').innerHTML = precentComputable + "%";
				$(".bar").css("width", precentComputable+'%');
			} else{
				document.getElementById('progressNumber').innerHTML = "Unable to compute.";
			}
		}, false);
		xhr.addEventListener("load", function() {
			if(start < file.size) {
				uploadFile(start, end, token);	
			} else {
				$("#up_load").hide();
				$("#predeal").show();
	
				//显示播放器------------------------------------
				var Timer = setInterval(function(){
					$.post(
						'file_exist_aerialvideo.php',//判断视频是否存在
						{
						 'token': token
						},
						function (data) {
							if (data==true) {		
								clearInterval(Timer);
								$("#fileForm").fadeOut();
								addElement();
								$("#tmp_video").fadeIn();
								$("#file_name").val(token);
							}
						}
					)
				},3000);
				
				function addElement(){
					var parent=document.getElementById("tmp_video");
	
					var video=document.createElement("video");
					video.setAttribute("id","video");
					video.setAttribute("width","100%");
					video.setAttribute("height","100%");
					parent.appendChild(video);
					document.getElementById("video").controls=true;
		
					var source=document.createElement("source");
					source.setAttribute("id","sourceID");
					source.setAttribute("src","./aerial_video/source_video/"+token+".mp4");
					source.setAttribute("type","video/mp4");
					video.appendChild(source);

					var embed=document.createElement("embed");
					embed.setAttribute("id","player2");
					embed.setAttribute("width","100%");
					embed.setAttribute("type","application/x-shockwave-flash");
					embed.setAttribute("name","player2");
					embed.setAttribute("src","./mobile/swf/player.swf");
					embed.setAttribute("allowscriptaccess","always");
					embed.setAttribute("flashvars","file=./aerial_video/source_video/"+token+".mp4");
					video.appendChild(embed);

					parent.appendChild(video);
				}
				

			}
		}, false);
		xhr.addEventListener("error", uploadFailed, false);
		xhr.open("POST", "upload.php");
		xhr.send(fd);
}
//上传失败事件
function uploadFailed(event) {
	alert("上传失败！");
}

function blobSlice(blob, startByte , length){/*blobSlice(blob对象，起始字节，读取的字节数)*/
        if (blob.slice){
            return blob.slice(startByte, length);
        }
        else {
            return null;
        }
}
	  
function getToken(){
	$.get(
		"token.php", 
		function(data) {
			range = data.range;
			uploadFile(0, data.range, data.token)
		},
		"json"
	)
}

//设置flyideo 参数
window.onload=function(){
	function getIdfly(id){
		return document.getElementById(id);
	}
	getIdfly("addcolor").onclick=function(){
		if(this.checked==true){
			$("#changespeed_set").hide();
			$("#addcolor_set").slideDown();
			getIdfly("authBody").style.height=860+"px";
			getIdfly("tab-content").style.height=745+"px";
			
		}
	}
	getIdfly("changespeed").onclick=function(){
		if(this.checked==true){
			$("#addcolor_set").hide();
			$("#changespeed_set").slideDown();
			getIdfly("authBody").style.height=780+"px";
			getIdfly("tab-content").style.height=670+"px";
		}
	}
	getIdfly("color_saturation").onchange=function(){
		getIdfly("saturation_value").value=this.value
	}
	getIdfly("color_bright").onchange=function(){
		getIdfly("bright_value").value=this.value
	}
	getIdfly("color_contrast").onchange=function(){
		getIdfly("contrast_value").value=this.value
	}
	getIdfly("change_speed").onchange=function(){
		getIdfly("speed_value").value=this.value

	}
	
}
</script>

<script type="text/javascript">
$("#deal_flyvideo").on('click',function(){
	$("#deal_flyvideo").hide();
	$("#processa").show();
		$.ajax({
			type:'get',
			datatye:'text',
			url:'flyVideo_deal.php',
			data:"filetoken="+$("#file_name").val()+"&dealtype="+$("input[name='fly_dealtype']:checked").val()+"&bright="+$("#bright_value").val()+"&contrast="+$("#contrast_value").val()+"&saturation="+$("#saturation_value").val()+"&speed="+$("#speed_value").val()+"&fly_time_start="+$("#fly_time_start").val()+"&fly_time_end="+$("#fly_time_end").val(),
			success:function(data){	
				if (data) {
					console.log(data);	
					var changeName=data.split("_")[0];
					$("#file_name").val(data);			
					var newVideo=$("video").clone();
					var parentDiv=$("#tmp_video");
		
					$("video").remove();					
					newVideo.find("source").attr("src","./aerial_video/tmp_video/"+data+".mp4").next().attr("flashvars","file=./aerial_video/tmp_video/"+data+".mp4").parent().prependTo(parentDiv);
					$("#processa").hide();					
					$("#downfly_video").show().html("下载观看")
						        .attr('href', 'flyvideodown.php?name='+data);
					$("#sendvideo").show();					
					$("#deal_flyvideo").show();
							  	

				}else{
					alert("wrong!");
				}				
			}
		});
});

$("#sendvideo").on('click',function(){
	$("#sendvideo").html('<img id="img" src="./img/loading.gif" width="13" style="margin-right:5px;" />正在推送...');
 		$.ajax({
			type:'get',
			datatye:'text',
			url:'flyVideo_send.php',
                	data:"sendfileName="+$("#file_name").val(),
                	success:function(data){
                   		if(data){
					console.log(data);
					$("#sendvideo").html('推送成功');
					$("#sendModal").modal();
	    				return true;		
				}   
                	},
               });

})
</script>
<div id="sendModal" class="modal hide fade" aria-lableledby="myModalLabel" aria-hidden="true" style="width:350px;margin-top:-175px;margin-left:-175px">
	<p style="color:green;font-size:18px">推送成功,可扫描二维码查看视频</p>
  <div style="width:100%" class="modal-body" style="display:table-cell;text-align:center;vertical-align:middle">
  <img style="display:block;width:92%;vertical-align:middle" src="img/mobileqrcode.png" />  
  </div>
</div>
<!---------------------------------------------------------------------------->
</div>

</div>
<?php include "lib/footer.php"; ?>
