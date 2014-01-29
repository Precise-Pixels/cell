var Detector = {
    webgl: ( function () { try { var canvas = document.createElement( 'canvas' ); return !! window.WebGLRenderingContext && ( canvas.getContext( 'webgl' ) || canvas.getContext( 'experimental-webgl' ) ); } catch( e ) { return false; } } )()
}

if(Detector.webgl) {
    document.documentElement.className += 'webgl';

    // REQUEST MAHOOSIVE FILE AND UPDATE PROGRESS BAR
    var $progBar = document.getElementById('prog-bar');

    var xhr = new XMLHttpRequest();

    xhr.open('get', '/js/env/threejs.tweenjs.stats.loaders.controls.php', true);
    xhr.send();

    xhr.onprogress = function(e) {
        var responseText = xhr.responseText;

        if(responseText.length > 10) {
            var total = responseText.match(/\d{6}?/);
            $progBar.value = e.loaded / total[0] * 100;
        }

        xhr.responseText = ''; //clear responseText to save memory
    };

    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4) {
            var s = document.createElement('script');
            s.appendChild(document.createTextNode(xhr.responseText));
            document.body.appendChild(s);

            document.body.className += ' env--loaded';

            init();
            animate();
            loadStats();
        }
    };

    // SETUP
    var $container, containerX, containerY, scene, camera, renderer, controls;

    function init() {
        $container = document.getElementById('model');
        $container.innerHTML = '';

        getContainerSize();

        // scene
        scene = new THREE.Scene();

        var ambient = new THREE.AmbientLight(0xffffff);
        scene.add(ambient);

        var directional = new THREE.DirectionalLight(0xffffff, 1);
        directional.position.set(600, 800, 100);
        directional.caseShadow = true;
        directional.shadowCameraVisible = true;
        directional.shadowMapWidth = directional.shadowMapWidth = 2048;

        var d = 50;

        directional.shadowCameraLeft = -d;
        directional.shadowCameraRight = d;
        directional.shadowCameraTop = d;
        directional.shadowCameraBottom = -d;

        directional.shadowCameraFar = 1000;
        directional.shadowDarkness = 0.5;

        scene.add(directional);

        // camera
        camera = new THREE.PerspectiveCamera(45, containerX / containerY, 1, 2000);
        camera.position.x = 1000;
        camera.position.y = 400;
        camera.position.z = 400;

        camera.lookAt(scene.position);

        // controls
        controls = new THREE.OrbitControls(camera, $container, '360');
        controls.addEventListener('change', render);

        // model & texture
        var loader = new THREE.OBJMTLLoader();
        loader.addEventListener( 'load', function ( event ) {

            var object = event.content;
            object.castShadow = true;
            object.receiveShadow = true;
            scene.add( object );

        });
        loader.load( '/3d/models/mountain.obj', '/3d/materials/mountain.mtl' );

        // render
        renderer = new THREE.WebGLRenderer( { alpha: true, antialias: true } );
        renderer.setSize(containerX, containerY);
        $container.appendChild(renderer.domElement);
    }

    function animate() {
        requestAnimationFrame(animate);
        render();
        controls.update();
        TWEEN.update();
    }

    function render() {
        renderer.render(scene, camera);
    }

    // EVENTS
    var vMenuCheckbox = document.getElementById('model-menu-toggle');
    var v360          = document.getElementById('360');
    var vTop          = document.getElementById('top');
    var vSide         = document.getElementById('side');
    var vLive         = document.getElementById('live');
    var vLiveClose    = document.getElementById('model-live-close');
    var iDefault      = document.getElementById('default');
    var iWebcam       = document.getElementById('webcam');

    v360.addEventListener( 'click', function(e) { switchView('360', e); }, false );
    vTop.addEventListener( 'click', function(e) { switchView('top', e); }, false );
    vSide.addEventListener( 'click', function(e) { switchView('side', e); }, false );
    vLive.addEventListener( 'click', function(e) { toggleLiveView('open'); }, false );
    vLiveClose.addEventListener( 'click', function(e) { toggleLiveView('close'); }, false );
    iDefault.addEventListener( 'click', function(e) { switchInteraction('default', e); }, false );
    iWebcam.addEventListener( 'click', function(e) { switchInteraction('webcam', e); }, false );

    window.addEventListener('resize', onWindowResize, false);

    // FUNCTIONS
    function switchView(view, e) {
        if (e.target.className.match(/btn--selected/)) { return false; }

        vMenuCheckbox.checked = false;
        v360.className = vTop.className = vSide.className = 'btn btn--views';

        controls.removeAllEventListeners();

        switch(view) {
            case '360':
                v360.className += ' btn--selected';
                new TWEEN.Tween( camera.position ).to({
                    x: 1000, y: 400, z: 400
                }, 500).onUpdate(function() {
                    camera.lookAt(scene.position);
                }).start().onComplete(reinstateControls);
                break;

            case 'top':
                vTop.className += ' btn--selected';
                // TODO: Animation 'clicks' potentially due to OrbitControls.autoRotation not being animated
                new TWEEN.Tween( camera.position ).to({
                    x: 0, y: 1000, z: 0
                }, 500).onUpdate(function() {
                    camera.lookAt(scene.position);
                }).start().onComplete(reinstateControls);
                break;

            case 'side':
                vSide.className += ' btn--selected';
                new TWEEN.Tween( camera.position ).to({
                    x: 1000, y: 0, z: 0
                }, 500).onUpdate(function() {
                    camera.lookAt(scene.position);
                }).start().onComplete(reinstateControls);
                break;
        }

        function reinstateControls() {
            controls = new THREE.OrbitControls(camera, $container, view);
        }
    }

    function switchInteraction(interaction, e) {
        if (e.target.className.match(/btn--selected/)) { return false; }
        
        iDefault.className = iWebcam.className = 'btn btn--interact';

        switch(interaction) {
            case 'default':
                iDefault.className += ' btn--selected';
                break;
            case 'webcam':
                iWebcam.className += ' btn--selected';
                break;
        }
    }

    function toggleLiveView(toggle) {
        if(toggle == 'open') {
            document.body.className += ' env--live';
        } else {
            document.body.className = document.body.className.replace(' env--live', '');
        }
    }

    function onWindowResize() {
        getContainerSize();

        camera.aspect = containerX / containerY;
        camera.updateProjectionMatrix();

        renderer.setSize(containerX, containerY);
    }

    function getContainerSize() {
        containerX = $container.clientWidth;
        containerY = $container.clientHeight;
    }
}