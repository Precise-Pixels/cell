<?php

class MailClient {
    static function sendMsg($email, $subject, $msg) {
        $headers = 'From: info@cell.dev';
        mail($email, $subject, $msg, $headers);
    }
}