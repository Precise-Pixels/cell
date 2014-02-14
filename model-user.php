<?php

$userHandle = explode('/', $q)[1];

require_once('php/User.php');
$user = new User();

$user = $user->getData($userHandle);

if($user) {
    $file = 'user-profile';
} else {
    $file = '404';
}

// ---

