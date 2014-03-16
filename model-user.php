<?php

$userVars = explode('/', $q);
$username = $userVars[1];

if(isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

require_once('php/User.php');
$user = User::getData($username);

if($user) {
    $environments = User::getEnvironments($username, $page);
    $file = 'user-profile';
} else {
    $file = '404';
}