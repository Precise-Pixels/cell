// Scene
var env = document.getElementById('env');
var renderer = new THREE.WebGLRenderer({alpha: true, antialias: true});
renderer.setSize(env.clientWidth, env.clientHeight);
env.appendChild(renderer.domElement);

var scene = new THREE.Scene();

// Camera
var fov = 45; // camera field-of-view in degrees
var width = renderer.domElement.width;
var height = renderer.domElement.height;
var aspect = width / height; // view aspect ratio
var camera = new THREE.PerspectiveCamera( fov, aspect );
camera.position.z = -200;
camera.position.y = -400;
camera.lookAt(scene.position);

// Control
controls = new THREE.OrbitControls(camera, env, '360');
controls.addEventListener('change', render);

// Lights
ambientLight = new THREE.AmbientLight( 0xffffff );
scene.add( ambientLight );

// Shaders
var displace = new THREE.ImageUtils.loadTexture('/img/user/' + userId + '/height-map-' + envId + '.png');
var texture = new THREE.ImageUtils.loadTexture('/php/getEnvTexture.php?lat=' + latitude + '&lon=' + longitude);
var shader = THREE.ShaderLib[ "normalmap" ];
var uniforms = THREE.UniformsUtils.clone( shader.uniforms );

uniforms[ "enableDisplacement" ].value = true;
uniforms[ "enableDiffuse" ].value = true;
uniforms[ "tDisplacement" ].value = displace;
uniforms[ "tDiffuse" ].value = texture;
uniforms[ "uDisplacementScale" ].value = 20;

var dispMapShader = new THREE.ShaderMaterial({ fragmentShader: shader.fragmentShader, vertexShader: shader.vertexShader, uniforms: uniforms, lights: true, wireframe: false });
var podiumShader  = new THREE.MeshLambertMaterial({ ambient: 0x222222 });

var cubeFaceMaterials = [ podiumShader, podiumShader, podiumShader, podiumShader, podiumShader, dispMapShader ];

// Geometry
var geometry = new THREE.CubeGeometry(100, 100, 2, 100, 100, 1, cubeFaceMaterials);
geometry.computeTangents();

var podium = new THREE.Mesh( geometry, new THREE.MeshFaceMaterial(cubeFaceMaterials) );

scene.add(podium);

// Functions
function animate() {
    requestAnimationFrame( animate );
    renderer.render( scene, camera );
    controls.update();
    TWEEN.update();
}

function render() {
    renderer.render(scene, camera);
}

requestAnimationFrame( animate );