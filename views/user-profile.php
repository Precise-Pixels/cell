<main>

    <section id="user-profile-banner" class="sdgrey">
        <div class="align-centre">
            <div id="profile-image" class="imagebox quarter">
                <figure>
                    <img src="http://www.gravatar.com/avatar/<?= (isset($user->email) ? md5(strtolower(trim($user->email))) : 1); ?>?d=mm&amp;s=350" />
                </figure>
                <figcaption>
                    <h1><?= $user->username; ?></h1>
                </figcaption>
            </div>
            <div id="user-info" class="quarter section-padding">
                <p><i class="ico-env"></i>34 Environments Cloned</p>
            </div>
            <div class="quarter">

            </div>
            <?php // If user is signed in and viewing their own profile
            if(isset($_SESSION['userId']) && $_SESSION['userId'] == $user->userId): ?>
            <div id="user-buttons" class="section-padding quarter">
                <a href="#" class="btn"><i class="ico-env-new"></i></a>
                <a href="#" class="btn"><i class="ico-my-cell"></i></a>
            </div>
            <?php endif; ?>

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
        </div>
    </section>

</main>