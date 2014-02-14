<?php require_once('includes/session.php'); ?>

<!DOCTYPE HTML>
<html>
<head>
    <?php require_once('includes/head.php'); ?>
</head>
<body>
    <?php require_once('includes/header.php'); ?>
    <?php require_once("views/$file.php"); ?>
    <?php require_once('includes/footer.php'); ?>
    <?php require_once('includes/scripts.php'); ?>
</body>
</html>