<?php

$q = $_GET['q'];

$path = preg_replace('/\/$|.php/', '', $q);

// NB: might be able to remove this after env/user views are done

if(empty($path)) {                                  // HOME
    $file = 'index';
} elseif(file_exists("views/$path/index.php")) {    // DIRECTORY INDEX
    $file = "$path/index";
} elseif(file_exists("views/$path.php")) {          // PAGE
    $file = $path;
} else {                                            // NOT FOUND
    $file = '404';
}

$isUser = preg_match('#user\/[0-9a-zA-Z]+/?$#', $q);
$isEnv  = preg_match('#env\/\d+/?$#', $q);

if($isUser) {
    $userHandle = explode('/', $q)[1];
}

if($isEnv) {
    $envVars    = explode('/', $q);
    $userHandle = $envVars[1];
    $envId      = $envVars[3];
}

require_once('front-view.php');