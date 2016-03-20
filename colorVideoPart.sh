#! /bin/bash

ID=$1
vstyle=$2
time_start=$3
time_end=$4
time_dur=$5
deal_signal=$6
mohu_value_r=$7
mohu_value_s=$8
mohu_value_t=$9
if [ "$vstyle" == "reverse" ]
then
	/root/bin/ffmpeg -ss 00:00:00 -t $time_start -i /var/www/ffmpeg/ffmpeg/record/$ID.mp4 /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_1".mp4 
	/root/bin/ffmpeg -ss $time_end -i /var/www/ffmpeg/ffmpeg/record/$ID.mp4 /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_3".mp4 
	/root/bin/ffmpeg -ss $time_start -t $time_dur -i /var/www/ffmpeg/ffmpeg/record/$ID.mp4 -vf 'split[up][down]; [up]pad=iw:ih*2[up];  [down]vflip[down]; [up][down]overlay=0:h' /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_2".mp4 
	/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_2".mp4 -vf scale=iw:ih*0.5 /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_2_half".mp4 

	/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_1".mp4 -vcodec copy -vbsf h264_mp4toannexb /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_1".ts 
	/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_2_half".mp4 -vcodec copy -vbsf h264_mp4toannexb /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_2_half".ts 
/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_3".mp4 -vcodec copy -vbsf h264_mp4toannexb /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_3".ts 
/root/bin/ffmpeg -i "concat:/var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_1".ts|/var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_2_half".ts|/var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_3".ts" -acodec copy -vcodec copy -absf aac_adtstoasc /var/www/ffmpeg/ffmpeg/colorvideo/temp/${ID}${deal_signal}.mp4
	mv /var/www/ffmpeg/ffmpeg/colorvideo/temp/${ID}${deal_signal}.mp4 /var/www/ffmpeg/ffmpeg/colorvideo/
	cd /var/www/ffmpeg/ffmpeg/colorvideo/temp
	rm -rf  *

elif [ "$vstyle" == "heibai" ]
then
	/root/bin/ffmpeg -ss 00:00:00 -t $time_start -i /var/www/ffmpeg/ffmpeg/record/$ID.mp4 /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_1".mp4 
	/root/bin/ffmpeg -ss $time_start -t $time_dur -i /var/www/ffmpeg/ffmpeg/record/$ID.mp4 -vf lutyuv="u=128:v=128" /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_2".mp4  
	/root/bin/ffmpeg -ss $time_end -i /var/www/ffmpeg/ffmpeg/record/$ID.mp4 /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_3".mp4 
	/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_1".mp4 -vcodec copy -vbsf h264_mp4toannexb /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_1".ts 
	/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_2".mp4 -vcodec copy -vbsf h264_mp4toannexb /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_2".ts 
	/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_3".mp4 -vcodec copy -vbsf h264_mp4toannexb /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_3".ts 
	/root/bin/ffmpeg -i "concat:/var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_1".ts|/var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_2".ts|/var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_3".ts" -acodec copy -vcodec copy -absf aac_adtstoasc /var/www/ffmpeg/ffmpeg/colorvideo/temp/${ID}${deal_signal}.mp4
	mv /var/www/ffmpeg/ffmpeg/colorvideo/temp/${ID}${deal_signal}.mp4 /var/www/ffmpeg/ffmpeg/colorvideo/
	cd /var/www/ffmpeg/ffmpeg/colorvideo/temp
	rm -rf  *
elif [ "$vstyle" == "mohu" ] 
then
	/root/bin/ffmpeg -ss 00:00:00 -t $time_start -i /var/www/ffmpeg/ffmpeg/record/$ID.mp4 /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_1".mp4 
	/root/bin/ffmpeg -ss $time_start -t $time_dur -i /var/www/ffmpeg/ffmpeg/record/$ID.mp4 -vf smartblur=$mohu_value_r:$mohu_value_s:$mohu_value_t /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_2".mp4  
	/root/bin/ffmpeg -ss $time_end -i /var/www/ffmpeg/ffmpeg/record/$ID.mp4 /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_3".mp4 
	/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_1".mp4 -vcodec copy -vbsf h264_mp4toannexb /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_1".ts 
	/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_2".mp4 -vcodec copy -vbsf h264_mp4toannexb /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_2".ts 
	/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_3".mp4 -vcodec copy -vbsf h264_mp4toannexb /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_3".ts 
	/root/bin/ffmpeg -i "concat:/var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_1".ts|/var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_2".ts|/var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_3".ts" -acodec copy -vcodec copy -absf aac_adtstoasc /var/www/ffmpeg/ffmpeg/colorvideo/temp/${ID}${deal_signal}.mp4
	mv /var/www/ffmpeg/ffmpeg/colorvideo/temp/${ID}${deal_signal}.mp4 /var/www/ffmpeg/ffmpeg/colorvideo/
	cd /var/www/ffmpeg/ffmpeg/colorvideo/temp
	rm -rf  *

elif [ "$vstyle" == "fanxiang" ]
then
	/root/bin/ffmpeg -ss 00:00:00 -t $time_start -i /var/www/ffmpeg/ffmpeg/record/$ID.mp4 -c:v libx264 -preset ultrafast -c:a libfdk_aac /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_1".mp4 
	/root/bin/ffmpeg -ss $time_start -t $time_dur -i /var/www/ffmpeg/ffmpeg/record/$ID.mp4 -vf lutyuv="y=maxval+minval-val:u=maxval+minval-val:v=maxval+minval-val" -c:v libx264 -preset ultrafast -c:a libfdk_aac /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_2".mp4  
	/root/bin/ffmpeg -ss $time_end -i /var/www/ffmpeg/ffmpeg/record/$ID.mp4 -c:v libx264 -preset ultrafast -c:a libfdk_aac /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_3".mp4 
	/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_1".mp4 -vcodec copy -vbsf h264_mp4toannexb /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_1".ts 
	/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_2".mp4 -vcodec copy -vbsf h264_mp4toannexb /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_2".ts 
	/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_3".mp4 -vcodec copy -vbsf h264_mp4toannexb /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_3".ts 
	/root/bin/ffmpeg -i "concat:/var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_1".ts|/var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_2".ts|/var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_3".ts" -acodec copy -vcodec copy -absf aac_adtstoasc /var/www/ffmpeg/ffmpeg/colorvideo/temp/${ID}${deal_signal}.mp4
	mv /var/www/ffmpeg/ffmpeg/colorvideo/temp/${ID}${deal_signal}.mp4 /var/www/ffmpeg/ffmpeg/colorvideo/
	cd /var/www/ffmpeg/ffmpeg/colorvideo/temp
	rm -rf  *

elif [ "$vstyle" == "fugu" ]
then
	/root/bin/ffmpeg -ss 00:00:00 -t $time_start -i /var/www/ffmpeg/ffmpeg/record/$ID.mp4 /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_1".mp4
        /root/bin/ffmpeg -ss $time_start -t $time_dur -i /var/www/ffmpeg/ffmpeg/record/$ID.mp4 -vf colorchannelmixer=0.393:0.769:0.189:0:0.349:0.686:0.168:0:0.272:0.534:0.131 /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_2".mp4 
	/root/bin/ffmpeg -ss $time_end -i /var/www/ffmpeg/ffmpeg/record/$ID.mp4 /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_3".mp4
	/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_1".mp4 -vcodec copy -vbsf h264_mp4toannexb /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_1".ts 
	/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_2".mp4 -vcodec copy -vbsf h264_mp4toannexb /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_2".ts 
	/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_3".mp4 -vcodec copy -vbsf h264_mp4toannexb /var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_3".ts 
	/root/bin/ffmpeg -i "concat:/var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_1".ts|/var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_2".ts|/var/www/ffmpeg/ffmpeg/colorvideo/temp/$ID"_3".ts" -acodec copy -vcodec copy -absf aac_adtstoasc /var/www/ffmpeg/ffmpeg/colorvideo/temp/${ID}${deal_signal}.mp4
	/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/colorvideo/temp/${ID}${deal_signal}.mp4 /var/www/ffmpeg/ffmpeg/colorvideo/temp/${ID}${deal_signal}.mp4
	mv /var/www/ffmpeg/ffmpeg/colorvideo/temp/${ID}${deal_signal}.mp4  /var/www/ffmpeg/ffmpeg/colorvideo/
	cd /var/www/ffmpeg/ffmpeg/colorvideo/temp
	rm -rf  *
else
/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/record/$ID.mp4  /var/www/$ID.mp4
fi






	
 	 
