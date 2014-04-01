<header id="fixed-header" class="fixed-header--home section-padding">
    <div id="fixed-header-homepage" class="align-centre">
        <hgroup>
<!--             <div class="cube-wrapper">
                <div class="cube">
                    <div class="front"></div>
                    <div class="back"></div>
                    <div class="left"></div>
                    <div class="right"></div>
                    <img src="/img/logo.gif" alt="Cell Industries logo in a spinning cube">
                </div>
            </div> -->
            <h1>CELL INDUSTRIES</h1>
            <p>PRESENTS</p>
            <h2>PROJECT TITAN: PRESERVING THE PLANET</h2>
        </hgroup>
    </div>
</header>

<main id="homepage-main">

    <section>
        <div class="align-centre section-padding lgrey">
            <div class="half-margin">
                <h1><i class="ico-project-titan"></i>WHAT IS PROJECT TITAN?</h1>
                <p>In an ever changing and increasingly turbulent world the natural environments of our planet often bear the brunt of modern society. Using our groundbreaking QuantumCell&trade; technology we want to ensure the environments that matter to you are preserved for millennia to come. We can clone whole areas of environments leaving them protected and ready to be restored in the event of undesirable occurrences.</p>
            </div>
            <div class="half-margin">
                <h1><i class="ico-my-cell"></i>HOW ARE YOU INVOLVED?</h1>
                <p>Project Titan is a collaborative project designed to involve everyone in preserving the Earth's environments. You get to decide which part of the planet we preserve next. You will be able to view the 3D representation of the environments you clone at any time, along with live information associated with those environments. You can then share your environments and let everyone know that you have done your part to help preserve the planet.</p>
            </div>
        </div>
    </section>

    <section id="homepage-diagram">
        <div class="section-padding align-centre mblue">
            <h1>Simply register for free, follow the instructions and build up your own collection of cloned environments.</h2>
            <ol class="align-centre">
                <li class="third">
                    <h1>1</h1>
                    <img src="/img/new-env-instructions-1.png" class="scale">
                    <p>Zoom in fully to select an area of the map</p>
                </li>
                <li class="third">
                    <h1>2</h1>
                    <img src="/img/new-env-instructions-2.png" class="scale">
                    <p>Name your environment and click the clone button</p>
                </li>
                <li class="third">
                    <h1>3</h1>
                    <img src="/img/new-env-instructions-3.png" class="scale">
                    <p>View your newly cloned environment</p>
                </li>
            </ol>
        </div>
    </section>

    <?php // If user is signed in
    if(isset($_SESSION['userId'])): ?>
        <section>
            <div id="homepage-sign-up" class="align-centre section-padding sdgrey">
                <h2>View your cloned environments</h2>
                <a href="/user/<?= $_SESSION['username']; ?>" class="btn"><i class="ico-my-cell"></i> YOUR PROFILE</a>
            </div>
        </section>
    <?php else: ?>
        <section>
            <div id="homepage-sign-up" class="align-centre section-padding sdgrey">
                <h2>Start preserving the planet today</h2>
                <a href="/signin#register" class="btn"><i class="ico-my-cell"></i> REGISTER</a>
            </div>
        </section>
    <?php endif; ?>

</main>