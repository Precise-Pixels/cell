<?php require_once('includes/session.php'); ?>

<!DOCTYPE HTML>
<html class="no-webgl no-webrtc">
<head>
    <?php require_once('includes/head.php'); ?>
</head>
<body class="<?= ($isEnv) ? 'env' : ''; ?>">
    <?php require_once('includes/header.php'); ?>
    <?php require_once("views/$file.php"); ?>
    <?php require_once('includes/footer.php'); ?>
    <?php require_once('includes/scripts.php'); ?>
</body>
</html>