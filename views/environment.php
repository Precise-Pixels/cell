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

    <section id="interface" class="dgrey">
        <div id="model"><img src="/img/user/<?= $env->userId; ?>/capture-<?= $envId; ?>.jpg" alt="<?= $env->name; ?>"/></div>

        <div id="interface-elements">
            <div id="model-interaction">
                <p>Interact</p>
                <div id="default" class="btn btn--selected"><i class="ico-hand"></i></div>
                <div id="webcam" class="btn"><i class="ico-webcam"></i></div>
            </div>
            <div id="model-controls">
                <input type="checkbox" id="model-menu-toggle" class="checkbox-hack"/>
                <label for="model-menu-toggle" id="model-menu-btn" class="btn--menu"><i class="ico-env-menu"></i></label>
                <div id="model-views">
                    <p>Views</p>
                    <div id="360" class="btn btn--views btn--selected">360</div>
                    <div id="top" class="btn btn--views">TOP</div>
                    <div id="side" class="btn btn--views">SIDE</div>
                </div>
            </div>
            <input type="checkbox" id="model-info-toggle" class="checkbox-hack"/>
            <label for="model-info-toggle" id="model-info-btn"></label>
            <div id="model-desc" class="full-screen">
                <h1>Environment Name</h1>
                <p>Maecenas aliquam a ligula et tincidunt. Suspendisse tempor nisi enim, accumsan interdum lacus semper sed. Phasellus ornare in ante gravida gravida. Duis et gravida nisi. Vestibulum semper bibendum rutrum. Ut porta ut purus non ultricies. Vestibulum sed risus egestas, ultrices turpis ac, pellentesque risus.</p>
                <p>Etiam in nisl eu leo aliquam porta. Cras rutrum tellus vehicula hendrerit sodales. Nullam condimentum gravida volutpat. Sed molestie gravida fermentum. In euismod diam eget posuere tempor. Mauris sit amet sem laoreet, consequat sapien eu, aliquam purus. Nunc sit amet lorem ut nunc tempus scelerisque vitae vel ligula.</p>
                <p>Maecenas aliquam a ligula et tincidunt. Suspendisse tempor nisi enim, accumsan interdum lacus semper sed. Phasellus ornare in ante gravida gravida. Duis et gravida nisi. Vestibulum semper bibendum rutrum. Ut porta ut purus non ultricies. Vestibulum sed risus egestas, ultrices turpis ac, pellentesque risus.</p>
                <p>Etiam in nisl eu leo aliquam porta. Cras rutrum tellus vehicula hendrerit sodales. Nullam condimentum gravida volutpat. Sed molestie gravida fermentum. In euismod diam eget posuere tempor. Mauris sit amet sem laoreet, consequat sapien eu, aliquam purus. Nunc sit amet lorem ut nunc tempus scelerisque vitae vel ligula.</p>
                <p>Maecenas aliquam a ligula et tincidunt. Suspendisse tempor nisi enim, accumsan interdum lacus semper sed. Phasellus ornare in ante gravida gravida. Duis et gravida nisi. Vestibulum semper bibendum rutrum. Ut porta ut purus non ultricies. Vestibulum sed risus egestas, ultrices turpis ac, pellentesque risus.</p>
                <p>Etiam in nisl eu leo aliquam porta. Cras rutrum tellus vehicula hendrerit sodales. Nullam condimentum gravida volutpat. Sed molestie gravida fermentum. In euismod diam eget posuere tempor. Mauris sit amet sem laoreet, consequat sapien eu, aliquam purus. Nunc sit amet lorem ut nunc tempus scelerisque vitae vel ligula.</p>
                <p>Maecenas aliquam a ligula et tincidunt. Suspendisse tempor nisi enim, accumsan interdum lacus semper sed. Phasellus ornare in ante gravida gravida. Duis et gravida nisi. Vestibulum semper bibendum rutrum. Ut porta ut purus non ultricies. Vestibulum sed risus egestas, ultrices turpis ac, pellentesque risus.</p>
                <p>Etiam in nisl eu leo aliquam porta. Cras rutrum tellus vehicula hendrerit sodales. Nullam condimentum gravida volutpat. Sed molestie gravida fermentum. In euismod diam eget posuere tempor. Mauris sit amet sem laoreet, consequat sapien eu, aliquam purus. Nunc sit amet lorem ut nunc tempus scelerisque vitae vel ligula.</p>
                <p>Maecenas aliquam a ligula et tincidunt. Suspendisse tempor nisi enim, accumsan interdum lacus semper sed. Phasellus ornare in ante gravida gravida. Duis et gravida nisi. Vestibulum semper bibendum rutrum. Ut porta ut purus non ultricies. Vestibulum sed risus egestas, ultrices turpis ac, pellentesque risus.</p>
                <p>Etiam in nisl eu leo aliquam porta. Cras rutrum tellus vehicula hendrerit sodales. Nullam condimentum gravida volutpat. Sed molestie gravida fermentum. In euismod diam eget posuere tempor. Mauris sit amet sem laoreet, consequat sapien eu, aliquam purus. Nunc sit amet lorem ut nunc tempus scelerisque vitae vel ligula.</p>
            </div>
        </div>
    </section>

<!--     <section id="env-data" class="lgrey"></section>
    <video id="video" autoplay></video>
    <canvas id="canvas"></canvas>
    <canvas id="comp"></canvas>

    <label for="sensitivity">more sensitive</label> <input type="radio" name="sensitivity">
    <label for="sensitivity">average</label> <input type="radio" name="sensitivity" checked>
    <label for="sensitivity">less sensitive</label> <input type="radio" name="sensitivity"> -->

</main>

<div id="full-page-overlay" class="full-page-overlay full-page-overlay--loading"></div>
<progress id="prog-bar" min=0 max=100 value=0></progress>
