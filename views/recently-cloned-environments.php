<main>

    <header class="section-padding align-centre dgrey">
        <hgroup class="align-vertical">
            <h1>RECENTLY CLONED ENVIRONMENTS</h1>
        </hgroup>
    </header>

    <section id="new-env-instructions" class="sdgrey section--spacer">
        <div class="align-centre"></div>
    </section>

    <section id="environment-listing">
    <div class="align-centre">
        <?php if(!empty($environments)):
            foreach($environments as $env): ?>
                <a href="/user/<?= $user->username; ?>/env/<?= $env->envId; ?>">
                    <div class="imagebox quarter mblue">
                        <figure>
                            <img src="/img/placeholder.gif" alt="<?= $env->name; ?>">
                        </figure>
                        <figcaption>
                            <h1><?= $env->name; ?></h1>
                        </figcaption>
                    </div>
                </a>
        <?php endforeach;
        else: ?>
            <div id="no-environments" class="section-padding mblue">
                <h1>This user hasn't cloned any environments yet.</h1>
            </div>
        <?php endif; ?>

</main>