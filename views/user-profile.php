<main>
    <!-- USER PROFILE BANNER -->
    <section id="user-profile-banner" class="section--spacer">
        <div class="align-centre sdgrey">    
            <div id="user-profile-card" class="quarter lgrey">                
                <img src="http://www.gravatar.com/avatar/<?= (isset($user->email) ? md5(strtolower(trim($user->email))) : 1); ?>?d=mm&amp;s=350" />
                <h1 class="lgrey"><?= $user->username; ?></h1>                
            </div>

            <div class="three-quarters section-padding">
                <div class="half-margin sdgrey">
                    <h2 class="align-vertical">No. Envs Cloned</h2>
                </div>
                <div class="half-margin">
                    <?php if(isset($_SESSION['userId']) && $_SESSION['userId'] == $user->userId): // If user is signed in and viewing their own profile ?>  
                     
                    <a href="/user/<?= $username; ?>/env/new" alt="Clone a new environment"> 
                        <div class="environment-block environment-block--new quarter-margin">
                            <div id="new-env-icon"></div>
                        </div>
                    </a>
                    
                    <?php endif; ?>
                    <h2 class="align-vertical">Some other fact here</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- USER PROFILE BANNER END -->

        

    <section>
        <div class="align-centre dgrey">
        <?php if(!empty($environments)):
            foreach($environments as $env): ?>

            <a href="/user/<?= $user->username; ?>/env/<?= $env->envId; ?>">
            <div class="environment-block quarter-margin mblue">
                <img src="/img/placeholder.gif">       
                <div class="environment-block-details">
                    <p><?= $env->name; ?></p>
                </div>
            </div>

        <?php endforeach;
        else: ?>
            <div id="no-environments" class="section-padding mblue">
                <h1>This user hasn't cloned any environments yet.</h1>
            </div>
        <?php endif; ?>

        
        </div>
    </section>

</main>