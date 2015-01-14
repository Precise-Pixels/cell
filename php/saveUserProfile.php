<?php
session_start();

require('db.php');

$location = strip_tags($_POST['location']);
$facebook = strip_tags($_POST['facebook']);
$twitter  = strip_tags($_POST['twitter']);

if(strpos($facebook, '/') === 0) {
    $facebook = substr($facebook, 1);
}

if(strpos($twitter, '@') === 0) {
    $twitter = substr($twitter, 1);
}

$sth = $dbh->prepare("UPDATE users SET location=:location, facebook=:facebook, twitter=:twitter WHERE userId=:userId");
$sth->bindParam(':location', $location);
$sth->bindParam(':facebook', $facebook);
$sth->bindParam(':twitter', $twitter);
$sth->bindParam(':userId', $_SESSION['userId']);
$result = $sth->execute();