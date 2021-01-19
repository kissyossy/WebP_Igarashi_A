<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>three.js</title>
    <link rel = "stylesheet" href = "style.css">
</head>
<body>
<form>
  PosX : <input type = "number" id = "posX">
  PosY : <input type = "number" id = "posY">
  PosZ : <input type = "number" id = "posZ"><br>
  
  SizeX : <input type = "number" id = "SizeX">
  SizeY : <input type = "number" id = "SizeY">
  SizeZ : <input type = "number" id = "SizeZ"><br>

  Red : <input type = "number" id = "red">
  Green : <input type = "number" id = "green">
  Blue : <input type = "number" id = "blue"> <br>

  <button id = "button1">BOX</button>
  <button id = "button2">SPHERE</button>
  <button id = "button3">CYLINDER</button><br><br>
</form>
<p>(BOXの場合)<br>SizeX=幅, SizeY=高さ, SizeZ=奥行き<br>
    (SPHEREの場合)<br>SizeX=半径, SizeY=経度分割数, SizeZ=緯度分割数<br>
    (CYLINDERの場合)<br>SizeX=上面の半径, SizeY=底面の半径, SizeZ=高さ<br></p>

<div id="stage"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/99/three.min.js"></script>
<script src="https://threejs.org/examples/jsm/controls/TrackballControls.js"></script>
<script>
    var scene;
    var box;
    var sphere;
    var cylinder;
    var camera;
    var renderer;
    var light;
    var width = 800;
    var height = 600;
    var projector = new THREE.Projector();
(function init(){
    'use strict';

<<<<<<< HEAD:memo.php
    

//マウスのグローバル変数
var mouse = { x: 0, y: 0 };  

var button1 = document.getElementById("button1");
=======
//箱
  var button1 = document.getElementById("button1");
>>>>>>> 34f0bd400002dfa564eb4089842126e2e9cd4c56:modering.php
  button1.addEventListener("click",function(e)
    {
      e.preventDefault();
      var Pos_X = document.getElementById("posX").value;
      var Pos_Y = document.getElementById("posY").value;
      var Pos_Z = document.getElementById("posZ").value;

      var Size_X = document.getElementById("SizeX").value;
      var Size_Y = document.getElementById("SizeY").value;
      var Size_Z = document.getElementById("SizeZ").value;

      var RED = document.getElementById("red").value;
      var GREEN = document.getElementById("green").value;
      var BLUE = document.getElementById("blue").value;

    // mesh メッシュ(物体)
    // geometry ジオメトリー(形状)
    // material マテリアル(表面素材)       
        box = new THREE.Mesh(
          new THREE.BoxGeometry(Size_X, Size_Y, Size_Z),
          new THREE.MeshLambertMaterial({color:"rgb(" +RED+ "," +GREEN+ "," +BLUE+ ")"})
         );
        box.position.set(Pos_X, Pos_Y, Pos_Z);
        box.name = 'box1';
        scene.add(box); 
        targetList.push(box);    
    });

//球
    var button2 = document.getElementById("button2");
    button2.addEventListener("click",function(e)
        {
            e.preventDefault();
            var Pos_X = document.getElementById("posX").value;
            var Pos_Y = document.getElementById("posY").value;
            var Pos_Z = document.getElementById("posZ").value;

            var Size_X = document.getElementById("SizeX").value;
            var Size_Y = document.getElementById("SizeY").value;
            var Size_Z = document.getElementById("SizeZ").value;

            var RED = document.getElementById("red").value;
            var GREEN = document.getElementById("green").value;
            var BLUE = document.getElementById("blue").value;

    // mesh メッシュ(物体)
    // geometry ジオメトリー(形状)
    // material マテリアル(表面素材)         
            sphere = new THREE.Mesh(
            new THREE.SphereGeometry(Size_X, Size_Y, Size_Z),
            new THREE.MeshLambertMaterial({color: "rgb(" +RED+ "," +GREEN+ "," +BLUE+ ")"})
             );
            sphere.position.set(Pos_X, Pos_Y, Pos_Z);
            scene.add(sphere); 
        });  

//円柱
    var button3 = document.getElementById("button3");
    button3.addEventListener("click",function(e)
        {
            e.preventDefault();
            var Pos_X = document.getElementById("posX").value;
            var Pos_Y = document.getElementById("posY").value;
            var Pos_Z = document.getElementById("posZ").value;

            var Size_X = document.getElementById("SizeX").value;
            var Size_Y = document.getElementById("SizeY").value;
            var Size_Z = document.getElementById("SizeZ").value;

            var RED = document.getElementById("red").value;
            var GREEN = document.getElementById("green").value;
            var BLUE = document.getElementById("blue").value;

    // mesh メッシュ(物体)
    // geometry ジオメトリー(形状)
    // material マテリアル(表面素材)         
            cylinder = new THREE.Mesh(
            new THREE.CylinderGeometry(Size_X, Size_Y, Size_Z),
            new THREE.MeshLambertMaterial({color: "rgb(" +RED+ "," +GREEN+ "," +BLUE+ ")"})
             );
            cylinder.position.set(Pos_X, Pos_Y, Pos_Z);
            scene.add(cylinder); 
        });  

    // scene シーン
    scene = new THREE.Scene();


    // light ライト
    light = new THREE.DirectionalLight( 0xffffff, 1); // 色、光の強さ
    light.position.set(0, 100, 30);
    scene.add(light);

    // camera カメラ
    camera = new THREE.PerspectiveCamera( 45, width / height, 1, 1000 );
    camera.position.set(100, 90, 400);
    //camera.lookAt(box.position);  // boxの位置にカメラを向ける。

    // renderer レンダラー
    renderer = new THREE.WebGLRenderer( {antialias: true} );
    renderer.setSize(width, height);
    renderer.setClearColor(0xefefef);
    renderer.setPixelRatio(window.devicePixelRatio); // 画面のピクセル比を設定
    document.getElementById('stage').appendChild(renderer.domElement);

    function render(){
        requestAnimationFrame(render);

        // レンダリング
        renderer.render(scene, camera);
    }
    render();

    //軸
    var material1 = new THREE.LineBasicMaterial( { linewidth: 30, color:"rgb(0,0,0)" } );
    var geometry1 = new THREE.Geometry();
    geometry1.vertices.push(new THREE.Vector3(0, 0, 0));
    geometry1.vertices.push(new THREE.Vector3(width, 0, 0));
    geometry1.vertices.push(new THREE.Vector3(0, 0, 0));
    geometry1.vertices.push(new THREE.Vector3(0, height, 0));
    geometry1.vertices.push(new THREE.Vector3(0, 0, 0));
    geometry1.vertices.push(new THREE.Vector3(0, 0, 300));
    scene.add( new THREE.Line( geometry1, material1 ) );
    
    
    //オブジェクト格納グローバル変数
var targetList = []; 
window.onmousedown = function (ev){
    if (ev.target == renderer.domElement) { 
    
        //マウス座標2D変換
        var rect = ev.target.getBoundingClientRect();    
        mouse.x =  ev.clientX - rect.left;
        mouse.y =  ev.clientY - rect.top;
        
        //マウス座標3D変換 width（横）やheight（縦）は画面サイズ
        mouse.x =  (mouse.x / width) * 2 - 1;           
        mouse.y = -(mouse.y / height) * 2 + 1;
        
        // マウスベクトル
        var vector = new THREE.Vector3( mouse.x, mouse.y ,1);

       // vector はスクリーン座標系なので, オブジェクトの座標系に変換
        projector.unprojectVector( vector, camera );

        // 始点, 向きベクトルを渡してレイを作成
        var ray = new THREE.Raycaster( camera.position, vector.sub( camera.position ).normalize() );
        
         // クリック判定
        var obj = ray.intersectObjects( targetList );
        
         // クリックしていたら、alertを表示  
        if ( obj.length > 0 ){                       
          
          alert("click!!")
          
       } 
 
    }
   }; 
   controls = new TrackballControls(camera, renderer.domElement);
   function animate() {
      requestAnimationFrame(animate);
      controls.update();
    }
    
})();



  

</script>

<script>
//リセットボタン
  window.addEventListener('load', init);
  function init()
  {
    button4.addEventListener('click',function(){
        location.reload(true);
    });
  }
</script>

<br><button id="button4">リセット</button><br>
<button onclick = "location.href='./top.php'">トップへ戻る</button>
<button onclick = "location.href='./effect.php'">画像加工へ</button>
</body>
</html>