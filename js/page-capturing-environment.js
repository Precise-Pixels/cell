if(document.cookie.replace(/(?:(?:^|.*;\s*)preventRecapture\s*\=\s*([^;]*).*$)|^.*$/, '$1') === 'true') {
    // If user is visiting this page from any page other than new-env, or user presses the
    // browser's back button from the env page, redirect to new-env
    window.location.href = '/user/' + username + '/env/new';
} else {
    // Else continue cloning
    document.cookie = 'preventRecapture=true; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/';

    var $container, scene, camera, displace, renderer;

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

    // ThreeJS Setup
    function init() {
        $container = document.getElementById('capture-model');

        // Scene
        scene = new THREE.Scene();

        // Camera
        camera = new THREE.PerspectiveCamera(25, $container.clientWidth / $container.clientHeight);
        camera.position.x = 250;
        camera.position.y = 150;
        camera.position.z = 250;
        camera.lookAt(scene.position);

        // Lights
        var ambientLight = new THREE.AmbientLight(0xffffff);
        scene.add(ambientLight);

        // Shaders
        var shader   = THREE.ShaderLib['normalmap'];
        var uniforms = THREE.UniformsUtils.clone(shader.uniforms);
        var texture  = new THREE.ImageUtils.loadTexture('/php/getEnvTexture.php?lat=' + latitude + '&lon=' + longitude, {}, function() { loadComplete() });

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

        var podium = new THREE.Mesh(geometry, new THREE.MeshFaceMaterial(cubeFaceMaterials));

        scene.add(podium);

        // Render
        renderer = new THREE.WebGLRenderer({antialias: true, preserveDrawingBuffer: true});
        renderer.setSize($container.clientWidth, $container.clientHeight);
        renderer.setClearColor(0x333333, 1);
        $container.appendChild(renderer.domElement);

        function loadComplete() {
            renderer.render(scene, camera);
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
}