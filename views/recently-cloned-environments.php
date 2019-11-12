<header id="fixed-header" class="fixed-header--recent section-padding">
    <hgroup class="align-vertical">
        <h1>RECENTLY CLONED</h1>
        <h2>THE MOST RECENTLY CLONED ENVIRONMENTS</h2>
    </hgroup>
</header>

<main>

    <section id="environment-listing" class="section--spacer sdgrey">
        <div class="align-centre">
            <?php if(!empty($environments)):
                foreach($environments as $env): ?>
                    <a href="/user/<?= $env->username; ?>/env/<?= $env->envId; ?>">
                        <div class="imagebox zoombox quarter mblue">
                            <figure>
                                <img src="/img/user/<?= $env->userId; ?>/capture-<?= $env->envId; ?>.jpg" alt="<?= $env->name; ?>" onerror="this.src='/img/imagebox-error.png'">
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
            <div id="pagination" class="full">
                <?php if($page <= 1): ?>
                    <div class="btn btn--disabled pagination-previous"><i class="ico-arrow-down"></i>PREVIOUS</div>
                <?php else: ?>
                    <a href="?page=<?= $page - 1; ?>" class="btn pagination-previous"><i class="ico-arrow-down"></i>PREVIOUS</a>
                <?php endif; ?>

                <span><?= $page; ?> of <?= ceil(count($totalEnvironments) / 12); ?></span>

                <?php if($page >= ceil(count($totalEnvironments) / 12)): ?>
                    <div class="btn btn--disabled pagination-next">NEXT<i class="ico-arrow-up"></i></div>
                <?php else: ?>
                    <a href="?page=<?= $page + 1; ?>" class="btn pagination-next">NEXT<i class="ico-arrow-up"></i></a>
                <?php endif; ?>
            </div>
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
                <a href="/signin#register" class="btn"><i class="ico-my-cell"></i>REGISTER</a>
            </div>
        </section>
    <?php endif; ?>

    <section>
        <div class="align-centre">
            <a href="/progress" class="cta cta--progress full">
                <hgroup class="align-vertical">
                    <h1>Progress</h1>
                    <h2>How is Project Titan going so far?</h2>
                </hgroup>
            </a>
        </div>
    </section>

</main>