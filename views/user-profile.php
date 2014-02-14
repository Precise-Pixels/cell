<h1>USER PROFILE</h1>

<p><?= $user->timestamp; ?></p>
<p><?= $user->username; ?></p>

<h2>Environments</h2>

<?php foreach($environments as $env): ?>
<p><?= $env->timestamp; ?></p>
<p><?= $env->latitude; ?></p>
<p><?= $env->longitude; ?></p>
<?php endforeach; ?>