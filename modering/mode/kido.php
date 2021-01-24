<?php

$img = ImageCreateFromJPEG('inko.jpg');

ImageFilter($img, IMG_FILTER_BRIGHTNESS, 100);

header('Content-Type: image/jpeg');
ImageJPEG($img);
