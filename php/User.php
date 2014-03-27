<?php

class User {
    static function getData($username) {
        require('db.php');

        $sth = $dbh->query("SELECT userId, email, timestamp, username, location, facebook, twitter FROM users WHERE username='$username'");
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

    static function getEnvironments($username, $page) {
        require('db.php');

        $userId = User::getUserId($username);

        if(is_numeric($page) && $page >= 1) {
            $offset = $page * 12 - 12;
        } else {
            $offset = 0;
        }

        $sth = $dbh->prepare("SELECT envId, timestamp, latitude, longitude, name FROM environments WHERE userId='$userId' ORDER BY envId DESC LIMIT :offset, 12");
        $sth->bindParam('offset', $offset, PDO::PARAM_INT);
        $sth->execute();
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetchAll();

        return $result;
    }

    static function getTotalEnvironments($username) {
        require('db.php');

        $userId = User::getUserId($username);

        $sth = $dbh->query("SELECT envId FROM environments WHERE userId='$userId'");
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