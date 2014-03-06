<main class="env">

    <header class="sdgrey">
        <hgroup class="align-vertical">
            <h1><i class="ico-env"></i><?= $env->name; ?></h1>
            <h2><i class="ico-pin"></i><?= $env->latitude; ?>, <?= $env->longitude; ?></h2>
        </hgroup>
        <div id="env-user-badge">
            <p>Cloned by:</p>
            <a href="/user/<?= $username ?>">
                <img src="http://www.gravatar.com/avatar/<?= (isset($env->email) ? md5(strtolower(trim($env->email))) : 1); ?>?d=mm&amp;s=40" alt="<?= $username ?>"/>
                <p><?= $username ?><p>
            </a>
        </div>
    </header>
    <?= $env->timestamp; ?>

    <div id="model"><img src="/img/user/<?= $env->userId; ?>/capture-<?= $env->envId; ?>.jpg" alt="<?= $env->name; ?>"/></div>

    <section id="env-data" class="lgrey"></section>

    <video id="video" autoplay></video>
    <canvas id="canvas"></canvas>
    <canvas id="comp"></canvas>

    <label for="sensitivity">more sensitive</label> <input type="radio" name="sensitivity">
    <label for="sensitivity">average</label> <input type="radio" name="sensitivity" checked>
    <label for="sensitivity">less sensitive</label> <input type="radio" name="sensitivity">

</main>

<div id="full-page-overlay" class="full-page-overlay full-page-overlay--loading"></div>
<progress id="prog-bar" min=0 max=100 value=0></progress>