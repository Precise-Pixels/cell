<main>

    <header>
        <hgroup class="align-vertical">
            <a href="/user/<?= $username ?>">
                <img src="http://www.gravatar.com/avatar/<?= (isset($env->email) ? md5(strtolower(trim($env->email))) : 1); ?>?d=mm&amp;s=60" alt="<?= $username ?>"/>
            </a>
            <h1><?= $env->name; ?></h1>
            <h2><i class="ico-pin"></i><?= $env->latitude; ?>, <?= $env->longitude; ?></h2>
        </hgroup>
    </header>

    <section id="env-interface">
        <div id="model"><img src="/img/user/<?= $env->userId; ?>/capture-<?= $envId; ?>.jpg" alt="<?= $env->name; ?>"/></div>
        <div id="env-interface-elements">
            <div id="model-interaction" class="sdgrey">
                <h1><i class="ico-interact"></i>INTERACT</h1>
                <div id="default" class="btn btn--selected" title="Drag"><i class="ico-hand"></i></div>
                <div id="webcam" class="btn" title="Webcam"><i class="ico-webcam"></i></div>
            </div>
            <div id="env-map" class="env-interface-element">
                <img src="http://maps.googleapis.com/maps/api/staticmap?center=<?= $env->latitude; ?>,<?= $env->longitude; ?>&zoom=10&size=380x380&scale=2&maptype=hybrid&sensor=false&key=AIzaSyCNlx7Q6EFJ2nlJfkAnMIsCm94fdSzaqf4">
            </div>
            <section id="env-data"></section>
            <div id="env-share" class="env-interface-element">
                <h1><i class="ico-share"></i>SHARE</h1>
                <div class="fb-share-button" data-href="http://<?= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" data-type="button_count"></div>
                <a href="https://twitter.com/share?url=http://<?= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>&amp;text=I just cloned part of the planet! Clone your part now!&hashtags=PreservingThePlanet,ProjectTitan,CellIndustries" class="twitter-share-button">Tweet</a>
                <div class="g-plus" data-action="share" data-annotation="bubble" data-href="http://<?= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>"></div>
            </div>
        </div>
    </section>

<!--     <video id="video" autoplay></video>
    <canvas id="canvas"></canvas>
    <canvas id="comp"></canvas>

    <label for="sensitivity">more sensitive</label> <input type="radio" name="sensitivity">
    <label for="sensitivity">average</label> <input type="radio" name="sensitivity" checked>
    <label for="sensitivity">less sensitive</label> <input type="radio" name="sensitivity"> -->

    <!-- <div id="background"><img src="/img/user/<?= $env->userId; ?>/capture-<?= $envId; ?>.jpg" alt="<?= $env->name; ?>"/></div> -->
</main>

<div id="full-page-overlay" class="full-page-overlay full-page-overlay--loading"></div>

<div id="background-top"></div>
<div id="background"><img src="/img/user/<?= $env->userId; ?>/capture-<?= $envId; ?>.jpg" alt="<?= $env->name; ?>"/></div>