<?php

class Environment {
    function getData($username, $envId) {
        require('db.php');

        $STH = $DBH->query("SELECT * FROM environments WHERE username='$username'");
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $result = $STH->fetch();
    }
}