if(Detector.webgl) {
    init();
}

// ThreeJS Setup
var $container, containerX, containerY, scene, camera, displace, renderer, controls;

function init() {
    $container = document.getElementById('clone-cube');
    $container.innerHTML = '';

    getContainerSize();

    // Scene
    scene = new THREE.Scene();

    // Camera
    camera = new THREE.PerspectiveCamera(25, containerX / containerY);
    camera.position.x = 500;
    camera.position.y = 500;
    camera.position.z = 500;
    camera.lookAt(scene.position);

    // Lights
    ambientLight = new THREE.AmbientLight(0xffffff);
    scene.add(ambientLight);

    // Geometry
    var loader = new THREE.OBJMTLLoader();

    loader.addEventListener('load', function(e) {
        var object = e.content;
        object.castShadow = true;
        object.receiveShadow = true;
        scene.add(object);
    });

    loader.load( '/3d/clone-cube.obj', '/3d/clone-cube.mtl' );

    // Controls
    controls = new THREE.OrbitControls(camera, $container, '360', containerX);
    controls.addEventListener('change', render);

    // Render
    renderer = new THREE.WebGLRenderer({alpha: true, antialias: true});
    renderer.setSize(containerX, containerY);
    $container.appendChild(renderer.domElement);

    animate();
    loadStats();

    // Functions
    function animate() {
        requestAnimationFrame(animate);
        render();
        controls.update();
    }

    function render() {
        renderer.render(scene, camera);
    }

    function getContainerSize() {
        containerX = $container.clientWidth;
        containerY = $container.clientHeight;
    }

    function onWindowResize() {
        getContainerSize();

        camera.aspect = containerX / containerY;
        camera.updateProjectionMatrix();

        renderer.setSize(containerX, containerY);
    }

    // Events
    window.addEventListener('resize', onWindowResize);
}