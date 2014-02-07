<header>
    <input type="checkbox" id="site-nav-toggle" class="checkbox-hack"/>
    <label for="site-nav-toggle" id="site-nav-btn" class="btn--menu"></label>
    <nav id="site-nav">
        <a href="/">Home</a>
        <a href="/about">About</a>
        <a href="/project-titan">Project Titan</a>
        <a href="/technology">Technology</a>
        <a href="/press">Press</a>
    </nav>

    <div id="user-message">Welcome back, James</div>

    <input type="checkbox" id="user-nav-toggle" class="checkbox-hack"/>
    <label for="user-nav-toggle" id="user-nav-btn" class="btn--menu">
        <div id="user-arrow"></div>
        <div id="user-pic"></div>
    </label>
    <nav id="user-nav">
        <?php if(isset($_SESSION['status']) && $_SESSION['status'] == 'loggedin'): ?>
        <a href="/user/james">MyCell</a>
        <a href="/user/james/env/new">Clone a new environment</a>
        <a href="/logout?r=<?= $_SERVER['REQUEST_URI']; ?>">Logout</a>
        <?php else: ?>
        <a href="/login">Login / Register</a>
        <?php endif; ?>
    </nav>
</header>