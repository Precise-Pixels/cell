<header id="fixed-header" class="fixed-header--recent section-padding">
    <hgroup class="align-vertical">
        <h1>RECENTLY CLONED</h1>
        <h2>THE MOST RECENTLY CLONED ENVIRONMENTS</h2>
    </hgroup>
</header>

<main>

    <section id="environment-listing" class="section--spacer sdgrey">
        <div class="align-centre">
            <div id="pagination" class="full">
                <?php if($page == 1): ?>
                    <div class="btn btn--disabled"><i class="ico-arrow-left"></i>NEWER</div>
                <?php else: ?>
                    <a href="?page=<?= $page - 1; ?>"><div class="btn"><i class="ico-arrow-left"></i>NEWER</div></a>
                <?php endif; ?>

                <span><?= $page; ?> of <?= ceil(count($totalEnvironments) / 12); ?></span>

                <?php if($page == ceil(count($totalEnvironments) / 12)): ?>
                    <div class="btn btn--disabled"><i class="ico-arrow-right"></i>OLDER</div>
                <?php else: ?>
                    <a href="?page=<?= $page + 1; ?>"><div class="btn"><i class="ico-arrow-right"></i>OLDER</div></a>
                <?php endif; ?>
            </div>

            <?php if(!empty($environments)):
                foreach($environments as $env): ?>
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
                <?php endforeach;
            else: ?>
                <div id="no-environments" class="section-padding mblue">
                    <h1>There are no more environments.</h1>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php // If user is signed in
    if(isset($_SESSION['userId'])): ?>
        <section>
            <div id="project-titan-sign-up" class="align-centre section-padding sdgrey">
                <h2>View your cloned environments</h2>
                <a href="/user/<?= $_SESSION['username']; ?>" class="btn"><i class="ico-my-cell"></i> MyCell</a>
            </div>
        </section>
    <?php else: ?>
        <section>
            <div id="project-titan-sign-up" class="align-centre section-padding sdgrey">
                <h2>Start preserving the planet today</h2>
                <a href="/signin" class="btn"><i class="ico-my-cell"></i>SIGN UP</a>
            </div>
        </section>
    <?php endif; ?>

    <section>
        <div class="align-centre">
            <a href="/project-titan" class="cta cta--pt-small half">
                <hgroup class="align-vertical">
                    <h1>Project Titan</h1>
                    <h2>Discover the groundbreaking project</h2>
                </hgroup>
            </a>
            <a href="/technology" class="cta cta--technology half">
                <hgroup class="align-vertical">
                    <h1>Technology</h1>
                    <h2>Learn about our QuantumCell&trade; technology</h2>
                </hgroup>
            </a>
        </div>
    </section>

</main>