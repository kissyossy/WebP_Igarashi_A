<link rel = "stylesheet" href = "stylesheet.css">

<h1>『ギャラリー』<h1>
<h3>作成した画像を選択してください。<h3>

<input type="file" id="selfile"><br>

<div id="bg"></div>
<canvas id="c"></canvas>

<style type="text/css">
div#bg{ width:960px;  height:540px; border:5px solid black; overflow:auto }
</style>

<script>
var obj1 = document.getElementById("selfile");

obj1.addEventListener("change", function(evt){
  var file = evt.target.files;
  var reader = new FileReader();
  
  reader.readAsDataURL(file[0]);
  
  reader.onload = function(){
    var dataUrl = reader.result;

    document.getElementById("bg").innerHTML = "<img src='" + dataUrl + "'>";
    document.getElementById("dturl").value = dataUrl;
  }
},false);

</script>
