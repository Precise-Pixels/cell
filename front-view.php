<!DOCTYPE HTML>
<html class="no-webgl no-webrtc no-cssfilter">
<head>
    <?php require_once('includes/head.php'); ?>
</head>
<body class="<?= ($isCloningProcess) ? 'the-cloning-process' : ''; ?><?= ($isEnv) ? 'env' : ''; ?>">
    <?php require_once('includes/cookies.php'); ?>
    <?php require_once('includes/header.php'); ?>
    <?php require_once("views/$file.php"); ?>
    <?php require_once('includes/footer.php'); ?>
    <?php require_once('includes/scripts.php'); ?>
</body>
</html>