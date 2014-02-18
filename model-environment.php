<?php

$envVars    = explode('/', $q);
$userHandle = $envVars[1];
$envId      = $envVars[3];

require_once('php/Environment.php');
$env = Environment::getData($envId);

if($env) {
    $file = 'environment';
} else {
    $file = '404';
}