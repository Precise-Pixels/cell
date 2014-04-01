<header id="fixed-header" class="fixed-header--signin section-padding">
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
                    $exists = $loginSystem->checkUserExists($email, '');

                    if($exists) {
                        $response = $loginSystem->sendResetPasswordLink($email);
                        echo $response;
                    } else {
                        echo '<p class="full warn"><i class="ico-warning"></i>No account with this email exists.</p>';
                    }
                } else {
                    echo '<p class="full warn"><i class="ico-warning"></i>Please enter your email.</p>';
                }
            }
            ?>

            <form method="post">
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

        </div>
    </section>

    <section>
        <div class="align-centre section-padding mblue">
            <p><i class="ico-info"></i>Please enter the email you signed up with and a link to reset your password will be with you shortly.</p>
            <p><i class="ico-info"></i>Please note that the email may come through to your spam/junk folder.</p>
        </div>
    </section>
</main>