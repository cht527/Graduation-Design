
<?php
include "lib/connect.php";
$filetoken=$_GET['filetoken'];
$dealtype=$_GET['dealtype'];
$bright=$_GET['bright'];
$contrast=$_GET['contrast'];
$saturation=$_GET['saturation'];
$speed=$_GET['speed'];
$filetokenNew=$filetoken."_";
//$tokenarray=explode("_",$filetoken);
///$sourcetoken=$tokenarray[0];
//时间区间参数
$time_start=$_GET['fly_time_start'];
$time_end=$_GET['fly_time_end'];

if($time_start!="" && $time_end!=""){
	$Tarrayend=explode(":",$time_end);
	$Tarraystart=explode(":",$time_start);
	$T_endHour=$Tarrayend[0];
	$T_endMin=$Tarrayend[1];
	$T_endSec=$Tarrayend[2];
	$T_startHour=$Tarraystart[0];
	$T_startMin=$Tarraystart[1];
	$T_startSec=$Tarraystart[2];
	if(intval($T_endSec)-intval($T_startSec)<0){
		$SS=intval($T_endSec)+60-intval($T_startSec);
		if(intval($T_endMin)==0){
			$T_endMin=intval($T_endMin)+60-1;
			if(intval($T_endMin)-intval($T_startMin)<0){
				$MM=intval($T_endMin)+60-intval($T_startMin);	
				$T_endHour=intval($T_endHour)-1;	
			}else{
				$MM=intval($T_endMin)-intval($T_startMin);
			}		
		}else{
			$T_endMin=intval($T_endMin)-1;
			if(intval($T_endMin)-intval($T_startMin)<0){
				$MM=intval($T_endMin)+60-intval($T_startMin);	
				$T_endHour=intval($T_endHour)-1;	
			}else{
				$MM=intval($T_endMin)-intval($T_startMin);
			}
		}
		
	}else{
		$SS=intval($T_endSec)-intval($T_startSec);
		if(intval($T_endMin)-intval($T_startMin)<0){
			$MM=intval($T_endMin)+60-intval($T_startMin);
			$T_endHour=intval($T_endHour)-1;		
		}else{
			$MM=intval($T_endMin)-intval($T_startMin);
		}
	}
	$HH=intval($T_endHour)-intval($T_startHour);
	$HH=strval($HH);
	$MM=strval($MM);
	$SS=strval($SS);	
	if(intval($HH)<10){
		$HH="0".$HH;
	}
	if(intval($MM)<10){
		$MM="0".$MM;
	}
	if(intval($SS)<10){
		$SS="0".$SS;
	}
	$time_dur=$HH.":".$MM.":".$SS;
}

if($time_start!="" && $time_end!=""){
	if($dealtype=='addcolor'){
	exec("/usr/bin/sudo /var/www/ffmpeg/ffmpeg/flyVideoPartColor.sh $filetoken $bright $contrast $saturation $time_start $time_end $time_dur",$output,$return);
	}
	if($dealtype=='adjustspeed'){
	exec("/usr/bin/sudo /var/www/ffmpeg/ffmpeg/flyVideoPartSpeed.sh $filetoken $speed $time_start $time_end $time_dur",$output,$return);
	}
}else{
	if($dealtype=='addcolor'){
		exec("/usr/bin/sudo /var/www/ffmpeg/ffmpeg/flyVideoAllColor.sh $filetoken $bright $contrast $saturation",$output,$return);
	}
	if($dealtype=='adjustspeed'){
		exec("/usr/bin/sudo /var/www/ffmpeg/ffmpeg/flyVideoAllSpeed.sh $filetoken $speed",$output,$return);
	}

}

$queryinsert=mysql_query(" update `video_fly` set `deal_mark`='*' ");
echo $filetokenNew;

?>

		
