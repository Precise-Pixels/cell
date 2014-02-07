<?php
if(isset($_SESSION['status'])) {
    if($_SESSION['status'] == 'notloggedin') {
        echo 'You must be logged in to view this page.';
        unset($_SESSION['status']);
    } elseif($_SESSION['status'] == 'loggedin') {
        header("location: /user/{$_SESSION['username']}");
    }
}

require_once('php/LoginSystem.php');
$login_system = new LoginSystem();
?>

<h1>SIGN IN</h1>

<?php
if(!empty($_POST['signin-submit'])) {
    if(!empty($_POST['email']) && !empty($_POST['password'])) {
        $response = $login_system->signin($_POST['email'], $_POST['password']);
        echo $response;
    } else {
        echo $wrap_start . 'Please enter your email and password.' . $wrap_end;
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
            <td><input type="submit" name="signin-submit" value="Sign in"/></td>
        </tr>
    </table>
</form>

<h1>REGISTER</h1>

<?php
$wrap_start = '<p class="full error">';
$wrap_end   = '</p>';

if(!empty($_POST['register-submit'])) {
    $email          = $_POST['email'];
    $password       = $_POST['password'];
    $email_again    = $_POST['email_again'];
    $password_again = $_POST['password_again'];

    if(!empty($email) && !empty($password) && !empty($email_again) && !empty($password_again)) {
        if($email === $email_again && $password === $password_again) {
            $exists = $login_system->check_user_exists($email);

            if($exists) {
                echo $wrap_start . 'An account with this email already exists.' . $wrap_end;
            } else {
                $response = $login_system->create_user($email, $password);
                echo $response;
            }
        } else {
            echo $wrap_start . 'Email and/or password did not match. Please try again.' . $wrap_end;
        }
    } else {
        echo $wrap_start . 'Please enter your email and password.' . $wrap_end;
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
            <td><label for="email_again">Retype email:</label></td>
            <td><input type="text" name="email_again" required/></td>
        </tr>

        <tr>
            <td><label for="password">Password:</label></td>
            <td><input type="password" name="password" required/></td>
        </tr>

        <tr>
            <td><label for="password_again">Retype password:</label></td>
            <td><input type="password" name="password_again" required/></td>
        </tr>

        <tr>
            <td></td>
            <td><input type="submit" name="register-submit" value="REGISTER" class="btn"/></td>
        </tr>
    </table>
</form>