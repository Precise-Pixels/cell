<header id="fixed-header" class="section-padding">
    <hgroup class="align-vertical">
        <h1>PROGRESS</h1>
        <h2>How is Project Titan going so far?</h2>
    </hgroup>
</header>

<main>

    <section>
        <div class="section-padding align-centre mblue">
            <h1><i class="ico-earth"></i>ON THE MAP</h1>
            <div id="progress-map"></div>
            <input type="text" placeholder="Search Box" id="pac-input" style="position:fixed;top:0;left:-9999px;opacity:0;" autofocus>
            <p><i class="ico-info"></i>Each marker on the map represents an environment that has been cloned</p>
            <p><i class="ico-info"></i>Click the markers to view the cloned environments</p>
        </div>
    </section>

    <section>
        <div class="section-padding align-centre lgrey">
            <h1><i class="ico-progress"></i>STATISTICS</h1>
            <div class="progress-map-data zoom-text third">
                <h2 id="progress-map-data--participants"><?= $participants; ?></h2>
                <p>PARTICIPANTS</p>
            </div>
            <div class="progress-map-data zoom-text third">
                <h2 id="progress-map-env-perc" class="progress-map-data">&nbsp;</h2>
                <p>OF THE PLANET PRESERVED</p>
            </div>
            <div class="progress-map-data zoom-text third">
                <h2 id="progress-map-data--environments">&nbsp;</h2>
                <p>ENVIRONMENTS CLONED</p>
            </div>
        </div>
    </section>

</main>