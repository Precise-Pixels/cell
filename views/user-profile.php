    <section id="user-profile-banner" class="dgrey">
        <div class="align-centre">
            <div id="profile-image" class="imagebox quarter">
                <figure>
                    <img src="http://www.gravatar.com/avatar/<?= (isset($user->email) ? md5(strtolower(trim($user->email))) : 1); ?>?d=mm&amp;s=350" />
                </figure>
                <figcaption>
                    <h1><?= $user->username; ?></h1>
                </figcaption>
            </div>
            <div id="user-info" class="half">
                <h2><i class="ico-info"></i>Multimedia Designer</h2>
                <h2><i class="ico-pin"></i>Canterbury, UK</h2>
                <h2><i class="ico-env"></i><?= count($environments); ?> Environments Cloned</h2>
                <h2><i class="ico-hash"></i>117 Profile Views</h2>
                <div id="user-social">
                    <a href="mailto:<?= $user->email; ?>"><i class="ico-email"></i></a>
                    <a href="#"><i class="ico-facebook"></i></a>
                    <a href="#"><i class="ico-twitter"></i></a>
                </div>
            </div>
            <div id="user-buttons" class="quarter">
            <?php // If user is signed in and viewing their own profile
            if(isset($_SESSION['userId']) && $_SESSION['userId'] == $user->userId): ?>
                <a href="#" class="btn"><i class="ico-env-new"></i></a>
            <?php endif; ?>
            </div>

        </div>
    </section>

<main id="user-profile-main">

    <section id="environment-listing" class="sdgrey">
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