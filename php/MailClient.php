<?php

class MailClient {
    static function sendMsg($email, $subject, $msg) {
        $headers = 'From: info@cell-industries.co.uk';
        mail($email, $subject, $msg, $headers);
    }
}