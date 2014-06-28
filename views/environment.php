<main>

    <header>
        <hgroup class="align-vertical">
            <a href="/user/<?= $userUsername ?>">
                <img src="http://www.gravatar.com/avatar/<?= (isset($env->email) ? md5(strtolower(trim($env->email))) : 1); ?>?d=mm&amp;s=60" alt="<?= $userUsername ?>"/>
            </a>
            <h1><?= $env->name; ?></h1>
            <h2><i class="ico-pin"></i><?= $env->latitude; ?>, <?= $env->longitude; ?> ( 50km<sup>2</sup> )</h2>
        </hgroup>
    </header>

    <section id="env-interface">
        <div id="model"><img src="/img/user/<?= $env->userId; ?>/capture-<?= $envId; ?>.jpg" alt="<?= $env->name; ?>"/></div>
        <div id="model-interaction" class="sdgrey">
            <h1><i class="ico-interact"></i>INTERACT</h1>
            <div id="default" class="btn btn--selected" title="Drag"><i class="ico-hand"></i></div>
            <div id="webcam" class="btn" title="Webcam"><i class="ico-webcam"></i></div>
        </div>
        <input type="checkbox" id="env-interface-pods-toggle" class="checkbox-hack" autocomplete="off"/>
        <label for="env-interface-pods-toggle" id="env-interface-pods-btn" class="ico-"></label>
        <div id="env-interface-pods">
            <div id="env-map" class="env-interface-element">
                <img src="http://maps.googleapis.com/maps/api/staticmap?center=<?= $env->latitude; ?>,<?= $env->longitude; ?>&zoom=10&size=380x380&scale=2&maptype=hybrid&sensor=false&key=AIzaSyCNlx7Q6EFJ2nlJfkAnMIsCm94fdSzaqf4&format=jpg">
            </div>
            <section id="env-data"></section>
            <div id="env-share" class="env-interface-element">
                <h1><i class="ico-share"></i>SHARE</h1>
                <div class="fb-share-button" data-href="<?= $currentUrl; ?>" data-type="button_count"></div>
                <a href="https://twitter.com/share?url=<?= $currentUrl; ?>&amp;text=I just cloned part of the planet! Clone your part now!&hashtags=PreservingThePlanet,ProjectTitan,CellIndustries" class="twitter-share-button">Tweet</a>
            </div>
            <div id="env-info-note"><i class="ico-info"></i>Additional environment information is dependant on data availability.</div>
            <div id="env-interface-pods-bkg"></div>
        </div>
        <div id="webcam-wrapper" class="env-interface-element">
        <p id="webcam-info-note"><i class="ico-gesture"></i>Try using short, sharp hand gestures to interact with the environment</p> 
            <video id="video" autoplay></video>
            <canvas id="canvas"></canvas>
            <canvas id="comp"></canvas>
            <div id="webcam-sensitivity">
                <h2>Sensitivity</h2>
                <label for="sensitivity">High</label> <input type="radio" name="sensitivity">
                <label for="sensitivity">Medium</label> <input type="radio" name="sensitivity" checked>
                <label for="sensitivity">Low</label> <input type="radio" name="sensitivity">
            </div>
        </div>
    </section>

</main>

<div id="full-page-overlay" class="full-page-overlay full-page-overlay--loading"></div>

<div id="background-top"></div>
<div id="background"><img src="/img/user/<?= $env->userId; ?>/capture-<?= $envId; ?>.jpg" alt="<?= $env->name; ?>"/></div>