<?php

class User {
    static function getData($username) {
        require('db.php');

        $sth = $dbh->query("SELECT userId, timestamp, username FROM users WHERE username='$username'");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetch();

        return $result;
    }

    static function getUserId($username) {
        require('db.php');

        $sth = $dbh->query("SELECT userId FROM users WHERE username='$username'");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetch();

        return $result->userId;
    }

    static function getEnvironments($username) {
        require('db.php');

        $userId = User::getUserId($username);

        $sth = $dbh->query("SELECT timestamp, latitude, longitude FROM environments WHERE userId='$userId'");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetchAll();

        return $result;
    }
}