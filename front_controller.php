<?php

$path = preg_replace('/\/$|.php/', '', $_GET['q']);
$file = (empty($path)) ? 'index' : (file_exists("views/$path.php") ? $path : '404');
require_once('front_view.php');