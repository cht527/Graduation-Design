<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=yes" />     
<meta name="apple-mobile-web-app-capable" content="yes" />    
<meta name="format-detection" content="telephone=no" />   
<?php date_default_timezone_set("Asia/Shanghai");?>
<link rel="stylesheet" type="text/css" href="css/base.css" />
<link type="text/css" href="css/bootstrap.min.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
<title>视频生成与处理平台</title>
<?php include 'lib/header.php'; ?>
<div id="header" class="uptop" style="width:800px;margin:20px auto;">
	<img style="height:240px;width:750px" src="img/logo_2.jpg" alt=""/>
</div>

<div style="height:680px;width:700px;font-size:16px" class="authBody">
	<div class="tab-content" style="height:650px">
		<div class="tab-pane active" id="tab-color">
			<h3>实时监控画面</h3>
<hr style="width:80%;margin:0px auto 50px"/>
			<div style="width:400px;height:260px;background-color:black;margin:10px auto;-webkit-box-shadow:0 0 8px 8px #292929; -moz-box-shadow:0px 0px 8px 8px #292929; box-shadow:0px 0px 8px 8px #292929;">
			<iframe src="http://222.31.64.129:8081" frameborder="0" scrolling="no" height="240" width="320" style="margin-top:10px"> 
    			</iframe> </br>
			</div>
			<div>
				<img src="./img/tvbottom.png"/>
			</div>
			<div style="width:300px;height:150px;background-color:#969696;margin:20px auto;-webkit-box-shadow:0 0 8px 8px #2C2C2C; -moz-box-shadow:0px 0px 8px 8px #2C2C2C; box-shadow:0px 0px 8px 8px #2C2C2C;">
			<div style="float:left;height:150px;width:15%"><img src="./img/kongzhitai.png" style="height:80%;width:100%;margin-left:5px;margin-top:10px" /></div>
			<iframe src="http://222.31.64.129:8080" frameborder="0" scrolling="no" height="150" width="80%" style="float:right"> 
    			</iframe>
			</div>
			<a type="button" class="btn btn-default" href='main.php' style="margin-right:30px;color:black;float:right" >返回</a>
		</div>	
	</div>

</div>


<?php include "lib/footer.php"; ?>
