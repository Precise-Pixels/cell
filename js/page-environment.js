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
    var ambientLight = new THREE.AmbientLight(0xffffff);
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

    var lineMaterial = new THREE.LineBasicMaterial({ color: 0xeeeeee, transparent: true, opacity: .5 });

    // Geometry
    var geometry = new THREE.CubeGeometry(100, 2, 100, 200, 1, 200, cubeFaceMaterials);
    geometry.computeTangents();

    var podium = new THREE.Mesh(geometry, new THREE.MeshFaceMaterial(cubeFaceMaterials));

    scene.add(podium);

    var rulerGeometry = new THREE.Geometry();
    rulerGeometry.vertices.push(new THREE.Vector3(-50, 1, 52));
    rulerGeometry.vertices.push(new THREE.Vector3(-50, 1, 55));
    rulerGeometry.vertices.push(new THREE.Vector3(50, 1, 55));
    rulerGeometry.vertices.push(new THREE.Vector3(50, 1, 52));

    var fiveGeometry = new THREE.Geometry();
    fiveGeometry.vertices.push(new THREE.Vector3(-1, 1, 56));
    fiveGeometry.vertices.push(new THREE.Vector3(-3, 1, 56));
    fiveGeometry.vertices.push(new THREE.Vector3(-3, 1, 57));
    fiveGeometry.vertices.push(new THREE.Vector3(-1, 1, 57));
    fiveGeometry.vertices.push(new THREE.Vector3(-1, 1, 58));
    fiveGeometry.vertices.push(new THREE.Vector3(-1.4, 1, 58.5));
    fiveGeometry.vertices.push(new THREE.Vector3(-1.7, 1, 59));
    fiveGeometry.vertices.push(new THREE.Vector3(-2.3, 1, 59));
    fiveGeometry.vertices.push(new THREE.Vector3(-2.6, 1, 58.5));
    fiveGeometry.vertices.push(new THREE.Vector3(-3, 1, 58));

    var zeroGeometry = new THREE.Geometry();
    zeroGeometry.vertices.push(new THREE.Vector3(0.5, 1, 56));
    zeroGeometry.vertices.push(new THREE.Vector3(1.5, 1, 56));
    zeroGeometry.vertices.push(new THREE.Vector3(2, 1, 57));
    zeroGeometry.vertices.push(new THREE.Vector3(2, 1, 58));
    zeroGeometry.vertices.push(new THREE.Vector3(1.5, 1, 59));
    zeroGeometry.vertices.push(new THREE.Vector3(0.5, 1, 59));
    zeroGeometry.vertices.push(new THREE.Vector3(0, 1, 58));
    zeroGeometry.vertices.push(new THREE.Vector3(0, 1, 57));
    zeroGeometry.vertices.push(new THREE.Vector3(0.5, 1, 56));

    var kGeometry = new THREE.Geometry();
    kGeometry.vertices.push(new THREE.Vector3(3, 1, 56));
    kGeometry.vertices.push(new THREE.Vector3(3, 1, 59));
    kGeometry.vertices.push(new THREE.Vector3(3, 1, 58));
    kGeometry.vertices.push(new THREE.Vector3(4, 1, 57));
    kGeometry.vertices.push(new THREE.Vector3(3, 1, 58));
    kGeometry.vertices.push(new THREE.Vector3(4, 1, 59));

    var mGeometry = new THREE.Geometry();
    mGeometry.vertices.push(new THREE.Vector3(4.5, 1, 59));
    mGeometry.vertices.push(new THREE.Vector3(4.8, 1, 58));
    mGeometry.vertices.push(new THREE.Vector3(5.2, 1, 58));
    mGeometry.vertices.push(new THREE.Vector3(5.5, 1, 59));
    mGeometry.vertices.push(new THREE.Vector3(5.8, 1, 58));
    mGeometry.vertices.push(new THREE.Vector3(6.2, 1, 58));
    mGeometry.vertices.push(new THREE.Vector3(6.5, 1, 59));

    var ruler = new THREE.Line(rulerGeometry, lineMaterial);
    var five  = new THREE.Line(fiveGeometry, lineMaterial);
    var zero  = new THREE.Line(zeroGeometry, lineMaterial);
    var k     = new THREE.Line(kGeometry, lineMaterial);
    var m     = new THREE.Line(mGeometry, lineMaterial);

    scene.add(ruler);
    scene.add(five);
    scene.add(zero);
    scene.add(k);
    scene.add(m);

    // Controls
    controls = new THREE.OrbitControls(camera, $container);
    controls.addEventListener('change', render);

    // Render
    renderer = new THREE.WebGLRenderer({alpha: true, antialias: true});
    renderer.setSize(containerX, containerY);
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

    window.addEventListener('resize', onWindowResize);
}

function switchInteraction(interaction, e) {
    if(e.target.className.match(/btn--selected/) || e.target.parentElement.className.match(/btn--selected/)) { return false; }

    if(Detector.webrtc) {
        iDefault.className = iWebcam.className = 'btn btn--interact';
        document.body.className = document.body.className.replace(' env--webcam', '');

        switch(interaction) {
            case 'default':
                iDefault.className += ' btn--selected';
                stopWebcam();
                controls.autoRotate = true;
                break;
            case 'webcam':
                if((window.innerWidth || document.documentElement.clientWidth) < 800) {
                    alert('Please note, this is an experimental feature. Although it does work on some devices, the performance may be very slow.');
                }
                iWebcam.className += ' btn--selected';
                initWebcam();
                controls.autoRotate = false;
                break;
        }
    } else {
        alert('Your browser does not support webcam interaction.');
    }
}

// Events
var iDefault = document.getElementById('default');
var iWebcam  = document.getElementById('webcam');

iDefault.addEventListener('click', function(e) { switchInteraction('default', e); });
iWebcam.addEventListener('click', function(e) { switchInteraction('webcam', e); });


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