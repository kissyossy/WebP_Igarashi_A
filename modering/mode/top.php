<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Creation</title>
        <link rel="stylesheet" href="top.css">
    </head>
    <body>
        <h1>CREATION</h1>
        
        <p>
        <a  class="model" ONCLICK="newwindow()">
            モデリングに移動
        </a>
        </p>
        <div class = "model-hukidashi">
            新しいモデリングをつくる！！
        </div>

        <p>
        <a  class="gallery" href="gallery.php">
            ギャラリーに移動
        </a>
        </p>

        <div class = "gallery-hukidashi">
            作った作品を見る！！！！
        </div>

    </body>
    <script>
			function newwindow() {
				window.open("modering.php", "モデリング" , "width=1050,height=950");
			}
</script>
 </html>