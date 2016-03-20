<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<META http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8">
<META name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<META name="apple-mobile-web-app-capable" content="yes">
<META name="apple-mobile-web-app-status-bar-style" content="black">
<META name="format-detection" content="telephone=no">
<LINK href="./css/common.css" rel="stylesheet" type="text/css">
<link type="text/css" href="css/weishipin.css" rel="stylesheet"/>
<script type="text/javascript" src="images/js/jquery.1.4.2-min.js"></script>
<script  type="text/javascript" src="./js/WeixinApi.js"></script>
<script  type="text/javascript" src="./js/share.js"></script>
<TITLE>移动端播放</TITLE>
<style>
	body {
		background-color:#EAEAEA;
		margin:0 auto;
		background-repeat: repeat;
		background-position: middle top;
	}
 	a {font-size:12px}

	a:link {color:#000000; text-decoration:none;} //未访问：黑色、无下划线 
 	a:active:{color:#000000; } //激活：红色

	a:visited {color:gray;TEXT－DECORATION:   none} //已访问：purple、无下划线 
	ul{list-style-type:none;}
	
</style>
</head>

<body>
  
<table width="100%" border="0" cellspacing="0" cellpadding="0" >
  <tr>
    <td width="87" align="left" valign="top" background="img/bannerbg.jpg"><img src="../img/ffmpeg-logo.jpg" alt="" width="87" height="92" /></td>
    <td width="100%" align="center" valign="middle" background="img/bannerbg.jpg"><table width="95%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" valign="middle" style="font-size:18px;">视频短片播放列表</td>
        </tr>
    </table></td>
    <td width="88" align="right" valign="top" background="img/bannerbg.jpg"><img src="img/banner-r.png" alt="" width="88" height="91" /></td>
  </tr>
  <tr>
    <td colspan="3"  valign="top" style="padding-bottom:10px; padding-top:10px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      
      <tr>
        <td height="2" align="left" background="images/hx.jpg"></td>
      </tr>

       <div>
        <div id="main" align="center">
      <?php
  include "lib/connect.php";
  $page_num =12;//每页记录数为12
        if (!isset($_GET['page_no']))//page_no 空
          {
              $page_no = 1;
          }
        else {
            $page_no = $_GET['page_no'];
        }
          $start_num = $page_num * ($page_no - 1);//起始行号
          $sql = "SELECT * from `video_send` limit $start_num, $page_num";
  //$sql = "SELECT * FROM `video`";
          $result = mysql_query($sql);
          $nums = mysql_num_rows($result); 
  //$nm = mysql_num_rows($result);
  while ($result_row = mysql_fetch_assoc($result)) {
    echo <<<IMG
        <div class="video">
	  <a href="movieplay.php?id={$result_row['id']}" class="font-hui14cu"/>
          <img width="80%" height="5%" src="../img/logo3.jpg">
          </img>
	  </br>
          <span style="margin-left:0px;margin-top:0" name="svideo" value="{$result_row['id']}" />{$result_row['title']}
          
        </div>
IMG;
        }
      ?>
    </div>
    </div>

      <tr>
        <td align="center" valign="middle"><table width="50%" border="0" cellpadding="0" cellspacing="0">

<form name="form1" method="post" action="movie.php?page_no=<?php echo $_POST[page];?>">
    <br>
<span >
        <?php
		$sql1 = "SELECT * from `video_send`";
		$result1 = mysql_query($sql1);
		$numss = mysql_num_rows($result1);
		$page = ceil($numss/$page_num);
            if ($page_no >= 1) {
		    echo "&nbsp;&nbsp;<a href ='index.php?page_no= 1'>首页</a>";}
		if($page_no > 1){
                    echo "&nbsp;&nbsp;<a href ='index.php?page_no=".($page_no-1)."'>上一页</a>&nbsp;&nbsp;&nbsp;";
                }else{
                    echo '<span>上一页</span>&nbsp;&nbsp;&nbsp;';
                }
                echo '<strong>第'.$page_no.'页/共'.$page.'页</strong>';
                if ($nums == $page_num) {
	            
                    echo "&nbsp;&nbsp;&nbsp;<a href ='index.php?page_no=".($page_no+1)."' >下一页</a>";
		    echo "&nbsp;&nbsp;<a href ='index.php?page_no= ".$page."'>尾页</a>";
                }else{
                    echo '&nbsp;&nbsp;&nbsp;<span>下一页</span>';
		    
                }

        ?>
</br></br>
</form>
    </span>    
        
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="87" colspan="3" align="center" valign="middle" background="img/footbg.jpg"><table width="95%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" valign="middle"><a href="index.php" /><img src="img/sy.png" alt="" width="53" height="45" /></td>
      </tr>
      <tr>
        <td height="25" align="center" valign="middle"><a href="index.php" /><span class="font-bai18">首页</span></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
