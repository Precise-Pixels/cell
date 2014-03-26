<?php
require_once('php/LoginSystem.php');
$loginSystem = new LoginSystem();
?>

<header id="fixed-header" class="fixed-header--signin section-padding">
    <hgroup class="align-vertical">
        <h1>SIGN IN / REGISTER</h1>
    </hgroup>
</header>

<main>

    <section>
        <div class="section-padding align-centre mblue">
            <?php
            if(isset($_SESSION['status'])) {
                if($_SESSION['status'] == 'notsignedin') {
                    echo '<p class="full warn"><i class="ico-info"></i>You must be logged in to view this page.</p>';
                    unset($_SESSION['status']);
                } elseif($_SESSION['status'] == 'signedin') {
                    header("location: /user/{$_SESSION['username']}");
                }
            }
            ?>
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
                        <td><input type="submit" name="signin-submit" value="SIGN IN" class="btn"/></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td><p class="forgot-password"><i class="ico-question"></i><a href="forgotten-password">Forgotten Password</a></p></td>
                    </tr>

                </table>
            </form>
        </div>
    </section>

    <section>
        <div class="section-padding align-centre lgrey">
            <h1>REGISTER</h1>

            <?php
            require_once('php/ProfanityFilter.php');

            $wrapStart = '<p class="full warn"><i class="ico-info"></i>';
            $wrapEnd   = '</p>';

            if(!empty($_POST['register-submit'])) {
                $username      = $_POST['username'];
                $email         = $_POST['email'];
                $password      = $_POST['password'];
                $emailAgain    = $_POST['email-again'];
                $passwordAgain = $_POST['password-again'];

                if(!empty($username) && !empty($email) && !empty($password) && !empty($emailAgain) && !empty($passwordAgain)) {
                    if(preg_match('/^[a-zA-Z0-9]+$/', $username)) {
                        if($email === $emailAgain && $password === $passwordAgain) {
                            $exists = $loginSystem->checkUserExists($email, $username);

                            if($exists) {
                                echo $wrapStart . 'An account with this email/username already exists.' . $wrapEnd;
                            } else {
                                if(!ProfanityFilter::containsProfanity($username)) {
                                    $response = $loginSystem->createUser($email, $password, $username);
                                    echo $response;
                                } else {
                                    echo $wrapStart . 'No profanity please.' . $wrapEnd;
                                }
                            }
                        } else {
                            echo $wrapStart . 'Email and/or password did not match. Please try again.' . $wrapEnd;
                        }
                    } else {
                        echo $wrapStart . 'Username must be alphanumeric (a-z A-Z 0-9).' . $wrapEnd;
                    }
                } else {
                    echo $wrapStart . 'Please enter your email and password.' . $wrapEnd;
                }
            }
            ?>

            <form method="post" id="register-form">
                <table>
                    <tr>
                        <td><label for="username">Username:</label></td>
                        <td><input type="text" name="username" maxlength="19" required/></td>
                    </tr>

                    <tr>
                        <td><label for="email">Email <small>(private)</small>:</label></td>
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