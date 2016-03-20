#! /bin/bash

filetoken=$1
bright=$2
contrast=$3
saturation=$4
sourcetoken=`echo $filetoken | cut -d'_' -f1`
filetokenNew=$filetoken"_"


	/root/bin/ffmpeg -i ./aerial_video/source_video/$sourcetoken.mp4 -an -vf "eq=contrast=$contrast:brightness=$bright:saturation=$saturation" -c:v libx264 -preset ultrafast -c:a libfdk_aac  ./aerial_video/tmp_video/$filetokenNew.mp4 
	#mv /var/www/ffmpeg/ffmpeg/aerial_video/tmp_video/$filetokenNew.mp4 /var/www/ffmpeg/ffmpeg/aerial_video/






	
 	 
