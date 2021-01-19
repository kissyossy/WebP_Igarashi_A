<!DOCTYPE html>
<html lang="ja">
	<head>
		<title>draggable cubes</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
		<style>
			body {
				font-family: Monospace;
				background-color: #000000;
				margin: 0px;
				overflow: hidden;
			}
    </style>
    <link rel = "stylesheet" href = "style.css">
	</head>
	<body>

		<canvas style="z-index:1" id="c"></canvas>
		
		<form style="z-index:2; position:absolute; top:10; left:10">
			PosX : <input type = "number" id = "posX">
			PosY : <input type = "number" id = "posY">
			PosZ : <input type = "number" id = "posZ"><br>
			
			SizeX : <input type = "number" id = "SizeX">
			SizeY : <input type = "number" id = "SizeY">
			SizeZ : <input type = "number" id = "SizeZ"><br>
		  
			Red : <input type = "number" id = "red">
			Green : <input type = "number" id = "green">
			Blue : <input type = "number" id = "blue">  
		  
			<button id = "button1">BOX</button>
      <button id = "button2">SPHERE</button>
      <button id = "button3">CYLINDER</button><br><br>
			<button id="screenshot" type="button">Save...</button>
      <br><button id="button4">リセット</button><br>
      <button onclick = "location.href='./top.php'">トップへ戻る</button>
      <button onclick = "location.href='./effect.php'">画像加工へ</button>
		  </form>
		  

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

			// オブジェクトを格納する配列
			var objects = [];
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

			// シーンの作成
			var scene = new THREE.Scene();
			// light ライト
			light = new THREE.AmbientLight(0xFFFFFF, 1.0); // 色、光の強さ
			var light2 = new THREE.HemisphereLight(0x888888, 0x0000FF, 1.0);
            //light.position.set(0, 100, 30);
            scene.add(light);
			scene.add(light2);
			// camera カメラ
			camera = new THREE.PerspectiveCamera( 45, width / height, 1, 1000 );
            camera.position.set(10, 10, 10);
            //camera.lookAt(box.position);  // boxの位置にカメラを向ける。
			// レンダラーの作成
			const canvas = document.querySelector('#c');
			var renderer = new THREE.WebGLRenderer({canvas});


			// レンダラーが描画するキャンバスサイズの設定
			renderer.setSize( window.innerWidth, window.innerHeight );
			renderer.setClearColor(0xefefef);
            renderer.setPixelRatio(window.devicePixelRatio); // 画面のピクセル比を設定
			//document.getElementById('stage').appendChild(renderer.domElement);

			// キャンバスをDOMツリーに追加
			document.body.appendChild( renderer.domElement );
			function render(){
        requestAnimationFrame(render);

        // レンダリング
        renderer.render(scene, camera);
    }
    render();

			// TrackballControlsインスタンス作成
			var controls = new THREE.TrackballControls( camera ,renderer.domElement);
			controls.target.set( 0, 0, 0 )
			// ジオメトリーの作成
			var geometry = new THREE.BoxGeometry( 1, 1, 1 );
			/*// マテリアルの作成
			var material = new THREE.MeshNormalMaterial( { color: 0x00ff00 } );
			// オブジェクトの作成
			var cube = new THREE.Mesh( geometry, material );
			// オブジェクトの位置調整
			cube.position.x = 2.0;
			// オブジェクトをシーンに追加
			scene.add( cube );
			objects.push( cube );

			// オブジェクトを複製
			var cube2 = cube.clone();
			// オブジェクトの位置調整
			cube.position.x = -2.0;
			// オブジェクトをシーンに追加
			scene.add( cube2 );
			objects.push( cube2 );*/


			//箱
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
        scene.add(box);  
        objects.push(box);   
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
            objects.push(sphere);   
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
            objects.push(cylinder);   
        });  

		/*//軸
		var material1 = new THREE.LineBasicMaterial( { linewidth: 30, color:"rgb(0,0,0)" } );
        var geometry1 = new THREE.Geometry();
        geometry1.vertices.push(new THREE.Vector3(0, 0, 0));
        geometry1.vertices.push(new THREE.Vector3(width, 0, 0));
        geometry1.vertices.push(new THREE.Vector3(0, 0, 0));
        geometry1.vertices.push(new THREE.Vector3(0, height, 0));
        geometry1.vertices.push(new THREE.Vector3(0, 0, 0));
        geometry1.vertices.push(new THREE.Vector3(0, 0, 300));
        scene.add( new THREE.Line( geometry1, material1 ) );*/

		// 座標軸を表示
		var axes = new THREE.AxisHelper(25);
            scene.add(axes);

			// カメラ位置設定
			/*camera.position.z = 5;
			camera.position.x = 0.5;
			camera.position.y = 0.5;*/

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
				//var rect = event.target.getBoundingClientRect();
				mouse.x = ( event.clientX  / window.innerWidth ) * 2 - 1;
				mouse.y = - ( event.clientY  / window.innerHeight ) * 2 + 1;

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
					var intersects = raycaster.intersectObjects( objects );

					if ( intersects.length > 0 ) {
						if ( mouseoveredObj != intersects[ 0 ].object ) {
							// マウスオーバー中のオブジェクトを入れ替え
							mouseoveredObj = intersects[ 0 ].object;

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
			const elem = document.querySelector('#screenshot');
  elem.addEventListener('click', () => {
    render();
    canvas.toBlob((blob) => {
      saveBlob(blob, `screencapture-${canvas.width}x${canvas.height}.png`);
    });
  });

  const saveBlob = (function() {
    const a = document.createElement('a');
    document.body.appendChild(a);
    a.style.display = 'none';
    return function saveData(blob, fileName) {
       const url = window.URL.createObjectURL(blob);
       a.href = url;
       a.download = fileName;
       a.click();
    };
  }());

  //リセットボタン
  window.addEventListener('load', init);
  function init()
  {
    button4.addEventListener('click',function(){
        location.reload(true);
    });
  }

		</script>

	</body>
</html>
