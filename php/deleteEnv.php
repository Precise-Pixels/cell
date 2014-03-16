<?php

require('db.php');

$envDeleteId = $_POST['envDeleteId'];

$sth = $dbh->prepare("DELETE FROM environments WHERE envId=:envDeleteId");
$sth->bindParam(':envDeleteId', $envDeleteId);
$result = $sth->execute();