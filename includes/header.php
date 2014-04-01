<header id="top-bar">
    <label for="site-nav-toggle" id="site-nav-btn"><p id="menu-lable">MENU</p></label>
    <input type="checkbox" id="site-nav-toggle" class="checkbox-hack" autocomplete="off"/>
    <nav id="site-nav" class="force-repaint dgrey">
        <ul>
            <li><a href="/"><i class="ico-home menu-icon"></i>HOME</a></li>
            <li><a href="/project-titan"><i class="ico-project-titan menu-icon"></i>PROJECT TITAN</a></li>
            <li><a href="/the-cloning-process"><i class="ico-cloning-process menu-icon"></i>THE CLONING PROCESS</a></li>
            <li><a href="/technology"><i class="ico-atom menu-icon"></i>TECHNOLOGY</a></li>
            <li><a href="/about"><i class="ico-people menu-icon"></i>ABOUT CELL</a></li>
            <li><a href="/press"><i class="ico-press menu-icon"></i>PRESS</a></li>
        </ul>
    </nav>
    <i id="site-nav-btn-icon" class="ico- site-nav-btn-icon"></i>

    <?php if(isset($_SESSION['status']) && $_SESSION['status'] == 'signedin'): ?>
        <a href="/user/<?= $_SESSION['username']; ?>" title="Your Profile"><i class="user-nav-profile ico-my-cell"></i></a>
        <a href="/signout?r=<?= $_SERVER['REQUEST_URI']; ?>"><p class="login-status">Logout</p></i></a>
    <?php else: ?>
        <a href="/signin"><p class="login-status">Sign in / Register</p></i></a>
    <?php endif; ?>

    <div class="cell-logo">
        <a href="/" class="ico-cell-logo"></a>
    </div>
</header>