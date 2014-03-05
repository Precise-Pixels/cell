<?php

$q = $_GET['q'];

$path = preg_replace('/\/$|.php/', '', $q);

if(empty($path)) {                                  // HOME
    $file = 'index';
} elseif(file_exists("views/$path.php")) {          // PAGE
    $file = $path;
} else {                                            // NOT FOUND
    $file = '404';
}

$isHome   = ($q == '');
$isAbout  = preg_match('#about/?$#', $q);
$isUser   = preg_match('#user\/[0-9a-zA-Z]+/?$#', $q);
$isEnv    = preg_match('#env\/\d+/?$#', $q);
$isNewEnv = preg_match('#env\/new/?$#', $q);
$isCapturing = preg_match('#capturing-environment#', $q);

if($isHome) {
    require_once('model-home.php');
}

if($isUser) {
    require_once('model-user.php');
}

if($isEnv) {
    require_once('model-environment.php');
}

if($isNewEnv) {
    $file = 'new-environment';
}

require_once('front-view.php');