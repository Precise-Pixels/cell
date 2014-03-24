<header id="fixed-header" class="fixed-header--validation section-padding">
    <hgroup class="align-vertical">
        <h1>RESEND VALIDATION EMAIL</h1>
    </hgroup>
</header>

<main>

    <section>
        <div class="section-padding align-centre lgrey">
            <?php
            require_once('php/LoginSystem.php');
            $loginSystem = new LoginSystem();

            if($_POST) {
                $email = $_POST['email'];

                if(!empty($email)) {
                    $response = $loginSystem->resendValidationEmail($email);
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

            <p class="half-padding">Please enter in your email above and we will send you another email so you can validate your account.</p>
        </div>
    </section>

</main>