import * as THREE from 'three';
import { OrbitControls } from 'https://unpkg.com/three@0.140.2/examples/jsm/controls/OrbitControls.js';
import { GLTFLoader } from 'https://unpkg.com/three@0.140.2/examples/jsm/loaders/GLTFLoader.js';

const testModel = 'assets/3d-models/model.gltf';
const modelContainer = document.getElementById('model-container');

if (WebGL.isWebGL2Available()) {
  // SCENE
  const scene = new THREE.Scene();
  scene.background = new THREE.Color(0xffd500);

  // CAMERA
  const camera = new THREE.PerspectiveCamera(
    75,
    window.innerWidth / window.innerHeight,
    0.1,
    1000
  );

  // RENDERER
  const renderer = new THREE.WebGLRenderer({
    antialias: true,
  });
  renderer.setSize(window.innerWidth, window.innerHeight);
  renderer.outputEncoding = THREE.sRGBEncoding;

  // LOADER
  const loader = new GLTFLoader();

  // CONTROL
  const controls = new OrbitControls(camera, renderer.domElement);

  // LIGHT //

  const light_2 = new THREE.DirectionalLight(0xffffff);
  light_2.position.set(10, 10, 20);
  light_2.intensity = 3;
  light_2.castShadow = true;
  scene.add(light_2);

  const ambient = new THREE.SpotLight(0xffd500, 2);
  // ambient.castShadow = true;
  // ambient.position.set(0, 100, 10);
  // ambient.shadow.bias = -0.0001;
  // ambient.shadow.mapSize.width = 1024 * 4;
  // ambient.shadow.mapSize.height = 1024 * 4;
  scene.add(ambient);

  loader.load(
    testModel,
    function (gltf) {
      scene.add(gltf.scene);
    },
    undefined,
    function (error) {
      console.error(error);
    }
  );

  camera.position.z = 5;

  modelContainer.appendChild(renderer.domElement);

  function animate() {
    requestAnimationFrame(animate);

    // cube.rotation.x += 0.01;
    // cube.rotation.y += 0.01;
    controls.update();

    renderer.render(scene, camera);
  }
  animate();
} else {
  const warning = WebGL.getWebGLErrorMessage();
  document.getElementById('container').appendChild(warning);
}
