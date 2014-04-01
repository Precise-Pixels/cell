<main class="main--top">

    <section id="user-profile-banner" class="dgrey">
        <div class="align-centre">
            <div class="imagebox quarter">
                <figure>
                    <img src="http://www.gravatar.com/avatar/<?= (isset($user->email) ? md5(strtolower(trim($user->email))) : 1); ?>?d=mm&amp;s=350" />
                </figure>
                <figcaption>
                    <h1 id="user-profile-username"><?= $user->username; ?></h1>
                </figcaption>
            </div>
            <div id="user-info" class="half">
                <?php // If user is signed in and viewing their own profile
                if(isset($_SESSION['userId']) && $_SESSION['userId'] == $user->userId): ?>
                    <p class="user-profile-title"><i class="ico-my-cell"></i>Welcome to MyCell, <?= $user->username; ?></p>
                <?php endif; ?>
                <p><i class="ico-env"></i><?= count($totalEnvironments); ?> Environments Cloned</p>
                <p><i class="ico-pin"></i><span id="user-profile-location"><?= ($user->location != '' ? $user->location : 'No location details') ?></span><input type="text" name="location" placeholder="Enter your current location" id="user-profile-location-input" class="user-profile-input user-profile-input--hidden"/></p>
                <div id="user-social">
                    <a href="<?= ($user->facebook != '' ? "http://facebook.com/$user->facebook" : '#') ?>" target="_blank"><i class="ico-facebook"></i></a><input type="text" name="facebook" placeholder="/username" id="user-profile-facebook-input" class="user-profile-input user-profile-input--hidden"/>
                    <a href="<?= ($user->twitter != '' ? "http://twitter.com/$user->twitter" : '#') ?>" target="_blank"><i class="ico-twitter"></i></a><input type="text" name="twitter" placeholder="@username" id="user-profile-twitter-input" class="user-profile-input user-profile-input--hidden"/>
                </div>
            </div>
            <div id="user-buttons">
            <?php // If user is signed in and viewing their own profile
            if(isset($_SESSION['userId']) && $_SESSION['userId'] == $user->userId): ?>
                <?php if(empty($environments) && !isset($_GET['page'])): ?>
                    <a href="#" id="user-profile-edit" class="btn" title="Edit your profile"><i class="ico-edit"></i></a>
                    <a href="<?= $user->username; ?>/env/new" class="btn" title="Clone New Environment"><i class="ico-env-new"></i> NEW CLONE</a>
                    <a href="/signout?r=<?= $_SERVER['REQUEST_URI']; ?>" class="btn" title="Sign Out"><i class="ico-logout"></i></a>
                <?php else: ?>
                    <a href="#" id="user-profile-edit" class="btn" title="Edit your profile"><i class="ico-edit"></i></a>
                    <a href="<?= $user->username; ?>/env/new" class="btn" title="Clone New Environment"><i class="ico-env-new"></i></a>
                    <a href="/signout?r=<?= $_SERVER['REQUEST_URI']; ?>" class="btn" title="Sign Out"><i class="ico-logout"></i></a>
                <?php endif; ?>
            <?php endif; ?>
            </div>
        </div>
    </section>

    <section id="environment-listing" class="section--spacer sdgrey">
        <div class="align-centre">
            <?php if(!empty($environments)):
                foreach($environments as $env): ?>
                <div id="no-environments" class="section-padding mblue">
                    <h1>Here are you cloned environments, <a href="/user/<?= $_SESSION['username']; ?>/env/new" title="Clone New Environment">why not clone another?</a></h1>
                </div>
                    <a href="/user/<?= $user->username; ?>/env/<?= $env->envId; ?>">
                        <div class="imagebox zoombox quarter mblue">
                            <figure>
                                <img src="/img/user/<?= $user->userId; ?>/capture-<?= $env->envId; ?>.jpg" alt="<?= $env->name; ?>">
                            </figure>
                            <figcaption>
                                <h1><?= $env->name; ?></h1>
                            </figcaption>
                            <?php // If user is signed in and viewing their own profile
                            if(isset($_SESSION['userId']) && $_SESSION['userId'] == $user->userId): ?>
                                <i class="ico-cross env-delete"></i>
                            <?php endif; ?>
                        </div>
                    </a>
                <?php endforeach;
            elseif(empty($environments) && isset($_GET['page'])): ?>
                <div id="no-environments" class="section-padding mblue">
                    <h1>There are no more environments.</h1>
                </div>
            <?php else: ?>
                <div id="no-environments" class="section-padding mblue">
                    <h1>This user hasn't cloned any environments yet.</h1>
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

    <section>
        <div class="align-centre">
            <a href="/recently-cloned-environments" class="cta cta--recent half">
                <hgroup class="align-vertical">
                    <h1>Recently Cloned</h1>
                    <h2>See the most recently cloned environments</h2>
                </hgroup>
            </a>
            <a href="/project-titan" class="cta cta--pt-small half">
                <hgroup class="align-vertical">
                    <h1>Project Titan</h1>
                    <h2>Discover the groundbreaking project</h2>
                </hgroup>
            </a>
        </div>
    </section>

</main>