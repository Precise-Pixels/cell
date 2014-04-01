<header id="fixed-header" class="section-padding">
    <hgroup class="align-vertical">
        <h1>PROGRESS</h1>
    </hgroup>
</header>

<main>

    <section>
        <div class="section-padding align-centre lgrey">
            <h1>How is Project Titan going so far?</h1>
            <p><i class="ico-info"></i>Each marker on the map represents an environment that has been cloned</p>
        </div>
    </section>

    <section>
        <div class="section-padding align-centre mblue">
            <div id="progress-map"></div>
            <input type="text" placeholder="Search Box" id="pac-input" style="position:fixed;top:0;left:-9999px;opacity:0;" autofocus>
        </div>
    </section>

    <section id="progress-map-info">
        <div class="align-centre mblue">
            <div class="section-padding align-centre">
                <div class="progress-map-data progress-map-data--left third">
                    <h2 id="progress-map-data--participants"><?= $participants; ?></h2>
                    <p>PARTICIPANTS</p>
                </div>
                <div class="progress-map-data progress-map-data--left third">
                    <h2 id="progress-map-env-perc" class="progress-map-data">&nbsp;</h2>
                    <p>OF THE PLANET PRESERVED</p>
                </div>
                <div class="progress-map-data progress-map-data--right third">
                    <h2 id="progress-map-data--environments">&nbsp;</h2>
                    <p>ENVIRONMENTS CLONED</p>
                </div>
            </div>
        </div>
    </section>

</main>