<header id="fixed-header" class="fixed-header--signin section-padding">
    <hgroup class="align-vertical">
        <h1>RESET PASSWORD</h1>
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

            if($_POST) {
                $email    = $_GET['e'];
                $rand     = $_GET['r'];
                $password = $_POST['password'];

                if(!empty($password)) {
                    $response = $loginSystem->resetPassword($email, $password, $rand);
                    echo $response;
                } else {
                    echo '<p class="full warn">Please enter your new password.</a>';
                }
            }
            ?>

            <form method="post" class="half-padding">
                <table>
                    <tr>
                        <td><label for="password">Password:</label></td>
                        <td><input type="password" name="password" required autofocus/></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td><input type="submit" value="RESET" class="btn"/></td>
                    </tr>
                </table>
            </form>

            <p class="half-padding">Please enter a new password into the field above.</p>
        </div>
    </section>

</main>