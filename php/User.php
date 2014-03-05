<?php

class User {
    static function getData($username) {
        require('db.php');

        $sth = $dbh->query("SELECT userId, email, timestamp, username FROM users WHERE username='$username'");
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

        $sth = $dbh->query("SELECT envId, timestamp, latitude, longitude, name FROM environments WHERE userId='$userId' ORDER BY envId DESC");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetchAll();

        return $result;
    }

    static function getTotalParticipants() {
        require('db.php');

        $sth = $dbh->query("SELECT COUNT(*) FROM users");
        $sth->setFetchMode(PDO::FETCH_NUM);
        $result = $sth->fetch();

        return $result[0];
    }
}