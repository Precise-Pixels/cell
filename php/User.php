<?php

class User {
    function getData($username) {
        require('db.php');

        $STH = $DBH->query("SELECT * FROM users WHERE username='$username'");
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $result = $STH->fetch();
    }
}