<?php
	$getNum = $_POST['vIdTime'].'.'.'txt';
	//popen() 函数打开进程文件指针。popen(command,mode)--command 必需。规定要执行的命令
        //mode必需。规定连接模式。 可能的值：r: 只读。 w: 只写 (打开并清空已有文件或创建一个新文件)
	$handle = popen("python /var/www/ffmpeg/ffmpeg/get.py /var/www/ffmpeg/ffmpeg/progress/$getNum 2>&1", 'r');
	//2>&1----最终结果就是标准输出和错误都被重定向到相同路径中，1> 指标准信息输出路径（也就是默认的输出方式）。2> 指错误信息输出路径。2>&1 指将标准信息输出路径指定为错误信息输出路径（也就是都输出在一起）
	$buffer = fgets($handle);
	//fgets() 函数从文件指针中读取一行。fgets(file,length)，file 必需。规定要读取的文件。length 		可选。规定要读取的字节数。默认是 1024 字节。
	echo $buffer;
?>
