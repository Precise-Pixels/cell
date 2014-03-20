<header id="primary-header" class="fixed-header--home section-padding sdgrey">
    <div class="cube-wrapper">
        <div class="cube">
            <div class="front"></div>
            <div class="back"></div>
            <div class="left"></div>
            <div class="right"></div>
            <img src="/img/logo.gif" alt="Cell Industries logo in a spinning cube">
        </div>
    </div>
    <hgroup class="align-vertical cell-header">
        <h1>CELL INDUSTRIES</h1>
        <?php require_once('includes/balls.php'); ?>
    </hgroup>
    <a id="page-flow" class="arrow-down ico-arrow-down2" href="#firststeps"></a>
</header>

<main>

    <a id="firststeps"></a>
    <header id="secondary-header" class="mblue">
        <div class="section-padding align-centre">
            <hgroup>
                <h1>PROJECT TITAN</h1>
                <h2>PRESERVING THE PLANET</h2>
            </hgroup>
        </div>
    </header>

    <section class="dgrey">
        <div class="section-padding align-centre">
            <div id="homepage-map"></div>
        </div>
    </section>

    <section id="homepage-map-info" class="mblue">
        <i id="homepage-map-env-icon" class="ico-env"></i>
        <p id="homepage-map-env-icon-perc">&nbsp;</p>
        <div class="section-padding align-centre">
            <h2 class="homepage-map-data homepage-map-env-icon-title">OF THE PLANET PRESERVED</h2>
            <div class="homepage-map-data homepage-map-data--left half">
                <h2 id="homepage-map-data--participants"><?= $participants; ?></h2>
                <p>PARTICIPANTS</p>
            </div>
            <div class="homepage-map-data homepage-map-data--right half">
                <h2 id="homepage-map-data--environments">&nbsp;</h2>
                <p>ENVIRONMENTS CLONED</p>
            </div>
            <div id="homepage-map-learn-more" class="align-centre">
                <a href="/project-titan" class="btn">LEARN MORE</a>
            </div>
        </div>
    </section>

    <section id="homepage-company" class="sdgrey">
        <div class="section-padding align-centre">
            <div class="cell-values">
                <h2>INNOVATE</h2>
                <p>Constantly breaking the boundaries of modern day science.</p>
            </div>
            <i class="ico-arrow-down2 homepage-arrow"></i>
            <div class="cell-values">
                <h2>APPLY</h2>
                <p>Using the new technologies we discover to benefit you.</p>
            </div>
            <i class="ico-arrow-down2 homepage-arrow"></i>
            <div class="cell-values">
                <h2>CHANGE</h2>
                <p>Improving your life and wellbeing to develop all of our futures.</p>
            </div>
        </div>
    </section>

    <section class="sdgrey">
        <div class="align-centre sdgrey">
            <a href="/project-titan" class="cta cta--pt-large half">
                <hgroup class="align-vertical">
                    <h1>Project Titan</h1>
                    <h2>Discover the groundbreaking project</h2>
                </hgroup>
            </a>
            <a href="/about" class="cta cta--about half">
                <hgroup class="align-vertical">
                    <h1>About Cell</h1>
                    <h2>Find out about Cell Industries</h2>
                </hgroup>
            </a>
            <a href="/technology" class="cta cta--technology half">
                <hgroup class="align-vertical">
                    <h1>Technology</h1>
                    <h2>Learn about our QuantumCell&trade; technology</h2>
                </hgroup>
            </a>
        </div>
            <div id="homepage-cta-bkg"></div>
    </section>

</main>