#! /bin/bash

filetoken=$1
speed=$2
sourcetoken=`echo $filetoken | cut -d'_' -f1`
filetokenNew=$filetoken"_"

	/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/aerial_video/source_video/$sourcetoken.mp4 -r $speed -s 1080x720 -f image2 /var/www/ffmpeg/ffmpeg/aerial_video/tmp_img/foo-%04d.jpeg 
	/root/bin/ffmpeg -f image2 -i /var/www/ffmpeg/ffmpeg/aerial_video/tmp_img/foo-%04d.jpeg -r 25 -s 1080x720 -y /var/www/ffmpeg/ffmpeg/aerial_video/tmp_video/$filetokenNew.mp4
	mv /var/www/ffmpeg/ffmpeg/aerial_video/tmp_video/$filetokenNew.mp4 /var/www/ffmpeg/ffmpeg/aerial_video/
	cd /var/www/ffmpeg/ffmpeg/aerial_video/tmp_img
	rm -rf  *
	mv /var/www/ffmpeg/ffmpeg/aerial_video/$filetokenNew.mp4 /var/www/ffmpeg/ffmpeg/aerial_video/tmp_video
	




	
 	 
