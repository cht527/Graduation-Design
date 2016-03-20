<?php
        $name = $_GET['name'];
	$file_name= $name.'.mp4';
	$file_dir = "/var/www/ffmpeg/ffmpeg/colorvideo/";
// 设文件a.mpg已经创建，并且有权操作
// 但还是加上权限设定的语句，比较保险
// chmod(dirname(__FILE__), 0777); // 以最高操作权限操作当前目录
 
	if (!file_exists($file_dir . $file_name)) { //检查文件是否存在 
		echo "文件找不到"; 
		exit; 
	} else { 
		$fp = fopen($file_dir . $file_name,"r"); // 打开文件 
		// 输入文件标签 
		Header("Content-type: application/octet-stream"); 
		Header("Accept-Ranges: bytes"); 
		Header("Accept-Length: ".filesize($file_dir . $file_name)); 
		Header("Content-Disposition: attachment; filename=" . $file_name); 
		
		$buffer = 4096;
		
		//向浏览器返回数据 
		while(!feof($fp)){ 
			echo fread($fp,$buffer);//buffer在此表示待读取的最大字节数
		} 
		fclose($fp);
		exit;
	}
/*******************************************************************************/

	/*if (!file_exists($file_dir . $file_name2)) { //检查文件是否存在 
		echo "文件找不到"; 
		exit; 
	} else { 
		$fp = fopen($file_dir . $file_name2,"r"); // 打开文件 
		// 输入文件标签 
		Header("Content-type: application/octet-stream"); 
		Header("Accept-Ranges: bytes"); 
		Header("Accept-Length: ".filesize($file_dir . $file_name2)); 
		Header("Content-Disposition: attachment; filename=" . $file_name2); 
		
		$buffer = 4096;
		
		//向浏览器返回数据 
		while(!feof($fp)){ 
			echo fread($fp,$buffer);
		} 
		fclose($fp);
		exit;
	}*/
?> 
