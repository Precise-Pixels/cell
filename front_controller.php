<?php

$path = preg_replace('/\/$|.php/', '', $_GET['q']);

if(empty($path)) {                                  // HOME
    $file = 'index';
} elseif(file_exists("views/$path/index.php")) {    // DIRECTORY INDEX
    $file = "$path/index";
} elseif(file_exists("views/$path.php")) {          // PAGE
    $file = $path;
} else {                                            // NOT FOUND
    $file = '404';
}

require_once('front_view.php');