<header class="fixed-header section-padding align-centre dgrey">
    <hgroup class="align-vertical">
        <h1>VERIFY ACCOUNT</h1>
    </hgroup>
</header>

<main>

    <section>
        <div class="section-padding align-centre lgrey">
            <?php
            if(!isset($_GET['e']) || !isset($_GET['r'])) {
                header('location: /');
            }

            require_once('php/LoginSystem.php');
            $loginSystem = new LoginSystem();

            $response = $loginSystem->validateUser($_GET['e'], $_GET['r']);

            echo '<p class="full warn">' . ($response ? 'User account verified. You may now <a href="signin">sign in</a>.' : 'An error has occurred whilst verifying your account. Please contact <a href="mailto:info@cell-industries.co.uk">info@cell-industries.co.uk</a>.') . '</p>';
            ?>
        </div>
    </section>

</main>