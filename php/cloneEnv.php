<?php
session_start();
require('db.php');

$latitude      = $_POST['cLat'];
$longitude     = $_POST['cLon'];
$heightsString = $_POST['h'];
$resolution    = $_POST['r'];
$tileSize      = $_POST['t'];
$name          = strip_tags($_POST['n']);
$userId        = $_SESSION['userId'];

// Generate the height map
$img = imagecreatetruecolor($resolution, $resolution);

$rows = explode('-', $heightsString);

foreach($rows as $y => $row) {
    $columns = explode(',', $row);
    foreach($columns as $x => $column) {
        $colour = imagecolorallocate($img, $column, $column, $column);
        imagesetpixel($img, $x, $y, $colour);
    }
}

// Resize the height map
$scaledImg = imagecreatetruecolor($tileSize, $tileSize);
imagecopyresampled($scaledImg, $img, 0, 0, 0, 0, $tileSize, $tileSize, $resolution, $resolution);

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

$_SESSION['envId']  = $dbh->lastInsertId();
$_SESSION['envURL'] = "/user/{$_SESSION['username']}/env/{$_SESSION['envId']}";
$_SESSION['lat']    = $latitude;
$_SESSION['lon']    = $longitude;

// Save height map and clean up
imagepng($scaledImg, "../img/user/$userId/height-map-{$_SESSION['envId']}.png");
imagedestroy($scaledImg);