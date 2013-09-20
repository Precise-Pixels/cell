<?php require_once('includes/session.php'); ?>

<!DOCTYPE HTML>
<html>
<head>
    <?php require_once('includes/head.php'); ?>
</head>
<body>
    <?php require_once('includes/logout_button.php'); ?>
    <?php require_once("views/$file.php"); ?>
    <?php require_once('includes/scripts.php'); ?>
</body>
</html>