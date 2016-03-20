#! /bin/bash

filetoken=$1
speed=$2
time_start=$3
time_end=$4
time_dur=$5
sourcetoken=`echo $filetoken | cut -d'_' -f1`
filetokenNew=$filetoken"_"


	/root/bin/ffmpeg -ss 00:00:00 -t $time_start -i /var/www/ffmpeg/ffmpeg/aerial_video/source_video/$sourcetoken.mp4 -an -c:v libx264 -preset ultrafast -c:a libfdk_aac /var/www/ffmpeg/ffmpeg/aerial_video/tmp_video/$filetoken"_1".mp4 
	/root/bin/ffmpeg -ss $time_end -i /var/www/ffmpeg/ffmpeg/aerial_video/source_video/$sourcetoken.mp4 -an -c:v libx264 -preset ultrafast -c:a libfdk_aac /var/www/ffmpeg/ffmpeg/aerial_video/tmp_video/$filetoken"_3".mp4 
	/root/bin/ffmpeg -ss $time_start -t $time_dur -i /var/www/ffmpeg/ffmpeg/aerial_video/source_video/$sourcetoken.mp4 -r $speed -s 1080x720 -f image2 /var/www/ffmpeg/ffmpeg/aerial_video/tmp_img/foo-%04d.jpeg 
	/root/bin/ffmpeg -f image2 -i /var/www/ffmpeg/ffmpeg/aerial_video/tmp_img/foo-%04d.jpeg -r 25 -s 1080x720 -y /var/www/ffmpeg/ffmpeg/aerial_video/tmp_video/$filetoken"_2".mp4

	/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/aerial_video/tmp_video/$filetoken"_1".mp4 -vcodec copy -vbsf h264_mp4toannexb /var/www/ffmpeg/ffmpeg/aerial_video/tmp_video/$filetoken"_1".ts 
	/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/aerial_video/tmp_video/$filetoken"_2".mp4 -vcodec copy -vbsf h264_mp4toannexb /var/www/ffmpeg/ffmpeg/aerial_video/tmp_video/$filetoken"_2".ts 
        /root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/aerial_video/tmp_video/$filetoken"_3".mp4 -vcodec copy -vbsf h264_mp4toannexb /var/www/ffmpeg/ffmpeg/aerial_video/tmp_video/$filetoken"_3".ts 
/root/bin/ffmpeg -i "concat:/var/www/ffmpeg/ffmpeg/aerial_video/tmp_video/$filetoken"_1".ts|/var/www/ffmpeg/ffmpeg/aerial_video/tmp_video/$filetoken"_2".ts|/var/www/ffmpeg/ffmpeg/aerial_video/tmp_video/$filetoken"_3".ts" -acodec copy -vcodec copy -absf aac_adtstoasc /var/www/ffmpeg/ffmpeg/aerial_video/tmp_video/$filetokenNew.mp4
	mv /var/www/ffmpeg/ffmpeg/aerial_video/tmp_video/$filetokenNew.mp4 /var/www/ffmpeg/ffmpeg/aerial_video/
	cd /var/www/ffmpeg/ffmpeg/aerial_video/tmp_video
	rm -rf  *
	cd /var/www/ffmpeg/ffmpeg/aerial_video/tmp_img
	rm -rf  *
	mv /var/www/ffmpeg/ffmpeg/aerial_video/$filetokenNew.mp4 /var/www/ffmpeg/ffmpeg/aerial_video/tmp_video






	
 	 
