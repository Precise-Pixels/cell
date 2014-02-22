<main>

    <section id="user-profile-banner" class="sdgrey">
        <div class="align-centre">
            <div class="imagebox third-margin">
                <figure>
                    <img src="http://www.gravatar.com/avatar/<?= (isset($user->email) ? md5(strtolower(trim($user->email))) : 1); ?>?d=mm&amp;s=350" />
                </figure>
                <figcaption>
                    <h1><?= $user->username; ?></h1>
                </figcaption>
            </div>
            <div class="third-margin">
                <h2>No. Envs Cloned</h2>
                <h2>Some other fact here</h2>
            </div> 
        </div>
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

            <?php // If user is signed in and viewing their own profile
            if(isset($_SESSION['userId']) && $_SESSION['userId'] == $user->userId): ?>
                <div class="quarter section-padding">
                    <a href="/user/<?= $username; ?>/env/new" alt="Clone a new environment">
                        <div class="imagebox-new--environment">
                            <div id="new-env-icon"></div>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>

</main>