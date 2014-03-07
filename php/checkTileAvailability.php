<?php

require('db.php');

$latitude  = $_POST['cLat'];
$longitude = $_POST['cLon'];

$sth = $dbh->query("SELECT latitude, longitude FROM environments WHERE latitude='$latitude' AND longitude='$longitude'");
$sth->execute();

echo ($sth->rowCount() == 0 ? true : false);