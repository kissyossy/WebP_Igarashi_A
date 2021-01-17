<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>three.js</title>
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
  Blue : <input type = "number" id = "blue">  

  <button id = "button1">配置</button><br>
</form>

<div id="stage"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/99/three.min.js"></script>
<script src="../js_r79/TrackballControls.js"></script>
<script>
    var scene;
    var box;
    var camera;
    var renderer;
    var light;
    var width = 800;
    var height = 600;
    var projector = new THREE.Projector();
    // この平面に対してオブジェクトを平行に動かす
			var plane = new THREE.Plane();

var raycaster = new THREE.Raycaster();
var mouse = new THREE.Vector2();
var offset = new THREE.Vector3();
var intersection = new THREE.Vector3();

// マウスオーバーしているオブジェクト
var mouseoveredObj;
// ドラッグしているオブジェクト
var draggedObj;
(function init(){
    'use strict';

    

//マウスのグローバル変数
var mouse = { x: 0, y: 0 };  

var button1 = document.getElementById("button1");
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

    var controls = new THREE.TrackballControls( camera, renderer.domElement );

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

   renderer.domElement.addEventListener( 'mousedown', onDocumentMouseDown, false );
			renderer.domElement.addEventListener( 'mousemove', onDocumentMouseMove, false );
			renderer.domElement.addEventListener( 'mouseup', onDocumentMouseUp, false );

			function onDocumentMouseDown( event ) {
				event.preventDefault();

				raycaster.setFromCamera( mouse, camera );
				var intersects = raycaster.intersectObjects( objects );

				if ( intersects.length > 0 ) {
					// マウスドラッグしている間はTrackballControlsを無効にする
					controls.enabled = false;

					draggedObj = intersects[ 0 ].object;

					// rayとplaneの交点を求めてintersectionに設定
					if ( raycaster.ray.intersectPlane( plane, intersection ) ) {
						// ドラッグ中のオブジェクトとplaneの距離
						offset.copy( intersection ).sub( draggedObj.position );
					}
				}
			}

			function onDocumentMouseMove( event ) {
				event.preventDefault();

				mouse.x = ( event.clientX / window.innerWidth ) * 2 - 1;
				mouse.y = - ( event.clientY / window.innerHeight ) * 2 + 1;

				raycaster.setFromCamera( mouse, camera );

				if ( draggedObj ) {
					// オブジェクトをドラッグして移動させているとき

					// rayとplaneの交点をintersectionに設定
					if ( raycaster.ray.intersectPlane( plane, intersection ) ) {
						// オブジェクトをplaneに対して平行に移動させる
						draggedObj.position.copy( intersection.sub( offset ) );
					}
				} else {
					// オブジェクトをドラッグしないでマウスを動かしている場合
					var intersects = raycaster.intersectObjects( targetList );

					if ( intersects.length > 0 ) {
						if ( mouseoveredObj != intersects[ 0 ].targetList ) {
							// マウスオーバー中のオブジェクトを入れ替え
							mouseoveredObj = intersects[ 0 ].targetList;

							// plane.normalにカメラの方向ベクトルを設定
							// 平面の角度をカメラの向きに対して垂直に維持する
							camera.getWorldDirection( plane.normal );
						}
					} else {
						mouseoveredObj = null;
					}
				}
			}

			function onDocumentMouseUp( event ) {
				event.preventDefault();

				controls.enabled = true;

				if ( mouseoveredObj ) {
					draggedObj = null;
				}
			}

			animate();
			function animate() {
				requestAnimationFrame( animate );
				controls.update();
				renderer.render( scene, camera );
			}

    
})();



  

</script>

<script>
//リセットボタン
  window.addEventListener('load', init);
  function init()
  {
    button2.addEventListener('click',function(){
        location.reload(true);
    });
  }
</script>

<br><button id="button2">リセット</button><br>
</body>
</html>