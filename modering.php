<html>
  <head>
    <meta charset="utf-8" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/110/three.min.js"></script>
    <title>example</title>
    <script>
      window.addEventListener('load', init);
      function init() {
        //ボタン
        button.addEventListener('click',function(){
        location.reload(true);
        });

        const width = 800;
        const height = 400;

        const mouse = new THREE.Vector2();

        const canvas = document.querySelector('#myCanvas');

        const renderer = new THREE.WebGLRenderer({
          canvas: canvas
        });
        renderer.setPixelRatio(window.devicePixelRatio);
        renderer.setSize(width, height);

        const scene = new THREE.Scene();

        const camera = new THREE.PerspectiveCamera(45, width / height);
        camera.position.set(width, -height, +1000);

        //box
        const meshList = [];
        canvas.addEventListener("click",event=>{
          const geometry = new THREE.BoxBufferGeometry(50, 50, 50);
          const material = new THREE.MeshStandardMaterial();
          const box = new THREE.Mesh(geometry, material);
          box.position.x = event.clientX*2;
          box.position.y = -event.clientY*2;
          box.position.z = 0;
          scene.add(box);
          meshList.push(box);
          });

        // 環境光源
        const ambientLight = new THREE.AmbientLight(0xffffff,2);
        scene.add(ambientLight);

        tick();
        function tick() {
          renderer.render(scene, camera);
          requestAnimationFrame(tick);
        }
      }
    </script>
  </head>
  <body>
    <canvas id="myCanvas"></canvas>
    <button id="button">もう一度</button>
  </body>
</html>