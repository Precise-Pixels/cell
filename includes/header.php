<header>
    <input type="checkbox" id="site-nav-toggle" class="checkbox-hack"/>
    <label for="site-nav-toggle" id="site-nav-btn"></label>
    <nav id="site-nav">
        <a href="/">Home</a>
        <a href="/about">About</a>
        <a href="/project-titan">Project Titan</a>
        <a href="/technology">Technology</a>
        <a href="/press">Press</a>
    </nav>

    <p id="user-message"><?= (isset($_SESSION['username']) ? 'Welcome back, ' . ucfirst($_SESSION['username']) : 'Sign in'); ?></p>

    <input type="checkbox" id="user-nav-toggle" class="checkbox-hack"/>
    <label for="user-nav-toggle" id="user-nav-btn">
        <div id="user-arrow"></div>
        <img id="user-pic" src="http://www.gravatar.com/avatar/<?= (isset($_SESSION['userEmail']) ? md5(strtolower(trim($_SESSION['userEmail']))) : 1); ?>?d=mm&amp;s=60"/>
    </label>
    <nav id="user-nav">
        <?php if(isset($_SESSION['status']) && $_SESSION['status'] == 'signedin'): ?>
        <a href="/user/<?= $_SESSION['username']; ?>">MyCell</a>
        <a href="/user/<?= $_SESSION['username']; ?>/env/new">Clone a new environment</a>
        <a href="/signout?r=<?= $_SERVER['REQUEST_URI']; ?>">Sign out</a>
        <?php else: ?>
        <a href="/signin">Sign in / Register</a>
        <?php endif; ?>
    </nav>
</header>