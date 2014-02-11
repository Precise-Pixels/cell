<main>

    <header class="section-padding align-centre dgrey">
        <hgroup class="align-vertical">
            <h1>RESEND VALIDATION EMAIL</h1>
        </hgroup>
    </header>

    <section>
        <div class="section-padding align-centre lgrey">
            <?php
            require_once('php/LoginSystem.php');
            $login_system = new LoginSystem();

            if($_POST) {
                $email = $_POST['email'];

                if(!empty($email)) {
                    $response = $login_system->resend_validation_email($email);
                    echo $response;
                } else {
                    echo '<p class="full warn">Please enter your email.</p>';
                }
            }
            ?>

            <form method="post" class="half-padding">
                <table>
                    <tr>
                        <td><label for="email">Email:</label></td>
                        <td><input type="email" name="email" required autofocus/></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td><input type="submit" value="RESEND" class="btn"/></td>
                    </tr>
                </table>
            </form>

            <p class="half-padding">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa, porro, ex maiores amet dolore cum vitae aut quos! Architecto, et illo vel facilis repellendus inventore labore explicabo assumenda exercitationem sit.</p>
        </div>
    </section>

</main>