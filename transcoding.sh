#!/bin/bash
ID=$1
vformat_name=$2
#pgrep ffmpeg
#pkill ffmpeg
				
#/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/record/$ID.avi -s 1080x720 -f image2 /var/www/ffmpeg/ffmpeg/tmp/foo-%03d.jpeg
#/root/bin/ffmpeg -f image2 -i /var/www/ffmpeg/ffmpeg/tmp/foo-%03d.jpeg -r 25 -s 1080x720 -y /var/www/ffmpeg/ffmpeg/transcodevideo/$ID.$vformat
/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/record/$ID.mp4 -c:v libx264 -preset ultrafast -c:a libfdk_aac /var/www/ffmpeg/ffmpeg/tmp/${ID}${vformat_name}
mv /var/www/ffmpeg/ffmpeg/tmp/${ID}${vformat_name}  /var/www/ffmpeg/ffmpeg/transcodevideo/
#cd /var/www/ffmpeg/ffmpeg/tmp
#rm -rf  *



	
 	 
