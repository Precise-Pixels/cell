<main>
    <!-- USER PROFILE BANNER -->
    <section id="user-profile-banner" class="sdgrey">
        <div class="align-centre">    
            <div id="user-profile-card" class="third-margin">                
                <img src="http://www.gravatar.com/avatar/<?= (isset($user->email) ? md5(strtolower(trim($user->email))) : 1); ?>?d=mm&amp;s=350" />
                <h1 class="mblue"><?= $user->username; ?></h1>                
            </div>

                <div class="third-margin">
                    <h2 class="">No. Envs Cloned</h2>
                    <h2 class="align-vertical">Some other fact here</h2>
                </div> 
        </div>
    </section>
    <!-- USER PROFILE BANNER END -->

    <section id="environment-listing"> 
        <div class="align-centre">
        <?php if(!empty($environments)):
            foreach($environments as $env): ?>

            <a href="/user/<?= $user->username; ?>/env/<?= $env->envId; ?>">
            <div class="environment-block quarter mblue">
                <img src="/img/placeholder.gif">       
                <div class="environment-block-details">
                    <h2><?= $env->name; ?></h2>
                </div>
            </div>

        <?php endforeach;
        else: ?>
            <div id="no-environments" class="section-padding mblue">
                <h1>This user hasn't cloned any environments yet.</h1>
            </div>
        <?php endif; ?>

                    <!-- If user is signed in and viewing their own profile --> 
                <?php if(isset($_SESSION['userId']) && $_SESSION['userId'] == $user->userId): ?>  
                    <div class="quarter section-padding">
                            <a href="/user/<?= $username; ?>/env/new" alt="Clone a new environment"> 
                                <div class="environment-block--new">
                                    <div id="new-env-icon"></div>
                                </div>
                            </a>
                    </div>
                <?php endif; ?>
        
        </div>
    </section>

</main>