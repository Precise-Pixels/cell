<?php
if(isset($_SESSION['status'])) {
    if($_SESSION['status'] == 'notsignedin') {
        echo 'You must be logged in to view this page.';
        unset($_SESSION['status']);
    } elseif($_SESSION['status'] == 'signedin') {
        header("location: /user/{$_SESSION['username']}");
    }
}

require_once('php/LoginSystem.php');
$loginSystem = new LoginSystem();
?>

<main>

    <header class="section-padding align-centre dgrey">
        <hgroup class="align-vertical">
            <h1>MYCELL</h1>
        </hgroup>
    </header>

    <section>
        <div class="section-padding align-centre lgrey">
            <h1>SIGN IN</h1>
            <?php
            if(!empty($_POST['signin-submit'])) {
                if(!empty($_POST['email']) && !empty($_POST['password'])) {
                    $response = $loginSystem->signin($_POST['email'], $_POST['password']);
                    echo $response;
                } else {
                    echo $wrapStart . 'Please enter your email and password.' . $wrapEnd;
                }
            }
            ?>

            <form method="post" id="signin-form">
                <table>
                    <tr>
                        <td><label for="email">Email:</label></td>
                        <td><input type="email" name="email" required autofocus/></td>
                    </tr>

                    <tr>
                        <td><label for="password">Password:</label></td>
                        <td><input type="password" name="password" required/></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td><input type="submit" name="signin-submit" value="Sign in" class="btn"/></td>
                    </tr>
                </table>
            </form>
        </div>
    </section>

    <section>
        <div class="section-padding align-centre lgrey">
            <h1>REGISTER</h1>

            <?php
            $wrapStart = '<p class="full warn">';
            $wrapEnd   = '</p>';

            if(!empty($_POST['register-submit'])) {
                $email         = $_POST['email'];
                $password      = $_POST['password'];
                $emailAgain    = $_POST['email-again'];
                $passwordAgain = $_POST['password-again'];

                if(!empty($email) && !empty($password) && !empty($emailAgain) && !empty($passwordAgain)) {
                    if($email === $emailAgain && $password === $passwordAgain) {
                        $exists = $loginSystem->checkUserExists($email);

                        if($exists) {
                            echo $wrapStart . 'An account with this email already exists.' . $wrapEnd;
                        } else {
                            $response = $loginSystem->createUser($email, $password);
                            echo $response;
                        }
                    } else {
                        echo $wrapStart . 'Email and/or password did not match. Please try again.' . $wrapEnd;
                    }
                } else {
                    echo $wrapStart . 'Please enter your email and password.' . $wrapEnd;
                }
            }
            ?>

            <form method="post" id="register-form">
                <table>
                    <tr>
                        <td><label for="email">Email:</label></td>
                        <td><input type="email" name="email" required/></td>
                    </tr>

                    <tr>
                        <td><label for="email-again">Retype email:</label></td>
                        <td><input type="text" name="email-again" required/></td>
                    </tr>

                    <tr>
                        <td><label for="password">Password:</label></td>
                        <td><input type="password" name="password" required/></td>
                    </tr>

                    <tr>
                        <td><label for="password-again">Retype password:</label></td>
                        <td><input type="password" name="password-again" required/></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td><input type="submit" name="register-submit" value="REGISTER" class="btn"/></td>
                    </tr>
                </table>
            </form>
        </div>
    </section>

</main>