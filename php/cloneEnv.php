<?php
session_start();
require('db.php');

$latitude      = $_POST['cLat'];
$longitude     = $_POST['cLon'];
$heightsString = $_POST['h'];
$resolution    = $_POST['r'];
$tileSize      = $_POST['t'];
$name          = $_POST['n'];
$userId        = $_SESSION['userId'];

// Generate the height map
$img = imagecreatetruecolor(1282, 1282);
$map = imagecreatetruecolor($resolution, $resolution);

$rows = explode('-', $heightsString);

foreach($rows as $y => $row) {
    $columns = explode(',', $row);
    foreach($columns as $x => $column) {
        $colour = imagecolorallocate($map, $column, $column, $column);
        imagesetpixel($map, $x, $y, $colour);
    }
}

// Resize and blur the height map
$scaledImg = imagecreatetruecolor($tileSize, $tileSize);
imagecopyresampled($scaledImg, $map, 0, 0, 0, 0, $tileSize, $tileSize, $resolution, $resolution);

for ($i = 1; $i < 50; $i++) {
    imagefilter($scaledImg, IMG_FILTER_GAUSSIAN_BLUR);
}

imagecopy($img, $scaledImg, 1, 1, 0, 0, 1280, 1280);

// Save the data in the database
$timestamp = date("Y-m-d H:i:s");

$sth = $dbh->prepare("INSERT INTO environments (userId, timestamp, latitude, longitude, elevationString, name) VALUE (:userId, :timestamp, :latitude, :longitude, :elevationString, :name)");
$sth->bindParam(':userId', $userId);
$sth->bindParam(':timestamp', $timestamp);
$sth->bindParam(':latitude', $latitude);
$sth->bindParam(':longitude', $longitude);
$sth->bindParam(':elevationString', $heightsString);
$sth->bindParam(':name', $name);
$sth->execute();

// If the directory doesn't already exist, create it
if(!is_dir("../img/user/$userId")) {
    mkdir("../img/user/$userId", 0777, true);
}

// Save height map and clean up
imagepng($img, "../img/user/$userId/height-map-{$dbh->lastInsertId()}.png");
imagedestroy($img);

header("X-Env-URL: /user/{$_SESSION['username']}/env/{$dbh->lastInsertId()}");