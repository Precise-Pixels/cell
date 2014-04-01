if(Detector.webgl) {
    init();
}

// ThreeJS Setup
var $container, containerX, containerY, scene, camera, ambient, directional1, directional2, loader, controls, renderer;

function init() {
    $container = document.getElementById('clone-cube');
    $container.innerHTML = '<img src="/img/spinner.gif" alt="Loading"/>';

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
    ambient = new THREE.AmbientLight(0x333333);
    scene.add(ambient);

    directional1 = new THREE.DirectionalLight(0xffffff);
    directional1.position.set(40, 35, 40);
    directional1.castShadow = true;
    scene.add(directional1);

    directional2 = new THREE.DirectionalLight(0xffffff, .3);
    directional2.position.set(-40, -35, -40);
    directional1.castShadow = true;
    scene.add(directional2);

    // Geometry
    loader = new THREE.OBJMTLLoader();

    loader.addEventListener('load', function(e) {
        var object = e.content;
        object.castShadow = true;
        object.receiveShadow = true;
        scene.add(object);
        var $spinner = $container.getElementsByTagName('img')[0];
        $container.removeChild($spinner);
    });

    loader.load('/3d/clone-cube.obj', '/3d/clone-cube.mtl');

    // Controls
    controls = new THREE.OrbitControls(camera, $container, '360', containerX);
    controls.noScrollZoom = true;
    controls.maxDistance = 190;
    controls.addEventListener('change', render);

    // Render
    renderer = new THREE.WebGLRenderer({alpha: true, antialias: true});
    renderer.setSize(containerX, containerY);
    renderer.shadowMapEnabled = true;
    renderer.shadowMapSoft = true;
    $container.appendChild(renderer.domElement);

    animate();

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