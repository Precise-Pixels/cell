<?php

$q = $_GET['q'];

$path = preg_replace('/\/$|.php/', '', $q);

if(empty($path)) {                                  // HOME
    $file = 'index';
} elseif(file_exists("views/$path/index.php")) {    // DIRECTORY INDEX
    $file = "$path/index";
} elseif(file_exists("views/$path.php")) {          // PAGE
    $file = $path;
} else {                                            // NOT FOUND
    $file = '404';
}

$isEnv = preg_match('/env\/\d/', $q);
$envVars = explode('/', $q);

if($isEnv) {
    $username = $envVars[1];
    $envId    = $envVars[3];
}

require_once('front_view.php');