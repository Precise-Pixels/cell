<?php

$userHandle = explode('/', $q)[1];

require_once('php/User.php');
$userInstance = new User;
$user         = $userInstance->getData($userHandle);
$environments = $userInstance->getEnvironments($userHandle);

if($user) {
    $file = 'user-profile';
} else {
    $file = '404';
}