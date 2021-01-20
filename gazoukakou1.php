<!DOCTYPE html>
<html lang="jp">

<head>
	<meta charset='UTF-8'>
	<title> 画像加工 </title>
	<link rel = "stylesheet" href = "stylesheet.css">
</head>

<body>
	<form action="gazoukakou2.php" method="POST" enctype="multipart/form-data">
		<h2>htdocsフォルダにあるjpeg画像を選択してください</h2><br>
		加工した画像は「output.jpg」として保存されます。<br>
		<input name="img" type="file" accept="image/jpeg" required><br>
		<br>
		<input type="submit" value="送信">
	</form>
</body>

</html>