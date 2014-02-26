<?php
session_start();

$string = $_POST['s'];
$data = base64_decode($string);

$img = imagecreatefromstring($data);

imagejpeg($img, "../img/user/{$_SESSION['userId']}/capture-{$_SESSION['envId']}.jpg", 70);
imagedestroy($img);