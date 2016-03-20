<?php
        $ID = $_GET['ID'];
	$format=$_GET['format'];
	$file_name= $ID.".".$format;
	//echo $file_name;
	$file_dir = "/var/www/ffmpeg/ffmpeg/transcodevideo/";
// 设文件a.mpg已经创建，并且有权操作
// 但还是加上权限设定的语句，比较保险
// chmod(dirname(__FILE__), 0777); // 以最高操作权限操作当前目录
 
	if (!file_exists($file_dir . $file_name)) { //检查文件是否存在 
		echo "文件找不到"; 
		exit; 
	} else { 
		
		// 输入文件标签 
		Header("Content-type: application/octet-stream"); 
		Header("Accept-Ranges: bytes"); 
		Header("Accept-Length: ".filesize($file_dir . $file_name)); 
		Header("Content-Disposition: attachment; filename=" . $file_name); 
		$fp = fopen($file_dir . $file_name,"r"); // 打开文件 
		$buffer = 1024;
		$cur_pos=0;
		//向浏览器返回数据 
		while(!feof($fp)){ 
			echo fread($fp,$buffer);//buffer在此表示待读取的最大字节数
			$cur_pos+=$buffer;		
		} 
		$buffer2=fread($fp,filesize($file_dir . $file_name)-$cur_pos);
		echo $buffer2;		
		fclose($fp);
		return true;
	}
?> 
