<?php

class Environment {
    static function getData($envId, $userId) {
        require('db.php');

        $sth = $dbh->query("SELECT userId, timestamp, latitude, longitude, elevationString, name FROM environments WHERE envId='$envId' AND userId='$userId'");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetch();

        return $result;
    }
}