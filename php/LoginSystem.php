<?php

class LoginSystem {
    function validate_user($username, $password) {
        require_once('db.php');
        require_once('php/Encryption.php');
        $encryption = new Encryption;
        $password_e = $encryption->encrypt($password);

        $STH = $DBH->query("SELECT password FROM users WHERE username='$username'");
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $row = $STH->fetch();

        if($row) {
            if($row->password === $password_e) {
                $_SESSION['status'] = 'loggedin';
                header('location: /mycell');
            } else {
                return 'Wrong username and/or password';
            }
        } else {
            return 'Wrong username and/or password';
        }
    }

    function logout() {
        unset($_SESSION['status']);
        $referer = parse_url($_SERVER['HTTP_REFERER']);
        $referer_path = $referer['path'];
        header("location: $referer_path");
    }
}