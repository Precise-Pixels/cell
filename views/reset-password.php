<main>

    <header class="section-padding align-centre dgrey">
        <hgroup class="align-vertical">
            <h1>RESET PASSWORD</h1>
        </hgroup>
    </header>

    <section>
        <div class="section-padding align-centre lgrey">
            <?php
            if(!isset($_GET['e']) || !isset($_GET['r'])) {
                header('location: /');
            }

            require_once('php/LoginSystem.php');
            $login_system = new LoginSystem();

            if($_POST) {
                $email    = $_GET['e'];
                $rand     = $_GET['r'];
                $password = $_POST['password'];

                if(!empty($password)) {
                    $response = $login_system->reset_password($email, $password, $rand);
                    echo $response;
                } else {
                    echo '<p class="full error">Please enter your new password.</a>';
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

            <p class="half-padding">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa, porro, ex maiores amet dolore cum vitae aut quos! Architecto, et illo vel facilis repellendus inventore labore explicabo assumenda exercitationem sit.</p>
        </div>
    </section>

</main>