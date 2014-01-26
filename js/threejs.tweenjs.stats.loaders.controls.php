<?php
$f = file_get_contents('threejs.tweenjs.stats.loaders.controls.js');
$s = strlen($f);
echo "// $s $f";