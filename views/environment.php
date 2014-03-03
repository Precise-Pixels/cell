<h1>ENV</h1>

<p><?= $env->timestamp; ?> | <?= $env->latitude; ?> | <?= $env->longitude; ?></p>

<a href="/user/<?= $env->username ?>"><?= $env->username ?>'s profile</a>

<div id="model"><img src="/img/placeholder.gif" alt="<?= $env->name; ?>"/></div>