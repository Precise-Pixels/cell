<?php

class User {
    function getData($username) {
        require('db.php');

        $sth = $dbh->query("SELECT * FROM users WHERE username='$username'");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetch();
    }

    function getUserHandle($userId) {
        require('db.php');
        $username = false;

        $sth = $dbh->query("SELECT username FROM users WHERE userId='$userId'");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetch();

        $username = $result->username;

        if($username != '') {
            return $username;
        } else {
            return $userId;
        }
    }
}