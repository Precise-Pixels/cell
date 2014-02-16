<?php

$userHandle = explode('/', $q)[1];

require_once('php/User.php');
$user = User::getData($userHandle);

if($user) {
    $environments = User::getEnvironments($userHandle);
    $file = 'user-profile';
} else {
    $file = '404';
}