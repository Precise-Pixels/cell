<header class="dgrey">
    <label for="site-nav-toggle" id="site-nav-btn"></label>
    <input type="checkbox" id="site-nav-toggle" class="checkbox-hack"/>
    <nav id="site-nav" class="force-repaint mblue">
    <ul>
        <li><a href="/"><i class="ico-company menu-icon"></i>HOME</a></li>
        <li><a href="/about"><i class="ico-company menu-icon"></i>ABOUT</a></li>
        <li><a href="/project-titan"><i class="ico-company menu-icon"></i>PROJECT TITAN</a></li>
        <li><a href="/technology"><i class="ico-company menu-icon"></i>TECHNOLOGY</a></li>
        <li><a href="/press"><i class="ico-company menu-icon"></i>PRESS</a></li>
    </ul>
    </nav>
    <i class="ico- site-nav-btn-icon"></i>

    <p id="user-message"><?php
        if(isset($_SESSION['username'])) {
            echo "Welcome back, {$_SESSION['username']}";
        } else {
            echo 'Sign in';
        }
    ?></p>

    <label for="user-nav-toggle" id="user-nav-btn">
        <img id="user-pic" src="http://www.gravatar.com/avatar/<?= (isset($_SESSION['userEmail']) ? md5(strtolower(trim($_SESSION['userEmail']))) : 1); ?>?d=mm&amp;s=60"/>
    </label>
    <input type="checkbox" id="user-nav-toggle" class="checkbox-hack"/>
    <nav id="user-nav" class="force-repaint mblue">
        <?php if(isset($_SESSION['status']) && $_SESSION['status'] == 'signedin'): ?>
        <a href="/user/<?= $_SESSION['username']; ?>"><i class="ico-company menu-icon"></i>MyCell</a>
        <a href="/user/<?= $_SESSION['username']; ?>/env/new"><i class="ico-company menu-icon"></i>Clone a new environment</a>
        <a href="/signout?r=<?= $_SERVER['REQUEST_URI']; ?>"><i class="ico-company menu-icon"></i>Sign out</a>
        <?php else: ?>
        <a href="/signin"><i class="ico-company menu-icon"></i>Sign in / Register</a>
        <?php endif; ?>
    </nav>
    <div id="user-arrow" class="ico-"></div>
    <div id="nav-overlay"></div>
</header>