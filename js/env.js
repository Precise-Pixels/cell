var Detector = {
    webgl: ( function () { try { var canvas = document.createElement( 'canvas' ); return !! window.WebGLRenderingContext && ( canvas.getContext( 'webgl' ) || canvas.getContext( 'experimental-webgl' ) ); } catch( e ) { return false; } } )()
}

if(Detector.webgl) {
    // INIT
    var container, containerX, containerY, scene, camera, renderer, controls;

    init();
    animate();
    loadStats();

    function init() {
        container = document.getElementById('env');
        containerX = container.clientWidth;
        containerY = container.clientHeight;

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
        controls = new THREE.OrbitControls(camera, container, '360');
        controls.addEventListener('change', render);

        // model & texture
        var loader = new THREE.OBJMTLLoader();
        loader.addEventListener( 'load', function ( event ) {

            var object = event.content;
            object.castShadow = true;
            object.receiveShadow = true;
            scene.add( object );

        });
        loader.load( '/3d/models/PodiumTemplate.obj', '/3d/materials/PodiumTemplate.mtl' );

        // render
        renderer = new THREE.WebGLRenderer( { alpha: true, antialias: true } );
        renderer.setSize(containerX, containerY);
        container.appendChild(renderer.domElement);
        window.addEventListener('resize', onWindowResize, false);
    }

    function onWindowResize() {
        camera.aspect = containerX / containerY;
        camera.updateProjectionMatrix();

        renderer.setSize(containerX, containerY);
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
    var v360  = document.getElementById('360');
    var vTop  = document.getElementById('top');
    var vSide = document.getElementById('side');

    v360.addEventListener( 'click', function() { switchView('360'); }, false );
    vTop.addEventListener( 'click', function() { switchView('top'); }, false );
    vSide.addEventListener( 'click', function() { switchView('side'); }, false );

    function switchView(view) {
        controls.removeAllEventListeners();

        switch(view) {
            case '360':
                new TWEEN.Tween( camera.position ).to({
                    x: 1000, y: 400, z: 400
                }, 500).onUpdate(function() {
                    camera.lookAt(scene.position);
                }).start().onComplete(reinstateControls);
                break;

            case 'top':
                // TODO: Animation 'clicks' potentially due to OrbitControls.autoRotation not being animated
                new TWEEN.Tween( camera.position ).to({
                    x: 0, y: 1000, z: 0
                }, 500).onUpdate(function() {
                    camera.lookAt(scene.position);
                }).start().onComplete(reinstateControls);
                break;

            case 'side':
                new TWEEN.Tween( camera.position ).to({
                    x: 1000, y: 0, z: 0
                }, 500).onUpdate(function() {
                    camera.lookAt(scene.position);
                }).start().onComplete(reinstateControls);
                break;
        }

        function reinstateControls() {
            controls = new THREE.OrbitControls(camera, container, view);
        }
    }
}