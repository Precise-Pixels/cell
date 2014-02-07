<?php

class Encryption {
    function encrypt($str) {
        $salt = '$2a$05$' . hash('sha256', $str);
        $encrypted = crypt($str, $salt);
        return $encrypted;
    }
}