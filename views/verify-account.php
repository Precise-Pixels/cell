<header id="parallax-header" class="section-padding align-centre dgrey">
    <hgroup class="align-vertical">
        <h1>VERIFY ACCOUNT</h1>
    </hgroup>
</header>

<main class="parallax-margin">

    <section>
        <div class="section-padding align-centre lgrey">
            <?php
            if(!isset($_GET['e']) || !isset($_GET['r'])) {
                header('location: /');
            }

            require_once('php/LoginSystem.php');
            $loginSystem = new LoginSystem();

            $response = $loginSystem->validateUser($_GET['e'], $_GET['r']);

            echo '<p class="full warn">' . ($response ? 'User account verified. You may now <a href="signin">sign in</a>.' : 'An error has occurred whilst verifying your account. Please contact <a href="mailto:info@cell.dev">info@cell.dev</a>.') . '</p>';
            ?>
        </div>
    </section>

</main>