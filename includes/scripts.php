<?php if($_SERVER['SERVER_NAME'] == 'cell.dev'):
// SANDBOX ?>

    <?php if($isHome): ?>
        <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCNlx7Q6EFJ2nlJfkAnMIsCm94fdSzaqf4&sensor=false&libraries=places'></script>
        <script src='/js/page-home.js'></script>
    <?php endif; ?>

    <?php if($isAbout): ?>
        <script src='/js/timeline-scroll.js'></script>
    <?php endif; ?>

    <?php if($isUser): ?>
        <script src='/js/page-user-profile.js'></script>
    <?php endif; ?>

    <?php if($isEnv): ?>
        <script>
            var userId    = <?= $userId; ?>;
            var envId     = <?= $envId; ?>;
            var latitude  = <?= $env->latitude; ?>;
            var longitude = <?= $env->longitude; ?>;
        </script>
        <script src="/js/threejs-tweenjs-stats-loaders-controls.js"></script>
        <script src="/js/env.js"></script>
        <script src="/js/gesture.js"></script>
    <?php endif; ?>

    <?php if($isNewEnv): ?>
        <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCNlx7Q6EFJ2nlJfkAnMIsCm94fdSzaqf4&sensor=false&libraries=places'></script>
        <script src='/js/new-env.js'></script>
    <?php endif; ?>

    <?php if($isCapturing): ?>
        <script src="/js/threejs-tweenjs-stats-loaders-controls.js"></script>
        <script src="/js/capture-env.js"></script>
    <?php endif; ?>

    <script src='/js/respond.min.js'></script>
    <script src='/js/all.js'></script>

<?php else:
// LIVE ?>

    <?php if($isHome): ?>
        <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCNlx7Q6EFJ2nlJfkAnMIsCm94fdSzaqf4&sensor=false&libraries=places'></script>
        <script src='/build/page-home.min.js'></script>
    <?php endif; ?>

    <?php if($isAbout): ?>
        <script src='/build/timeline-scroll.min.js'></script>
    <?php endif; ?>

    <?php if($isUser): ?>
        <script src='/build/page-user-profile.min.js'></script>
    <?php endif; ?>

    <?php if($isEnv): ?>
        <script>var userId=<?= $userId; ?>,envId=<?= $envId; ?>,latitude=<?= $env->latitude; ?>,longitude=<?= $env->longitude; ?>;</script>
        <script src="/build/threejs-tweenjs-stats-loaders-controls.min.js"></script>
        <script src="/build/env.min.js"></script>
        <script src="/build/gesture.min.js"></script>
    <?php endif; ?>

    <?php if($isNewEnv): ?>
        <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCNlx7Q6EFJ2nlJfkAnMIsCm94fdSzaqf4&sensor=false&libraries=places'></script>
        <script src='/build/new-env.min.js'></script>
    <?php endif; ?>

    <?php if($isCapturing): ?>
        <script src="/build/threejs-tweenjs-stats-loaders-controls.min.js"></script>
        <script src="/build/capture-env.min.js"></script>
    <?php endif; ?>

    <script src='/build/respond.min.js'></script>
    <script src='/build/all.min.js'></script>

    <script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');ga('create','UA-26844628-2','precisepixels.co.uk');ga('send','pageview');</script>

<?php endif; ?>