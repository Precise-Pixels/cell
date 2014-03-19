<?php
session_start();

require('db.php');

$location = $_POST['location'];
$facebook = $_POST['facebook'];
$twitter  = $_POST['twitter'];

$sth = $dbh->prepare("UPDATE users SET location=:location, facebook=:facebook, twitter=:twitter WHERE userId=:userId");
$sth->bindParam(':location', $location);
$sth->bindParam(':facebook', $facebook);
$sth->bindParam(':twitter', $twitter);
$sth->bindParam(':userId', $_SESSION['userId']);
$result = $sth->execute();