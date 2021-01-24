<?php
$name = $_GET["name"];
$img = ImageCreateFromPNG($name);
list($width, $hight) = getimagesize($name);

if(in_array('nega', $_GET['gd'])){
  ImageFilter($img, IMG_FILTER_NEGATE);
}
if(in_array('gray', $_GET['gd'])){
  ImageFilter($img, IMG_FILTER_GRAYSCALE);
}
if(in_array('gauss', $_GET['gd'])){
  $matrix = array(array(1, 1, 1), array(1, 1, 1), array(1, 1, 1));
  imageconvolution($img, $matrix, 9, 0);
}

$kido = $_GET["kido"];
ImageFilter($img, IMG_FILTER_BRIGHTNESS, $kido);

$image = imagecreatetruecolor(600, 400);    
imagecopyresampled($image, $img, 0, 0, 0, 0, 600, 400, $width, $hight);

$format = '%s_%s.png';
$time = time();
$sha1 = sha1(uniqid(mt_rand(),true));
$file_name = sprintf($format,$time,$sha1);

header('Content-Type: image/png');
ImagePNG($image, './' . $file_name);
imagedestroy($image);

header('Content-Length: '.filesize($file_name));
header('Content-Disposition: attachment; filename="'.$file_name.'"');
readfile($file_name);
unlink($file_name);
?>