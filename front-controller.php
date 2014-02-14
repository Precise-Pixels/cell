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
    require_once('model-user.php');
}

if($isEnv) {
    require_once('model-environment.php');
}

require_once('front-view.php');