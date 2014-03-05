<?php

if($_SERVER['SERVER_NAME'] == 'cell.dev') {
    $f = file_get_contents('../js/threejs-tweenjs-stats-loaders-controls-stackblur.js');
} else {
    $f = file_get_contents('../build/threejs-tweenjs-stats-loaders-controls-stackblur.min.js');
}

$s = strlen($f);
echo "// $s $f";