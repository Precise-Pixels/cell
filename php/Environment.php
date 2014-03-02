<?php

class Environment {
    static function getData($envId, $userId) {
        require('db.php');

        $sth = $dbh->query("SELECT userId, timestamp, latitude, longitude, elevationString, name FROM environments WHERE envId='$envId' AND userId='$userId'");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetch();

        return $result;
    }

    static function getRecentEnvironments() {
        require('db.php');

        $sth = $dbh->query("SELECT envId, users.userId, name, username FROM environments INNER JOIN users ON environments.userId=users.userId ORDER BY envId DESC LIMIT 12");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetchAll();

        return $result;
    }
}