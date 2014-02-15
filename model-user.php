<?php

$userHandle = explode('/', $q)[1];

require_once('php/User.php');
$userInstance = new User;
$user         = $userInstance->getData($userHandle);

if($user) {
    $environments = $userInstance->getEnvironments($userHandle);
    $file = 'user-profile';
} else {
    $file = '404';
}