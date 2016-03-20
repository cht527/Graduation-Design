#!/bin/sh

g++ `pkg-config opencv --libs --cflags opencv` FishEye.cpp -o FishEye
#g++  `pkg-config --cflags opencv` -o FishEye.cpp `pkg-config --libs opencv`
./FishEye /var/www/ffmpeg/ffmpeg/yuyan.jpg


