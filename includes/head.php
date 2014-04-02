<meta charset="utf-8">
<meta name="description" content="Cell Industries presents Project Titan - Preserving The Planet"/>
<meta name="author" content="Precise Pixels"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
<title>Cell Industries</title>
<?php if($_SERVER['SERVER_NAME'] == 'cell.dev'): ?>
    <link rel="stylesheet" type="text/css" href="/css/styles.css"/>
<?php else: ?>
    <link rel="stylesheet" type="text/css" href="/build/styles.min.css"/>
<?php endif; ?>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="/img/favicon.ico"/>
<link rel="apple-touch-icon-precomposed" href="/img/touchicon-57.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/img/touchicon-72.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/img/touchicon-114.png">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/img/touchicon-144.png">

<?php if($isEnv): ?>
    <meta property="og:title" content="I just cloned part of the planet! Clone your part now! #PreservingThePlanet #ProjectTitan"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="<?= $currentUrl; ?>"/>
    <meta property="og:image" content="http://<?= $_SERVER['HTTP_HOST']; ?>/img/user/<?= $env->userId; ?>/capture-<?= $envId; ?>.jpg" />
    <meta property="og:site_name" content="Cell Industries"/>
    <meta property="og:description" content="Cell Industries presents Project Titan - Preserving The Planet"/>
    <meta property="article:published_time" content="<?= $env->timestamp; ?>">
<?php else: ?>
    <meta property="og:title" content="Cell Industries"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="http://cell-industries.co.uk"/>
    <meta property="og:image" content="http://cell-industries.co.uk/img/touchicon-144.png"/>
    <meta property="og:site_name" content="Cell Industries"/>
    <meta property="og:description" content="Cell Industries presents Project Titan - Preserving The Planet"/>
<?php endif; ?>

<!--[if lte IE 9]>
<style>
    .cube > div {
        display: none;
    }

    #ig-slides #ig-cta {
        display: none;
    }
</style>
<![endif]-->

<!--[if lt IE 9]>
<style>
    .site-nav--open #site-nav {
        left: 0;
    }

    .ball {
        display: none;
    }

    #fixed-header {
        background: #333;
    }
</style>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<script src="/build/respond.min.js"></script>
<script src="/build/ie8.min.js"></script>
<![endif]-->