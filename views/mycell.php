<?php
    if($_SESSION['status'] != 'loggedin') {
        $_SESSION['status'] = 'notloggedin';
        header('location: /login');
    }
?>

<h1>MYCELL</h1>