<?php
session_start();
require('db.php');

$latitude      = $_POST['cLat'];
$longitude     = $_POST['cLon'];
$heightsString = $_POST['h'];
$resolution    = $_POST['r'];
$tileSize      = $_POST['t'];
$userId        = $_SESSION['userId'];

// Generate the height map
$imgWidth = $imgHeight = $resolution;

$img = imagecreatetruecolor($imgWidth, $imgHeight);

$rows = explode('-', $heightsString);

foreach($rows as $y => $row) {
    $columns = explode(',', $row);
    foreach($columns as $x => $column) {
        $colour = imagecolorallocate($img, $column, $column, $column);
        imagesetpixel($img,$x,$y,$colour);
    }
}

// Resize and blur the height map
$scaledImg = imagecreatetruecolor($tileSize, $tileSize);
imagecopyresampled($scaledImg, $img, 0, 0, 0, 0, $tileSize, $tileSize, $resolution, $resolution);

for ($i = 1; $i < 10; $i++) {
    imagefilter($scaledImg, IMG_FILTER_GAUSSIAN_BLUR);
}

// Save the data in the database
$timestamp = date("Y-m-d H:i:s");

$sth = $dbh->prepare("INSERT INTO environments (userId, timestamp, latitude, longitude, elevationString) VALUE (:userId, :timestamp, :latitude, :longitude, :elevationString)");
$sth->bindParam(':userId', $userId);
$sth->bindParam(':timestamp', $timestamp);
$sth->bindParam(':latitude', $latitude);
$sth->bindParam(':longitude', $longitude);
$sth->bindParam(':elevationString', $heightsString);
$sth->execute();

// If the directory doesn't already exist, create it
if(!is_dir("../img/user/$userId")) {
    mkdir("../img/user/$userId", 0777, true);
}

// Save height map and clean up
imagepng($scaledImg, "../img/user/$userId/height-map-{$dbh->lastInsertId()}.png");
imagedestroy($scaledImg);