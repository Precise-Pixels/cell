<header id="top-bar">
    <label for="site-nav-toggle" id="site-nav-btn" class="ico-burger"></label>
    <input type="checkbox" id="site-nav-toggle" class="checkbox-hack" onclick="checked();"/>
    <nav id="site-nav" class="force-repaint">
        <a href="/">Home</a>
        <a href="/about">About</a>
        <a href="/project-titan">Project Titan</a>
        <a href="/technology">Technology</a>
        <a href="/press">Press</a>
    </nav>

    <p id="user-message"><?php
        if(isset($_SESSION['username'])) {
            echo "Welcome, {$_SESSION['username']}";
        } else {
            echo 'Sign in';
        }
    ?></p>

    <label for="user-nav-toggle" id="user-nav-btn">
        <img id="user-pic" src="http://www.gravatar.com/avatar/<?= (isset($_SESSION['userEmail']) ? md5(strtolower(trim($_SESSION['userEmail']))) : 1); ?>?d=mm&amp;s=60"/>
    </label>
    <input type="checkbox" id="user-nav-toggle" class="checkbox-hack" onclick="checked()"/>
    <nav id="user-nav" class="force-repaint">
        <?php if(isset($_SESSION['status']) && $_SESSION['status'] == 'signedin'): ?>
        <a href="/user/<?= $_SESSION['username']; ?>">MyCell</a>
        <a href="/user/<?= $_SESSION['username']; ?>/env/new">Clone a new environment</a>
        <a href="/signout?r=<?= $_SERVER['REQUEST_URI']; ?>">Sign out</a>
        <?php else: ?>
        <a href="/signin">Sign in / Register</a>
        <?php endif; ?>
    </nav>
    <div id="user-arrow" class="ico-"></div>
    <div class="cell-logo">
        <a href="/" class="ico-cell-logo"></a>
    </div>
</header>