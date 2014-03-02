    <header class="fixed-header section-padding align-centre dgrey">
        <hgroup class="align-vertical">
            <h1>RECENTLY CLONED ENVIRONMENTS</h1>
        </hgroup>
    </header>

<main>

    <section id="new-env-instructions" class="sdgrey section--spacer">
        <div class="align-centre section-padding">
            <a href="#" class="btn"><i class="ico-env-new"></i>CLONE</a>
            <a href="#" class="btn"><i class="ico-my-cell"></i>SIGN UP</a>
        </div>
    </section>

    <section id="environment-listing">
        <div class="align-centre">
            <?php foreach($environments as $env): ?>
                    <a href="/user/<?= $env->username; ?>/env/<?= $env->envId; ?>">
                        <div class="imagebox quarter mblue">
                            <figure>
                                <img src="/img/placeholder.gif" alt="<?= $env->name; ?>">
<!--                                 <img src="/img/user/<?= $user->userId; ?>/capture-<?= $env->envId; ?>.jpg" alt="<?= $env->name; ?>">
 -->                            </figure>
                            <figcaption>
                                <h1><?= $env->name; ?></h1>
                            </figcaption>
                        </div>
                    </a>
            <?php endforeach; ?>
        </div>
    </section>

</main>