#!/bin/bash
ID=$1
id=$2

 /root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/delayvideo/$ID.mp4 -q:v 1 /var/www/ffmpeg/ffmpeg/video_send/$id.mp4
/usr/local/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/video_send/$id.mp4 -y -f image2 -ss 2 -t 0.001 -s 352x240 /var/www/ffmpeg/ffmpeg/mobile/tmpimg/$id.png
