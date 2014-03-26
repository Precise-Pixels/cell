<?php
session_start();

require('db.php');

$envDeleteId = $_POST['envDeleteId'];

$sth = $dbh->prepare("DELETE FROM environments WHERE envId=:envDeleteId");
$sth->bindParam(':envDeleteId', $envDeleteId);
$result = $sth->execute();

unlink("../img/user/{$_SESSION['userId']}/capture-$envDeleteId.jpg");
unlink("../img/user/{$_SESSION['userId']}/height-map-$envDeleteId.png");