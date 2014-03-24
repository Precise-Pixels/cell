<?php

require('db.php');

$latitude  = $_POST['cLat'];
$longitude = $_POST['cLon'];

$sth = $dbh->query("SELECT envId, latitude, longitude, users.username FROM environments INNER JOIN users ON environments.userId=users.userId WHERE latitude='$latitude' AND longitude='$longitude'");
$sth->setFetchMode(PDO::FETCH_OBJ);
$result = $sth->fetch();

echo ($sth->rowCount() == 0 ? 'true' : 'false');

if($sth->rowCount() != 0) {
    echo "/user/$result->username/env/$result->envId";
}