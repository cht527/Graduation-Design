#!/bin/bash
vId=$1
vtxtname=$2
:<<BLOCK
运算符号    代表意义
=   等于 应用于：整型或字符串比较 如果在[] 中，只能是字符串
!=  不等于 应用于：整型或字符串比较 如果在[] 中，只能是字符串
&lt;    小于 应用于：整型比较 在[] 中，不能使用 表示字符串 &gt;   大于应用于：整型比较 在[] 中，不能使用 表示字符串
-eq 等于 应用于：整型比较
-ne 不等于 应用于：整型比较
-lt 小于 应用于：整型比较
-gt 大于 应用于：整型比较
-le 小于或等于 应用于：整型比较
-ge 大于或等于 应用于：整型比较
-a  双方都成立（and） 逻辑表达式 –a 逻辑表达式
-o  单方成立（or） 逻辑表达式 –o 逻辑表达式
-z  空字符串
-n  非空字符串
BLOCK

/root/bin/ffmpeg -f image2 -i /var/www/ffmpeg/ffmpeg/tmp2/foo-%04d.jpeg -r 25 -s 1080x720 -y /var/www/ffmpeg/ffmpeg/delayvideo/$vId.mp4 2>&1 | tee /var/www/ffmpeg/ffmpeg/progress/$vtxtname.txt

cd /var/www/ffmpeg/ffmpeg/tmp2
rm -rf  *
cd /var/www/ffmpeg/ffmpeg/tmp
rm -rf  *

