<?php

$lat = $_GET['lat'];
$lon = $_GET['lon'];

$img = imagecreatefrompng("http://maps.googleapis.com/maps/api/staticmap?center=$lat,$lon&zoom=11&size=640x640&scale=2&maptype=satellite&sensor=false");

header('Content-Type: image/png');
imagepng($img);
imagedestroy($img);