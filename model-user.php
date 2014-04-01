<?php

$userVars     = explode('/', $q);
$userUsername = $userVars[1];

if(isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

require_once('php/User.php');
$user = User::getData($userUsername);

if($user) {
    $environments      = User::getEnvironments($userUsername, $page);
    $totalEnvironments = User::getTotalEnvironments($userUsername);
    $file = 'user-profile';
} else {
    $file = '404';
}