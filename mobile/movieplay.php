<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<META http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8">
<META name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<META name="apple-mobile-web-app-capable" content="yes">
<META name="apple-mobile-web-app-status-bar-style" content="black">
<META name="format-detection" content="telephone=no">
<LINK href="./css/common.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/movieDetail.css" />
<script type="text/javascript" src="images/js/jquery.1.4.2-min.js"></script>

<TITLE>Video Player</TITLE>
<style>
body {
	background-color:#EAEAEA;
	margin:0 auto;
	background-repeat: repeat;
	background-position: middle top;
	font-family:"microsoft yahei";
	font-size:1.2em;
}
</style>
</head>

<body>
<div style="width:100%;height:95px;margin-bottom:6px;background-image:url('./img/banner2.png');">
<div style="width:100px;height:90px;color:white;line-height:90px;float:right;margin-right:20%">视频播放</div>
</div>

 <?php 
    require('config/portalConfig.php');//手机门户配置文件
    session_start();
    $id = $_GET['id'];
    
    //检查该页面是否已合法获取视频ID及ID是否为数值型
    if (!(isset($_GET['id']) && ctype_digit($_GET['id']))) {
      header("Location:movie.php?msg=invalid");
      exit;
    }
    
    require "lib/connect.php";
    
    function sec2time($sec){  
      $sec1 = round($sec/60);
      if ($sec1 >= 60){
        $hour = floor($sec/60);
        $min = $sec1%60;
        $res = $hour.'小时';
        $min != 0  &&  $res .= $min.'分';
      }else{
        $res = $sec.'秒';
      }
      return $res;
      }
      
    $sql="select * from video_send WHERE `id` = $id";
    $result=mysql_query($sql);
    $row=mysql_fetch_object($result);
  ?>

<div id="layout">
     <div style="margin:0 auto;width:100%">
        <video width="100%" height="100%" controls id="video">
          <?php 
          $file = $config['video'].$row->id.".mp4";

          echo $file;
  
          if(file_exists($file)){
            $videoUrl = $file;
            echo $videoUrl."存在";
     
          }
          else{
            $videoUrl = $config['videoRoot'].$config['video']."0.mp4";
            }
        ?>
        <source src="<?php echo $videoUrl;?>" type="video/mp4">
        <p>抱歉，您的浏览器不支持视频video标签</p>             
         <embed
          width="90%"
          type="application/x-shockwave-flash"
          id="player2"
          name="player2"
          src="swf/player.swf" 
          allowscriptaccess="always" 
          allowfullscreen="true"
          flashvars="file=<?php echo  $videoUrl;?>&image=<?php # ?>" 
        />
      </video>
          
<?php 
    $sec = $row->time;
    $min = sec2time($sec);
  ?>
    </div> 
</div>
    <div class="movieDetail2" style="width:100%;height:20px;margin-bottom:10px">
        <p style="float:left;color:red;height:90%">视频信息</p></br>
        <p style="height:90%"><span style="width:35%">名称：<?php echo $row->title;?></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="width:35%">片长：<?php echo $min;?></span></p>
   </div>
          
  <div style="width:100%;height:70px;margin-top:25px;background-image:url('./img/footer.png');background-repeat :repeat-x">
   
  </div>
</body>
</html>
