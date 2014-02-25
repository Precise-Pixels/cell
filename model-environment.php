<?php

$envVars  = explode('/', $q);
$username = $envVars[1];
$envId    = $envVars[3];

require_once('php/User.php');
$userId = User::getUserId($username);

require_once('php/Environment.php');
$env = Environment::getData($envId, $userId);

if($env) {
    $file = 'environment';
} else {
    $file = '404';
}