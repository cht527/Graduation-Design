#!/bin/bash
ID1=$1
ID2=$2
recordDur=$3
id1=$4
id2=$5
# if语句中，主要需要注意以下几点：
#1、if 与[ 之间必须有空格
#2、[ ]与判断条件之间也必须有空格
#3、]与; 之间不能有空格

#Video4linux2（简称V4L2),是linux中关于视频设备的内核驱动。在Linux中，视频设备是设备文件，可以像访问普通文件一样对其进行读写，摄像头在/dev/video0下
if [ "$ID1" != "" ] && [ "$ID2" == "-1" ];
then
  /root/bin/ffmpeg -f video4linux2 -t $recordDur -s 960*720 -r 25 -i /dev/video0  /var/www/ffmpeg/ffmpeg/record/$ID1.avi
  /root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/record/$ID1.avi -c:v libx264 -preset ultrafast -c:a libfdk_aac /var/www/ffmpeg/ffmpeg/record/$ID1.mp4
  /root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/record/$ID1.avi -y -f image2 -ss 5 -t 0.001 -s 200x168 /var/www/ffmpeg/ffmpeg/tmpimg/$id1.jpg

  cd /var/www/ffmpeg/ffmpeg/record/
  rm -rf $ID1.avi

elif [ "$ID1" == "-1" ] && [ "$ID2" != "" ];
then
  /root/bin/ffmpeg -f video4linux2 -t $recordDur -s 960*720 -r 25 -i /dev/video1  /var/www/ffmpeg/ffmpeg/record/$ID2.avi
  /root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/record/$ID2.avi -c:v libx264 -preset ultrafast -c:a libfdk_aac /var/www/ffmpeg/ffmpeg/record/$ID2.mp4
  /root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/record/$ID2.avi -y -f image2 -ss 5 -t 0.001 -s 200x168 /var/www/ffmpeg/ffmpeg/tmpimg/$id2.jpg

  cd /var/www/ffmpeg/ffmpeg/record/
  rm -rf $ID2.avi

else
  /root/bin/ffmpeg -f video4linux2 -t $recordDur -s 960*720 -r 25 -i /dev/video0  /var/www/ffmpeg/ffmpeg/record/$ID1.avi & /root/bin/ffmpeg -f video4linux2 -t $recordDur -s 960*720 -r 25 -i /dev/video1  /var/www/ffmpeg/ffmpeg/record/$ID2.avi 
  /root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/record/$ID1.avi -c:v libx264 -preset ultrafast -c:a libfdk_aac /var/www/ffmpeg/ffmpeg/record/$ID1.mp4 & /root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/record/$ID2.avi -c:v libx264 -preset ultrafast -c:a libfdk_aac /var/www/ffmpeg/ffmpeg/record/$ID2.mp4

  /root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/record/$ID1.avi -y -f image2 -ss 5 -t 0.001 -s 200x168 /var/www/ffmpeg/ffmpeg/tmpimg/$id1.jpg & /root/bin/ffmpeg -i /var/www/ffmpeg/ffmpeg/record/$ID2.avi -y -f image2 -ss 5 -t 0.001 -s 200x168 /var/www/ffmpeg/ffmpeg/tmpimg/$id2.jpg

  cd /var/www/ffmpeg/ffmpeg/record/
  rm -rf $ID1.avi $ID2.avi
fi

