<?php

class User {
    function getData($userHandle) {
        require('db.php');

        // Check to see whether the $userHandle is an ID or a username
        if(intval($userHandle) !== 0) {
            $userHandleColumn = 'userId';
        } else {
            $userHandleColumn = 'username';
        }

        $sth = $dbh->query("SELECT timestamp, username FROM users WHERE $userHandleColumn='$userHandle'");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $result = $sth->fetch();

        return $result;
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