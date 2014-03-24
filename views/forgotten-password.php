<header id="fixed-header" class="fixed-header--forgotten section-padding">
    <hgroup class="align-vertical">
        <h1>FORGOTTEN YOUR PASSWORD</h1>
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
                    $exists = $loginSystem->checkUserExists($email);

                    if($exists) {
                        $response = $loginSystem->sendResetPasswordLink($email);
                        echo $response;
                    } else {
                        echo '<p class="full warn">No account with this email exists.</p>';
                    }
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
                        <td><input type="submit" value="RESET" class="btn"/></td>
                    </tr>
                </table>
            </form>

            <!-- <p class="half-padding"><i class="ico-info"></i>Please enter your email and a link to reset your password should be with you shortly. If it has been five minutes and you still haven't received it, please check your spam.</p> -->
        </div>
    </section>

</main>