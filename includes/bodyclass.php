<?php
$url = parse_url($_SERVER['REQUEST_URI']);
$path = explode('/', $url['path']);
echo (empty($path[count($path)-1]) ? 'index' : $path[count($path)-1]);