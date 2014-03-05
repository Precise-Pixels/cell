<?php if($_SERVER['SERVER_NAME'] == 'cell.dev'):
// SANDBOX ?>

    <script src='/js/respond.min.js'></script>
    <script src='/js/all.js'></script>

    <?php if($isHome): ?>
        <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCNlx7Q6EFJ2nlJfkAnMIsCm94fdSzaqf4&sensor=false&libraries=places'></script>
        <script src='/js/page-home.js'></script>
    <?php endif; ?>

    <?php if($isAbout): ?>
        <script src='/js/timeline-scroll.js'></script>
    <?php endif; ?>

    <?php if($isEnv): ?>
        <script>
            var userId    = <?= $userId; ?>;
            var envId     = <?= $envId; ?>;
            var latitude  = <?= $env->latitude; ?>;
            var longitude = <?= $env->longitude; ?>;
        </script>
        <script src="/js/env.js"></script>
        <script src="/js/gesture.js"></script>
    <?php endif; ?>

    <?php if($isNewEnv): ?>
        <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCNlx7Q6EFJ2nlJfkAnMIsCm94fdSzaqf4&sensor=false&libraries=places'></script>
        <script src='/js/new-env.js'></script>
    <?php endif; ?>

    <?php if($isCapturing): ?>
        <script src="/js/threejs-tweenjs-stats-loaders-controls-stackblur.js"></script>
        <script src="/js/capture-env.js"></script>
    <?php endif; ?>

<?php else:
// LIVE ?>

    <script src='/build/respond.min.js'></script>
    <script src='/build/all.min.js'></script>

    <?php if($isHome): ?>
        <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCNlx7Q6EFJ2nlJfkAnMIsCm94fdSzaqf4&sensor=false&libraries=places'></script>
        <script src='/build/page-home.min.js'></script>
    <?php endif; ?>

    <?php if($isAbout): ?>
        <script src='/build/timeline-scroll.min.js'></script>
    <?php endif; ?>

    <?php if($isEnv): ?>
        <script>var userId=<?= $userId; ?>,envId=<?= $envId; ?>,latitude=<?= $env->latitude; ?>,longitude=<?= $env->longitude; ?>;</script>
        <script src="/build/env.min.js"></script>
        <script src="/build/gesture.min.js"></script>
    <?php endif; ?>

    <?php if($isNewEnv): ?>
        <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCNlx7Q6EFJ2nlJfkAnMIsCm94fdSzaqf4&sensor=false&libraries=places'></script>
        <script src='/build/new-env.min.js'></script>
    <?php endif; ?>

    <?php if($isCapturing): ?>
        <script src="/build/threejs-tweenjs-stats-loaders-controls-stackblur.min.js"></script>
        <script src="/build/capture-env.min.js"></script>
    <?php endif; ?>

<?php endif; ?>