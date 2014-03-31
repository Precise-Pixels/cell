<header id="top-bar">
    <label for="site-nav-toggle" id="site-nav-btn"></label>
    <input type="checkbox" id="site-nav-toggle" class="checkbox-hack" autocomplete="off"/>
    <nav id="site-nav" class="force-repaint dgrey">
        <ul>
            <li><a href="/"><i class="ico-home menu-icon"></i>HOME</a></li>
            <li><a href="/about"><i class="ico-people menu-icon"></i>ABOUT</a></li>
            <li><a href="/progress"><i class="ico-project-titan menu-icon"></i>PROGRESS</a></li>
            <li><a href="/project-titan"><i class="ico-project-titan menu-icon"></i>PROJECT TITAN</a></li>
            <li><a href="/the-cloning-process"><i class="ico-cloning-process menu-icon"></i>THE CLONING PROCESS</a></li>
            <li><a href="/technology"><i class="ico-atom menu-icon"></i>TECHNOLOGY</a></li>
            <li><a href="/press"><i class="ico-press menu-icon"></i>PRESS</a></li>
        </ul>
    </nav>
    <i id="site-nav-btn-icon" class="ico- site-nav-btn-icon"></i>

    <p id="user-message"><?php
        if(isset($_SESSION['username'])) {
            echo "Welcome, {$_SESSION['username']}";
        } else {
            echo 'Sign in / Register';
        }
    ?></p>

    <label for="user-nav-toggle" id="user-nav-btn">
        <img id="user-pic" src="http://www.gravatar.com/avatar/<?= (isset($_SESSION['userEmail']) ? md5(strtolower(trim($_SESSION['userEmail']))) : 1); ?>?d=mm&amp;s=60"/>
    </label>
    <input type="checkbox" id="user-nav-toggle" class="checkbox-hack" autocomplete="off"/>
    <nav id="user-menu-wrapper" class="force-repaint sdgrey">
        <div id="user-menu">
            <?php if(isset($_SESSION['status']) && $_SESSION['status'] == 'signedin'): ?>
                    <a href="/user/<?= $_SESSION['username']; ?>" class="btn user" title="MyCell"><i class="ico-my-cell"></i></a>
                    <a href="/user/<?= $_SESSION['username']; ?>/env/new" class="btn" title="Clone New Environment"><i class="ico-env-new"></i></a>
                    <a href="/signout?r=<?= $_SERVER['REQUEST_URI']; ?>" class="btn" title="Sign Out"><i class="ico-logout"></i></a>
            <?php else: ?>
                    <a href="/signin" class="btn" title="Sign In"><i class="ico-login"></i></a>
            <?php endif; ?>
        </div>
    </nav>
    <div id="user-arrow" class="ico-"></div>
    <div id="nav-overlay"></div>
    <div class="cell-logo">
        <a href="/" class="ico-cell-logo"></a>
    </div>
</header>