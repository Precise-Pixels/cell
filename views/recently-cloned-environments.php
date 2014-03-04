<header class="fixed-header section-padding align-centre dgrey">
    <hgroup class="align-vertical">
        <h1>RECENTLY CLONED ENVIRONMENTS</h1>
    </hgroup>
</header>

<main>

    <section id="environment-listing" class="section--spacer sdgrey">
        <div class="align-centre">
            <?php foreach($environments as $env): ?>
                <a href="/user/<?= $env->username; ?>/env/<?= $env->envId; ?>">
                    <div class="imagebox zoombox quarter mblue">
                        <figure>
                            <img src="/img/user/<?= $env->userId; ?>/capture-<?= $env->envId; ?>.jpg" alt="<?= $env->name; ?>">
                       </figure>
                        <figcaption>
                            <h1><?= $env->name; ?></h1>
                        </figcaption>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <?php // If user is signed in
    if(isset($_SESSION['userId'])): ?>
        <section>
            <div id="project-titan-sign-up" class="align-centre section-padding sdgrey">
                <h2>View your cloned environments!</h2>
                <a href="/user/<?= $_SESSION['username']; ?>" class="btn"><i class="ico-my-cell"></i> MyCell</a>
            </div>
        </section>
    <?php else: ?>
        <section>
            <div id="project-titan-sign-up" class="align-centre section-padding sdgrey">
                <h2>Start preserving the planet today!</h2>
                <a href="/signin" class="btn"><i class="ico-my-cell"></i>SIGN UP</a>
            </div>
        </section>
    <?php endif; ?>

    <section>
        <div class="align-centre">
            <a href="project-titan" class="cta cta--example half">
                <hgroup class="align-vertical">
                    <h1>Project Titan</h1>
                </hgroup>
            </a>
            <a href="ted" class="cta cta--example half">
                <hgroup class="align-vertical">
                    <h1>Technology</h1>
                </hgroup>
            </a>
        </div>
    </section>

</main>