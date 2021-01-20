<!DOCTYPE html>
<html lang="jp">

<head>
	<meta charset='UTF-8'>
	<title> 画像加工 </title>
	<link rel = "stylesheet" href = "stylesheet.css">
</head>

<?php
$name = $_GET["name"];
$img = ImageCreateFromJPEG($name);
//$img = ImageCreateFromJPEG(sprintf('inko.jpg'));

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

//move_uploaded_file($img, ../);

header('Content-Type: image/jpeg');
ImageJPEG($img, './output.jpg');
header("location: gazoukakouEnd.php");
?>