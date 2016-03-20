#! /bin/bash

ID=$1
vstyle=$2
deal_signal=$3
mohu_value_r=$4
mohu_value_s=$5
mohu_value_t=$6
if [ "$vstyle" == "reverse" ]
then
	/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/record/$ID.mp4  -vf 'split[up][down]; [up]pad=iw:ih*2[up];  [down]vflip[down]; [up][down]overlay=0:h' /var/www/ffmpeg/ffmpeg/colorvideo/temp/${ID}${deal_signal}.mp4 
	mv /var/www/ffmpeg/ffmpeg/colorvideo/temp/${ID}${deal_signal}.mp4  /var/www/ffmpeg/ffmpeg/colorvideo/

elif [ "$vstyle" == "heibai" ]
then
	/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/record/$ID.mp4 -vf lutyuv="u=128:v=128" -c:v libx264 -preset ultrafast -c:a libfdk_aac /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID${deal_signal}.mp4  
	mv /var/www/ffmpeg/ffmpeg/colorvideo/temp/${ID}${deal_signal}.mp4  /var/www/ffmpeg/ffmpeg/colorvideo/

elif [ "$vstyle" == "mohu" ]
then
/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/record/$ID.mp4  -vf smartblur=$mohu_value_r:$mohu_value_s:$mohu_value_t -c:v libx264 -preset ultrafast -c:a libfdk_aac /var/www/ffmpeg/ffmpeg/colorvideo/temp/${ID}${deal_signal}.mp4 
	mv /var/www/ffmpeg/ffmpeg/colorvideo/temp/${ID}${deal_signal}.mp4  /var/www/ffmpeg/ffmpeg/colorvideo/

elif [ "$vstyle" == "fanxiang" ]
then
	/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/record/$ID.mp4 -vf lutyuv="y=maxval+minval-val:u=maxval+minval-val:v=maxval+minval-val" -c:v libx264 -preset ultrafast -c:a libfdk_aac /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID${deal_signal}.mp4  
	mv /var/www/ffmpeg/ffmpeg/colorvideo/temp/${ID}${deal_signal}.mp4  /var/www/ffmpeg/ffmpeg/colorvideo/

elif [ "$vstyle" == "fugu" ]
then
	/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/record/$ID.mp4 -vf colorchannelmixer=.393:.769:.189:0:.349:.686:.168:0:.272:.534:.131  /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID${deal_signal}.mp4  
	mv /var/www/ffmpeg/ffmpeg/colorvideo/temp/${ID}${deal_signal}.mp4  /var/www/ffmpeg/ffmpeg/colorvideo/
	
else
/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/record/$ID.mp4  /var/www/$ID.mp4 
fi






	
 	 
