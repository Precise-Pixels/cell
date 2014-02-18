<?php

$username = explode('/', $q)[1];

require_once('php/User.php');
$user = User::getData($username);

if($user) {
    $environments = User::getEnvironments($username);
    $file = 'user-profile';
} else {
    $file = '404';
}