    <header class="fixed-header section-padding align-centre dgrey">
        <hgroup class="align-vertical">
            <h1>RECENTLY CLONED ENVIRONMENTS</h1>
        </hgroup>
    </header>

<main>

    <section id="environment-listing" class="sdgrey">
        <div class="align-centre">
            <?php foreach($environments as $env): ?>
                    <a href="/user/<?= $env->username; ?>/env/<?= $env->envId; ?>">
                        <div class="imagebox quarter mblue">
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

    <section class="mblue">
        <div class="align-centre section-padding">
            <a href="#" class="btn"><i class="ico-env-new"></i> CLONE</a>
            <a href="#" class="btn"><i class="ico-my-cell"></i> SIGN UP</a>
        </div>
    </section>

</main>