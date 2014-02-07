<?php

class MailClient {
    function send_msg($email, $subject, $msg) {
        $headers = 'From: info@cell.dev';
        mail($email, $subject, $msg, $headers);
    }
}