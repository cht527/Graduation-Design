#!/bin/bash
partNum=$1
token=$2  
num=2	


cd /var/www/ffmpeg/ffmpeg/aerial_video/tmp_upload/
	
for ((i=1;i<=$partNum;i++))do echo $token-$i;done | xargs -i cat {} > /var/www/ffmpeg/ffmpeg/aerial_video/upload_video/$token.mpg;

/usr/local/zend/bin/php /var/www/ffmpeg/ffmpeg/update_fly_video.php token $token 

/usr/local/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/aerial_video/upload_video/$token.mpg -c:v libx264 -preset ultrafast -c:a libfdk_aac /var/www/ffmpeg/ffmpeg/aerial_video/upload_video/$token.mp4
mv /var/www/ffmpeg/ffmpeg/aerial_video/upload_video/$token.mp4 /var/www/ffmpeg/ffmpeg/aerial_video/source_video/
       
cd /var/www/ffmpeg/ffmpeg/aerial_video/tmp_upload/
rm -rf  *

cd /var/www/ffmpeg/ffmpeg/aerial_video/upload_video/
rm -rf  *

