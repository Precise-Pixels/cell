// ThreeJS
var $container, containerX, containerY, scene, camera, displace, renderer, controls;

if(Detector.webgl) {
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

    heightMap.addEventListener('error', function() {
        alert('Error: The height map data for this environment has gone missing. Please try cloning a new environment.');
        window.location.href = '/user/' + userId + '/env/new';
    });
}

// ThreeJS Setup
function init() {
    $container = document.getElementById('model');
    $container.innerHTML = '';

    getContainerSize();

    // Scene
    scene = new THREE.Scene();

    // Camera
    camera = new THREE.PerspectiveCamera(25, containerX / containerY);
    camera.position.x = 400;
    camera.position.y = 200;
    camera.position.z = 400;
    camera.lookAt(scene.position);

    // Lights
    ambientLight = new THREE.AmbientLight(0xffffff);
    scene.add(ambientLight);

    // Shaders
    var shader   = THREE.ShaderLib['normalmap'];
    var uniforms = THREE.UniformsUtils.clone(shader.uniforms);
    var texture  = new THREE.ImageUtils.loadTexture('/php/getEnvTexture.php?lat=' + latitude + '&lon=' + longitude, {}, function() {
        document.body.className += ' env--loaded';
    });

    uniforms['enableDisplacement'].value = true;
    uniforms['enableDiffuse'].value      = true;
    uniforms['tDisplacement'].value      = displace;
    uniforms['tDiffuse'].value           = texture;
    uniforms['uDisplacementScale'].value = 20;

    var dispMapShader = new THREE.ShaderMaterial({ fragmentShader: shader.fragmentShader, vertexShader: shader.vertexShader, uniforms: uniforms, lights: true, wireframe: false });
    var podiumShader  = new THREE.MeshLambertMaterial({ ambient: 0x222222 });
    var podiumBottom  = new THREE.MeshBasicMaterial({ map: THREE.ImageUtils.loadTexture('/img/podium-bottom.jpg') });

    var cubeFaceMaterials = [podiumShader, podiumShader, dispMapShader, podiumBottom, podiumShader, podiumShader];

    // Geometry
    var geometry = new THREE.CubeGeometry(100, 2, 100, 200, 1, 200, cubeFaceMaterials);
    geometry.computeTangents();

    var podium = new THREE.Mesh(geometry, new THREE.MeshFaceMaterial(cubeFaceMaterials));

    scene.add(podium);

    // Controls
    controls = new THREE.OrbitControls(camera, $container);
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

    function switchInteraction(interaction, e) {
        if(e.target.className.match(/btn--selected/)) { return false; }

        resetClassNames();

        switch(interaction) {
            case 'default':
                iDefault.className += ' btn--selected';
                stopWebcam();
                controls.autoRotate = true;
                break;
            case 'webcam':
                iWebcam.className += ' btn--selected';
                if(Detector.webrtc) {
                    if((window.innerWidth || document.documentElement.clientWidth) < 800) {
                        alert('Please note, this is an experimental feature. Although it does work on some devices, the performance may be very slow.');
                    }
                    initWebcam();
                    controls.autoRotate = false;
                } else {
                    alert('Your browser does not support webcam interaction.');
                    resetClassNames();
                    iDefault.className += ' btn--selected';
                    controls.autoRotate = true;
                }
                break;
        }

        function resetClassNames() {
            iDefault.className = iWebcam.className = 'btn btn--interact';
            document.body.className = document.body.className.replace(' env--webcam', '');
        }
    }

    // Events
    var iDefault = document.getElementById('default');
    var iWebcam  = document.getElementById('webcam');

    iDefault.addEventListener('click', function(e) { switchInteraction('default', e); });
    iWebcam.addEventListener('click', function(e) { switchInteraction('webcam', e); });

    window.addEventListener('resize', onWindowResize);
}


// WolframAlpha
var envData = document.getElementById('env-data');
var UTM = latLonToUTM(latitude, longitude);

var data = 'u=' + encodeURIComponent('http://api.wolframalpha.com/v2/query?appid=WXLG6E-WP5KKHL9GR&format=plaintext&input=' + UTM);
var request = new XMLHttpRequest;
request.open('POST', '/php/getWolframData.php', true);
request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
request.send(data);

request.onreadystatechange = function() {
    if(request.readyState == 4 && request.status == 200) {
        envData.innerHTML = request.responseText;
    }
}

function latLonToUTM(lat, lon) {
    // Thanks: http://transition.fcc.gov/mb/audio/bickel/DDDMMSS-decimal.html
    var latSign = lonSign = 1;

    if(lat < 0) { latSign = -1; }
    if(lon < 0) { lonSign = -1; }

    latAbs = Math.abs(Math.round(lat * 1000000));
    lonAbs = Math.abs(Math.round(lon * 1000000));

    latDeg = ((Math.floor(latAbs / 1000000) * latSign) + ' deg ' + Math.floor(((latAbs/1000000) - Math.floor(latAbs/1000000)) * 60) + '\'');
    lonDeg = ((Math.floor(lonAbs / 1000000) * lonSign) + ' deg ' + Math.floor(((lonAbs/1000000) - Math.floor(lonAbs/1000000)) * 60) + '\'');

    return latDeg + ' N, ' + lonDeg + ' E';
}