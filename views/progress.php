<section class="dgrey">
    <div class="section-padding align-centre">
        <div id="progress-map"></div>
        <input type="text" placeholder="Search Box" id="pac-input" style="position:fixed;top:0;left:-9999px;opacity:0;" autofocus>
    </div>
</section>

<section id="progress-map-info" class="mblue">
    <i id="progress-map-env-icon" class="ico-env"></i>
    <p id="progress-map-env-icon-perc">&nbsp;</p>
    <div class="section-padding align-centre">
        <h2 class="progress-map-data progress-map-env-icon-title">OF THE PLANET PRESERVED</h2>
        <div class="progress-map-data progress-map-data--left half">
            <h2 id="progress-map-data--participants"><?= $participants; ?></h2>
            <p>PARTICIPANTS</p>
        </div>
        <div class="progress-map-data progress-map-data--right half">
            <h2 id="progress-map-data--environments">&nbsp;</h2>
            <p>ENVIRONMENTS CLONED</p>
        </div>
        <div id="progress-map-learn-more" class="align-centre">
            <a href="/project-titan" class="btn"><i class="ico-project-titan"></i>LEARN MORE</a>
        </div>
    </div>
</section>