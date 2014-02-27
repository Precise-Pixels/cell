<?php

require('db.php');

$sth = $dbh->query("SELECT envId, latitude, longitude, username FROM environments RIGHT JOIN users ON environments.userId=users.userId");
$sth->setFetchMode(PDO::FETCH_OBJ);
$result = $sth->fetchAll();

echo json_encode($result);