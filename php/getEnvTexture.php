<?php

$lat = $_GET['lat'];
$lon = $_GET['lon'];

$img = imagecreatetruecolor(1380, 1380);
$texture = imagecreatefrompng("http://maps.googleapis.com/maps/api/staticmap?center=$lat,$lon&zoom=11&size=640x640&scale=2&maptype=satellite&sensor=false&key=AIzaSyCNlx7Q6EFJ2nlJfkAnMIsCm94fdSzaqf4");

imagecopy($img, $texture, 50, 50, 0, 0, 1280, 1280);

header('Content-Type: image/png');
imagepng($img);
imagedestroy($img);