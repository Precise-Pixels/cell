<main class="env">

    <header class="sdgrey">
        <hgroup class="align-vertical">
            <h1><i class="ico-env"></i><?= $env->name; ?></h1>
            <h2><i class="ico-pin"></i><?= $env->latitude; ?>, <?= $env->longitude; ?></h2>
        </hgroup>
        <div id="env-user-badge">
            <p>Cloned by:</p>
            <a href="/user/<?= $env->username ?>">
                <img src="http://www.gravatar.com/avatar/<?= (isset($env->email) ? md5(strtolower(trim($env->email))) : 1); ?>?d=mm&amp;s=40" alt="<?= $env->username ?>"/>
                <p><?= $env->username ?><p>
            </a>
        </div>
    </header>
    <?= $env->timestamp; ?> 
    <progress id="prog-bar" min=0 max=100 value=0></progress>

    <div id="model"><img src="/img/placeholder.gif" alt="<?= $env->name; ?>"/></div>
    <div id="env"></div>

    <section id="env-data" class="lgrey"></section>

    <video id="video" autoplay></video>
    <canvas id="canvas"></canvas>
    <canvas id="comp"></canvas>

    <label for="sensitivity">more sensitive</label> <input type="radio" name="sensitivity">
    <label for="sensitivity">average</label> <input type="radio" name="sensitivity" checked>
    <label for="sensitivity">less sensitive</label> <input type="radio" name="sensitivity">

</main>

<div id="new-env-overlay" class="new-env-overlay"></div>