<?php if($_SERVER['SERVER_NAME'] == 'cell.dev'):
// SANDBOX ?>

    <script src="/js/all.js"></script>

    <?php if($isProgress): ?>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCNlx7Q6EFJ2nlJfkAnMIsCm94fdSzaqf4&sensor=false&libraries=places"></script>
        <script src="/js/page-progress.js"></script>
    <?php endif; ?>

    <?php if($isTechnology): ?>
        <script src="/js/threejs-loaders-controls-stackblur.js"></script>
        <script src="/js/page-technology.js"></script>
    <?php endif; ?>

    <?php if($isCloningProcess): ?>
        <script src='/js/page-the-cloning-process.js'></script>
    <?php endif; ?>

    <?php if($isUser && isset($_SESSION['userId'])): ?>
        <script src='/js/page-user-profile.js'></script>
    <?php endif; ?>

    <?php if($isEnv): ?>
        <script>
            var userId    = <?= $userUserId; ?>;
            var username  = '<?= $userUsername; ?>';
            var envId     = <?= $envId; ?>;
            var latitude  = <?= $env->latitude; ?>;
            var longitude = <?= $env->longitude; ?>;
        </script>
        <script src="/js/threejs-loaders-controls-stackblur.js"></script>
        <script src="/js/page-environment.js"></script>
        <script src="/js/gesture.js"></script>
        <div id="fb-root"></div>
        <script>(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(d.getElementById(id))return;js=d.createElement(s);js.id=id;js.src="//connect.facebook.net/en_GB/all.js#xfbml=1&appId=140539425969500";fjs.parentNode.insertBefore(js,fjs);}(document,'script','facebook-jssdk'));</script>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','twitter-wjs');</script>
    <?php endif; ?>

    <?php if($isNewEnv): ?>
        <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCNlx7Q6EFJ2nlJfkAnMIsCm94fdSzaqf4&sensor=false&libraries=places'></script>
        <script src='/js/page-new-environment.js'></script>
    <?php endif; ?>

    <?php if($isCapturing): ?>
        <script src="/js/threejs-loaders-controls-stackblur.js"></script>
        <script src="/js/page-capturing-environment.js"></script>
    <?php endif; ?>

    <?php if($isAbout): ?>
        <script src="/js/timeline-scroll.js"></script>
    <?php endif; ?>

<?php else:
// LIVE ?>

    <script src="/build/all.min.js"></script>

    <?php if($isProgress): ?>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCNlx7Q6EFJ2nlJfkAnMIsCm94fdSzaqf4&sensor=false&libraries=places"></script>
        <script src="/build/page-progress.min.js"></script>
    <?php endif; ?>

    <?php if($isTechnology): ?>
        <script src="/build/threejs-loaders-controls-stackblur.min.js"></script>
        <script src="/build/page-technology.min.js"></script>
    <?php endif; ?>

    <?php if($isCloningProcess): ?>
        <script src='/build/page-the-cloning-process.min.js'></script>
    <?php endif; ?>

    <?php if($isUser && isset($_SESSION['userId'])): ?>
        <script src='/build/page-user-profile.min.js'></script>
    <?php endif; ?>

    <?php if($isEnv): ?>
        <script>var userId=<?= $userUserId; ?>,username='<?= $userUsername; ?>',envId=<?= $envId; ?>,latitude=<?= $env->latitude; ?>,longitude=<?= $env->longitude; ?>;</script>
        <script src="/build/threejs-loaders-controls-stackblur.min.js"></script>
        <script src="/build/page-environment.min.js"></script>
        <script src="/build/gesture.min.js"></script>
        <div id="fb-root"></div>
        <script>(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(d.getElementById(id))return;js=d.createElement(s);js.id=id;js.src="//connect.facebook.net/en_GB/all.js#xfbml=1&appId=140539425969500";fjs.parentNode.insertBefore(js,fjs);}(document,'script','facebook-jssdk'));</script>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','twitter-wjs');</script>
    <?php endif; ?>

    <?php if($isNewEnv): ?>
        <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCNlx7Q6EFJ2nlJfkAnMIsCm94fdSzaqf4&sensor=false&libraries=places'></script>
        <script src='/build/page-new-environment.min.js'></script>
    <?php endif; ?>

    <?php if($isCapturing): ?>
        <script src="/build/threejs-loaders-controls-stackblur.min.js"></script>
        <script src="/build/page-capturing-environment.min.js"></script>
    <?php endif; ?>

    <?php if($isAbout): ?>
        <script src="/build/timeline-scroll.min.js"></script>
    <?php endif; ?>

    <script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');ga('create','UA-26844628-2','cell-industries.co.uk');ga('send','pageview');</script>

<?php endif; ?>