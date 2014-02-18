<h1>USER PROFILE</h1>

<p><?= $user->userId; ?></p>
<p><?= $user->timestamp; ?></p>
<p><?= $user->username; ?></p>

<h2>Environments</h2>

<?php if(!empty($environments)):
    foreach($environments as $env): ?>
        <p><?= $env->timestamp; ?></p>
        <p><?= $env->latitude; ?></p>
        <p><?= $env->longitude; ?></p>
<?php endforeach;
else: ?>
    <p>This user hasn't cloned any environments yet.</p>
<?php endif; ?>

<?php if(isset($_SESSION['userId']) && $_SESSION['userId'] == $user->userId): // If user is signed in and viewing their own profile ?>
    <a href="/user/<?= $username; ?>/env/new">Clone a new environment</a>
<?php endif; ?>