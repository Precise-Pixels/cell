<main>

        <p><?= $user->userId; ?></p>
        <p><?= $user->timestamp; ?></p>

    <section id="user-profile-banner" class="section--spacer">
        <div  class="align-centre mblue">    
            <div id="user-profile-card" class="quarter lgrey">
                <img id="user-profile-pic" src="http://www.gravatar.com/avatar/6c4d9d7f7412a5c4e1ac47acd2d24112?d=mm&s=350">
                <h1><?= $user->username; ?></h1>
            </div>
            <div class="three-quarters sdgrey">
                <p>2 thirds</p>
            </div>
        </div>
    </section>

    <section>
        <div class="align-centre section-padding lgrey">
        <h1>CLONED ENVIRONMENTS</h1>
        <?php if(!empty($environments)):
            foreach($environments as $env): ?>
                <div class="user-environment quarter-margin mblue">
<!--                <img src="http://maps.googleapis.com/maps/api/staticmap?center=<?= $env->latitude; ?>,<?= $env->longitude; ?>&amp;zoom=11&amp;size=640x640&amp;scale=1&amp;maptype=satellite&amp;sensor=false&amp;key=AIzaSyCNlx7Q6EFJ2nlJfkAnMIsCm94fdSzaqf4">
-->                 <p><?= $env->timestamp; ?></p>
<!--                <p><?= $env->latitude; ?></p>
                    <p><?= $env->longitude; ?></p> -->
                </div>
        <?php endforeach;
        else: ?>
            <p>This user hasn't cloned any environments yet.</p>
        <?php endif; ?>
        
        <?php if(isset($_SESSION['userId']) && $_SESSION['userId'] == $user->userId): // If user is signed in and viewing their own profile ?>  
            <div class="user-environment quarter-margin mblue">
                <a href="/user/<?= $username; ?>/env/new">Clone a new environment</a>
            </div>
        <?php endif; ?>
        
        </div>
    </section>

</main>