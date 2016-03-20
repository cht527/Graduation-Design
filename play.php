<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/redmond/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/weishipin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<title>视频预览</title>
<link type="text/css" href="cssd/base.css" rel="stylesheet"/>
</head>

<body>
<div id="header">
    <p style="margin-left:0px;margin-top:9px">请选择已录视频进行处理</p>
	</div>
  <form id="videofile" action="dealVideo.php" method="post">
    <div id="menu">
   <button id="queding" name="submit" type="submit" class="btn btn-info" >确定</button>
   <a name="back" type="button" class="btn btn-info" href="dealVideo.php">返回首页</a>
   </div>
	<input id="reply" type="hidden" name="reply" value="" />
<?php 
error_reporting(E_ALL & ~E_NOTICE); 
$mark=$_GET['mark'];
?>
<script>
	var mark="<?php echo $mark;?>";
	switch(mark)
	{
	case "1":
	  $("#reply").val("1");
	  break;
	case "2":
	   $("#reply").val("2");
	  break;
	case "3":
	   $("#reply").val("3");
	  break;
	default:
	  
	}
</script>
<?php
	/*获取选项卡的参照字段START****/
		$field = "video1";
		if (isset($_GET['field'])) {
            $field = $_GET['field'];
        }
	/*获取选项卡的参照字段END*****/
?>
	<div class="navList">
            <ul>
                <?php
		    $fieldArr = array(
                        "video1" => "摄像头1视频库",
                        "video2" => "摄像头2视频库"
		        );
                    foreach ($fieldArr as $key => $value) {
                        $class = "navTitle";
                        if ($key == $field) {
                            $class = "selected";
                        }
                       else {
                            $class = "navTitle";
                        }
                        echo <<<LI
                        <li><a class="$class" href="play.php?field=$key">$value</a></li>
LI;
                    }
                ?>
                </ul>
            </div>
            <!--选项卡结束-->
<hr style="width:100%">
<?php SWITCH($field){
	case "video1":
?>

    <div class="container" align="center">
    	  <div class="row" align="center">
<?php
  include "lib/connect.php";
  $page_num =8;//每页记录数为12
        if (!isset($_GET['page_no']))//page_no 空
          {
              $page_no = 1;
          }
        else {
            $page_no = $_GET['page_no'];
        }
          $start_num = $page_num * ($page_no - 1);//起始行号
          $sql = "SELECT * from `video` where `camera1`='*' order by ID desc limit $start_num, $page_num";
  //$sql = "SELECT * FROM `video`";
          $result = mysql_query($sql);
          $nums = mysql_num_rows($result); 
  //$nm = mysql_num_rows($result);
  while ($result_row = mysql_fetch_assoc($result)) {
    echo <<<VIDEO
        <div class="video">
          <video width="100%" height="168px" controls="controls" poster="./tmpimg/{$result_row['id']}.jpg" preload="none" loop="loop">
            <source src="record/{$result_row['id']}v1.mp4" type="video/mp4" />
            <source src="record/{$result_row['id']}v1.mov" type="video/mov" />
         
	  <embed
          width="90%"
          type="application/x-shockwave-flash"
          id="player2"
          name="player2"
          src="mobile/swf/player.swf" 
          allowscriptaccess="always" 
          allowfullscreen="true"
          flashvars="file=<?php echo  {$result_row['id']}v1.'mp4';?>" 
          />
	 </video>
          <input style="margin-left:16px;margin-top:0px" type="radio" name="svideo" value="{$result_row['id']}" />{$result_row['record_video']}
        </div>
VIDEO;
        }
      ?>

        </div>
  </div>

	<div id="menu1">
	   <!--button id="queding" name="submit" type="submit" class="btn btn-info" >确定</button>-->
  		<span id="jilu1">显示<?php echo $nums; ?>条记录</span>
   		 <span id="jilu2">
		<?php
			$sql = "SELECT * from `video` where `camera1`='*'";
			$result = mysql_query($sql);
			$numss = mysql_num_rows($result);
			$page = ceil($numss/$page_num);
		    if ($page_no > 1) {
		            echo "<a href ='play.php?page_no=".($page_no-1)."'>上一页</a>&nbsp;&nbsp;&nbsp;";
		        }else{
		            echo '<span>上一页</span>&nbsp;&nbsp;&nbsp;';
		        }
		        echo '<strong>第'.$page_no.'页/共'.$page.'页</strong>';
		        if ($nums == $page_num) {
		            echo "&nbsp;&nbsp;&nbsp;<a href ='play.php?page_no=".($page_no+1)."'>下一页</a>";
		        }else{
		            echo '&nbsp;&nbsp;&nbsp;<span>下一页</span>';
		        }
		?>
	    </span>          
	</div>
</form> 

<?php 
    break;
    case "video2":
?>
 <div class="container" align="center">
    	 <div class="row" align="center">
<?php
  include "lib/connect.php";
  $page_num =8;//每页记录数为12
        if (!isset($_GET['page_no']))//page_no 空
          {
              $page_no = 1;
          }
        else {
            $page_no = $_GET['page_no'];
        }
          $start_num = $page_num * ($page_no - 1);//起始行号
          $sql = "SELECT * from `video` where `camera2`='*' order by ID desc limit  $start_num, $page_num";
  //$sql = "SELECT * FROM `video`";
          $result = mysql_query($sql);
          $nums = mysql_num_rows($result); 
  //$nm = mysql_num_rows($result);
  while ($result_row = mysql_fetch_assoc($result)) {
    echo <<<VIDEO
        <div class="video">
          <video width="100%" height="168" controls="controls" poster="./tmpimg/{$result_row['id']}.jpg" preload="none" loop="loop">
            <source src="record/{$result_row['id']}v2.mp4" type="video/mp4" />
            <source src="record/{$result_row['id']}v2.mov" type="video/mov" />
	<embed
          width="90%"
          type="application/x-shockwave-flash"
          id="player2"
          name="player2"
          src="mobile/swf/player.swf" 
          allowscriptaccess="always" 
          allowfullscreen="true"
          flashvars="file=<?php echo  {$result_row['id']}v2.'mp4';?>" 
          />
          </video>
          <input style="margin-left:16px;margin-top:0px" type="radio" name="svideo" value="{$result_row['id']}" />{$result_row['record_video']}
        </div>
VIDEO;
        }
      ?>
          
        </div>
</div>

	<div id="menu1">
	 <span id="jilu1">显示<?php echo $nums; ?>条记录</span>
   	 <span id="jilu2">
        <?php
		$sql = "SELECT * from `video` where `camera2`='*'";
		$result = mysql_query($sql);
		$numss = mysql_num_rows($result);
		$page = ceil($numss/$page_num);
            if ($page_no > 1) {
                    echo "<a href ='play.php?page_no=".($page_no-1)."'>上一页</a>&nbsp;&nbsp;&nbsp;";
                }else{
                    echo '<span>上一页</span>&nbsp;&nbsp;&nbsp;';
                }
                echo '<strong>第'.$page_no.'页/共'.$page.'页</strong>';
                if ($nums == $page_num) {
                    echo "&nbsp;&nbsp;&nbsp;<a href ='play.php?page_no=".($page_no+1)."'>下一页</a>";
                }else{
                    echo '&nbsp;&nbsp;&nbsp;<span>下一页</span>';
                }
        ?>
        </span>   
       </div>
</form> 

        

<?php break;} ?>
<script type="text/javascript">
$(function() {
  $("#videofile").submit(function() {
   if($('input:radio[name="svideo"]:checked').val()==null)
   {
    alert("请选择视频！");
    return false;
   }
  });
})
</script>
</body>
</html>
