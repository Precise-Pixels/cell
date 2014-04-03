<?php

$envVars      = explode('/', $q);
$userUsername = $envVars[1];
$envId        = $envVars[3];

require_once('php/User.php');
$userUserId = User::getUserId($userUsername);

require_once('php/Environment.php');
$env = Environment::getData($envId, $userUserId);

if($env) {
    $file = 'environment';
} else {
    $file = '404';
}