<?php

class Environment {
    static function getData($envId, $userId) {
        require('db.php');

        $sth = $dbh->query("SELECT environments.userId, environments.timestamp, latitude, longitude, elevationString, name, email FROM environments INNER JOIN users ON environments.userId=users.userId WHERE environments.envId='$envId' AND environments.userId='$userId'");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetch();

        return $result;
    }

    static function getRecentEnvironments($page) {
        require('db.php');

        if(is_numeric($page) && $page >= 1) {
            $offset = $page * 12 - 12;
        } else {
            $offset = 0;
        }

        $sth = $dbh->prepare("SELECT envId, users.userId, name, username FROM environments INNER JOIN users ON environments.userId=users.userId ORDER BY envId DESC LIMIT :offset, 12");
        $sth->bindParam('offset', $offset, PDO::PARAM_INT);
        $sth->execute();
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetchAll();

        return $result;
    }

    static function getTotalEnvironments() {
        require('db.php');

        $sth = $dbh->query("SELECT envId FROM environments");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetchAll();

        return $result;
    }
}