var $container, scene, camera, displace, renderer;

var xhr = new XMLHttpRequest();

xhr.open('get', '/php/getThreeJS.php', true);
xhr.send();

xhr.onreadystatechange = function() {
    if(xhr.readyState == 4) {
        var s = document.createElement('script');
        s.appendChild(document.createTextNode(xhr.responseText));
        document.body.appendChild(s);

        // Blur height map
        var heightMap = new Image();
        heightMap.src  = '/img/user/' + userId + '/height-map-' + envId + '.png';

        heightMap.addEventListener('load', function() {
            var canvas = document.createElement('canvas');
            var ctx = canvas.getContext('2d');
            ctx.drawImage(heightMap, 0, 0, heightMap.width, heightMap.height);
            stackBlurImage(heightMap, canvas, 20);
            ctx.lineWidth = 2;
            ctx.strokeRect(0, 0, heightMap.width, heightMap.height);
            displace = new THREE.Texture(canvas);
            displace.needsUpdate = true;

            init();
        });
    }
}

// ThreeJS Setup
function init() {
    // Scene
    $container = document.getElementById('capture-model');
    renderer = new THREE.WebGLRenderer({alpha: true, antialias: true, preserveDrawingBuffer: true});
    renderer.setSize($container.clientWidth, $container.clientHeight);
    renderer.setClearColor(0x333333, 1);
    $container.appendChild(renderer.domElement);

    scene = new THREE.Scene();

    // Camera
    camera = new THREE.PerspectiveCamera(45, renderer.domElement.width / renderer.domElement.height);
    camera.position.x = 400;
    camera.position.y = 200;
    camera.position.z = 400;
    camera.lookAt(scene.position);

    // Control
    controls = new THREE.OrbitControls(camera, $container, '360');
    controls.addEventListener('change', render);

    // Lights
    ambientLight = new THREE.AmbientLight(0xffffff);
    scene.add(ambientLight);

    // Shaders
    var texture  = new THREE.ImageUtils.loadTexture('/php/getEnvTexture.php?lat=' + latitude + '&lon=' + longitude, {}, function() { loadComplete() });
    var shader   = THREE.ShaderLib['normalmap'];
    var uniforms = THREE.UniformsUtils.clone(shader.uniforms);

    uniforms[ "enableDisplacement" ].value = true;
    uniforms[ "enableDiffuse" ].value      = true;
    uniforms[ "tDisplacement" ].value      = displace;
    uniforms[ "tDiffuse" ].value           = texture;
    uniforms[ "uDisplacementScale" ].value = 20;

    var dispMapShader = new THREE.ShaderMaterial({ fragmentShader: shader.fragmentShader, vertexShader: shader.vertexShader, uniforms: uniforms, lights: true, wireframe: false });
    var podiumShader  = new THREE.MeshLambertMaterial({ ambient: 0x222222 });

    var cubeFaceMaterials = [podiumShader, podiumShader, dispMapShader, podiumShader, podiumShader, podiumShader];

    // Geometry
    var geometry = new THREE.CubeGeometry(100, 2, 100, 200, 1, 200, cubeFaceMaterials);
    geometry.computeTangents();

    var podium = new THREE.Mesh( geometry, new THREE.MeshFaceMaterial(cubeFaceMaterials) );

    scene.add(podium);

    // Functions
    function animate() {
        requestAnimationFrame(animate);
        renderer.render(scene, camera);
        controls.update();
    }

    function render() {
        renderer.render(scene, camera);
    }

    requestAnimationFrame(animate);

    function loadComplete() {
        render();
        var data = 's=' + encodeURIComponent(renderer.domElement.toDataURL('image/png').replace('data:image/png;base64,', ''));
        var request = new XMLHttpRequest;
        request.open('POST', '/php/captureEnv.php', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        request.send(data);

        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                window.location.href = envURL;
            } else if(request.status != 200) {
                console.log('An error has occurred.');
            }
        }
    }
}