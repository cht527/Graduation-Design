#!/bin/bash
name=$1
id=$2

cp /var/www/ffmpeg/ffmpeg/aerial_video/tmp_video/$name.mp4 /var/www/ffmpeg/ffmpeg/video_send/
mv /var/www/ffmpeg/ffmpeg/video_send/$name.mp4 /var/www/ffmpeg/ffmpeg/video_send/$id.mp4
sleep 3s
/root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/video_send/$id.mp4 -y -f image2 -ss 2 -t 0.001 -s 352x240 /var/www/ffmpeg/ffmpeg/mobile/tmpimg/$id.png
