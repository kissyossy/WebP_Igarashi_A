<?php
$name = $_FILES['img']['name'];
?>

<!DOCTYPE html>
<html lang="jp">

<head>
	<meta charset='UTF-8'>
	<title> 画像加工 </title>
	<link rel = "stylesheet" href = "stylesheet.css">
</head>

<body>
	<form action="gazoukakou3.php" method="GET">
		加工内容を選択してください<br>
		<input type="checkbox" name="gd[]" value="nega"> ネガ(色反転) <br>
		<input type="checkbox" name="gd[]" value="gray"> グレースケール(無彩色) <br>
		<input type="checkbox" name="gd[]" value="gauss"> ぼかし <br>
		輝度(明度)<input type="text" name="kido">※1~255の範囲でないと動きません<br>
		<input type="hidden" name="name" value="<?php print $name; ?>">
		<br>
		<input type="submit" value="加工内容で画像をダウンロード">
	</form>
	<br>
	<a href="gazoukakou1.php">前の作業に戻る</a>
	<a href="top.php">トップに戻る</a>
</body>

</html>