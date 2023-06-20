import * as THREE from 'https://cdn.jsdelivr.net/npm/three@0.125/build/three.module.js';
import {
    OrbitControls
} from 'https://cdn.jsdelivr.net/npm/three@0.125/examples/jsm/controls/OrbitControls.js';
import {
    GLTFLoader
} from 'https://cdn.jsdelivr.net/npm/three@0.125/examples/jsm/loaders/GLTFLoader.js';
import {
    RGBELoader
} from 'https://cdn.jsdelivr.net/npm/three@0.125/examples/jsm/loaders/RGBELoader.js';

import { RoomEnvironment } from 'https://cdn.jsdelivr.net/npm/three@0.125/examples/jsm/environments/RoomEnvironment.js';
import { KTX2Loader } from 'https://cdn.jsdelivr.net/npm/three@0.125/examples/jsm/loaders/KTX2Loader.js';
import { MeshoptDecoder } from 'https://cdn.jsdelivr.net/npm/three@0.125/examples/jsm/libs/meshopt_decoder.module.js';

var container, controls;
var camera, scene, renderer, mixer, clock;

init();
animate();

function init(img = null) {
    $('#3D-model').html(' ')
    container = document.getElementById('3D-model');

    camera = new THREE.PerspectiveCamera(75, widthDiv/heightDiv, 0.1, 1000);
    camera.position.set(3, 2.6, 2);
    scene = new THREE.Scene();
    clock = new THREE.Clock();

    const grid = new THREE.GridHelper( 5, 5, 0xffffff, 0xffffff );
    grid.material.opacity = 0.5;
    grid.material.depthWrite = false;
    grid.material.transparent = true;
    scene.add( grid );

    const color = 0xFFFFFF;
    const intensity = 0.1;
    const light = new THREE.AmbientLight(color, intensity);
    scene.add(light);

    renderer = new THREE.WebGLRenderer({
        antialias: true
    });
    renderer.setPixelRatio(window.devicePixelRatio);
    renderer.setSize(widthDiv, heightDiv);
    renderer.toneMapping = THREE.ACESFilmicToneMapping;
    renderer.toneMappingExposure = 0.8;
    renderer.outputEncoding = THREE.sRGBEncoding;
    container.appendChild(renderer.domElement);

    new RGBELoader()
        .setDataType(THREE.FloatType)
        .setPath('https://threejs.org/examples/textures/equirectangular/')
        .load('royal_esplanade_1k.hdr', function (texture) {

            var envMap = pmremGenerator.fromEquirectangular(texture).texture;
            scene.environment = envMap;
            scene.background = new THREE.Color( 0x323232 );
            texture.flipY = false;
            texture.dispose();

            pmremGenerator.dispose();

            // model
            var loader = new GLTFLoader();
            loader.load('model.gltf', function (gltf) {
                console.log(gltf)

                mixer = new THREE.AnimationMixer(gltf.scene);
                gltf.animations.forEach((clip) => {
                    mixer.clipAction(clip).play();
                });

                gltf.scene.traverse(function (child) {
                    if (child.isMesh) {
                        child.material.envMap = envMap;
                    }
                });

                if (img != null) {
                    var tex = new THREE.TextureLoader().load(img);
                    tex.anisotropy = 100; // for glTF models.
                    tex.flipY = false; // for glTF models.

                    let k = 0
                    gltf.scene.traverse(function (child) {
                        if (k == 3) { //3
                            child.material.map = tex;
                        }
                        k = k + 1
                    })
                }
                gltf.scene.position.y = 1.2;

                scene.add(gltf.scene);
            });
        });



    var pmremGenerator = new THREE.PMREMGenerator(renderer);
    pmremGenerator.compileEquirectangularShader();

    controls = new OrbitControls(camera, renderer.domElement);
    controls.minDistance = 2;
    controls.maxDistance = 10
    controls.target.set(0, 0, -0.2);
    controls.update();

    window.addEventListener('resize', onWindowResize, false);

}

function onWindowResize() {
    camera.aspect = widthDiv/heightDiv;
    camera.updateProjectionMatrix();
    renderer.setSize(widthDiv, heightDiv);
}

function animate() {
    requestAnimationFrame(animate);
    var delta = clock.getDelta();
    if (mixer) mixer.update(delta);
    renderer.render(scene, camera);
}

function GetCanvasAtResoution(scaleMultiplier) {
    var objects = canvas.getObjects();

    for (var i in objects) {
        objects[i].scaleX = objects[i].scaleX * scaleMultiplier;
        objects[i].scaleY = objects[i].scaleY * scaleMultiplier;
        objects[i].left = objects[i].left * scaleMultiplier;
        objects[i].top = (objects[i].top) * scaleMultiplier;
        objects[i].setCoords();
    }

    canvas.discardActiveObject();
    canvas.setWidth(canvas.getWidth() * scaleMultiplier);
    canvas.setHeight(canvas.getHeight() * scaleMultiplier);
    canvas.renderAll();
    canvas.calcOffset();
}

document.getElementById('download').addEventListener('click', function (e) {
    GetCanvasAtResoution(3)
    let canvasUrl = canvas.toDataURL("image/jpeg");
    const createEl = document.createElement('a');
    createEl.href = canvasUrl;
    createEl.download = "download-this-canvas";
    createEl.click();
    createEl.remove();
    GetCanvasAtResoution(0.3333)
});

document.getElementById('test').addEventListener('click', function (e) {
    GetCanvasAtResoution(3)
    let canvasUrl = canvas.toDataURL("image/jpg");
    GetCanvasAtResoution(0.3333)

    $.ajax({
        url: "/constructor-Mugs/phpModules/uploadScreen.php",
        type: "post",
        dataType: "json",
        async: false,
        data: {
            image: canvasUrl
        },
        success: function (data) {
            console.log(data.name)
            init('phpModules/' + data.name);
            animate();
        }
    });
});

$("#phone").mask("(999) 999-99-99");