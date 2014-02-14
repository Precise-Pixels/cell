<?php

class Environment {
    function getData($envId) {
        require('db.php');

        $sth = $dbh->query("SELECT userId, timestamp, latitude, longitude, elevationString FROM environments WHERE envId='$envId'");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetch();

        return $result;
    }
}