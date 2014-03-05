<?php

$lat = $_GET['lat'];
$lon = $_GET['lon'];

$img = imagecreatefrompng("http://maps.googleapis.com/maps/api/staticmap?center=$lat,$lon&zoom=11&size=640x640&scale=2&maptype=satellite&sensor=false&key=AIzaSyCNlx7Q6EFJ2nlJfkAnMIsCm94fdSzaqf4");

header('Content-Type: image/jpeg');
imagejpeg($img);
imagedestroy($img);