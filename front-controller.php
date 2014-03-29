<?php
ob_start();
session_start();

$q = $_GET['q'];

$path = preg_replace('/\/$|.php/', '', $q);

if(empty($path)) {                                  // HOME
    $file = 'index';
} elseif(file_exists("views/$path.php")) {          // PAGE
    $file = $path;
} else {                                            // NOT FOUND
    $file = '404';
}

$isHome               = ($q == '');
$isAbout              = preg_match('#about/?$#', $q);
$isTechnology         = preg_match('#technology/?$#', $q);
$isCloningProcess     = preg_match('#the-cloning-process/?$#', $q);
$isUser               = preg_match('#user\/[0-9a-zA-Z]+/?$#', $q);
$isEnv                = preg_match('#env\/\d+/?$#', $q);
$isNewEnv             = preg_match('#env\/new/?$#', $q);
$isRecentlyClonedEnvs = preg_match('#recently-cloned-environments/?$#', $q);
$isCapturing          = preg_match('#capturing-environment#', $q);

$currentUrl           = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

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

if($isRecentlyClonedEnvs) {
    require_once('model-recently-cloned-environments.php');
    $file = 'recently-cloned-environments';
}

require_once('front-view.php');