<?php

$lat = $_GET['lat'];
$lon = $_GET['lon'];

$img    = imagecreatetruecolor(1296, 1296);
$sdgrey = imagecolorallocate($img, 34, 34, 34);
imagefill($img, 0, 0, $sdgrey);

$tex = imagecreatefrompng("http://maps.googleapis.com/maps/api/staticmap?center=$lat,$lon&zoom=11&size=640x640&scale=2&maptype=satellite&sensor=false&key=AIzaSyCNlx7Q6EFJ2nlJfkAnMIsCm94fdSzaqf4");

imagecopy($img, $tex, 8, 8, 0, 0, 1280, 1280);

header('Content-Type: image/jpeg');
imagejpeg($img);
imagedestroy($img);