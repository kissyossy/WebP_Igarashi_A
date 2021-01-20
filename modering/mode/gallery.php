<!DOCTYPE html>
<html>
<body>

<<<<<<< HEAD
<link rel = "stylesheet" href = "memo.css">
=======
<link rel = "stylesheet" href = "stylesheet.css">
>>>>>>> 8444dec22e39aac95229d9a951302c95dc8c0c82

<h1>『ギャラリー』</h1>
<h3>作成した画像を選択してください。</h3>

<script>

function onFileSelected(input) {

    var file = input.files[0];

    var reader = new FileReader();

    reader.onload = onFileLoaded;

    reader.readAsDataURL(file);

}

function onFileLoaded(e) {

    var src_data = e.target.result;

    var img = new Image();

    img.onload = onImageSetted;
    img.src = src_data;

}

function onImageSetted(e) {

    var data = createImageData(e.target);

    document.getElementById('test_canvas').getContext('2d').putImageData(data, 0, 0);

}

function createImageData(img) {

    var cv = document.createElement('canvas');

    cv.width = img.naturalWidth;
    cv.height = img.naturalHeight;

    var ct = cv.getContext('2d');

    ct.drawImage(img, 0, 0);

    var data = ct.getImageData(0, 0, cv.width, cv.height);

    return data;

}

</script>

<p>
<input type="file" onchange="onFileSelected(this)">
</p>


<canvas id="test_canvas" width=600 height=400 style="border: 1px solid;"></canvas>


</body>
</html>