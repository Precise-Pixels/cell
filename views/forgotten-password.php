<h1>Forgotten Your Password</h1>

<?php
require_once('php/LoginSystem.php');
$login_system = new LoginSystem();

if($_POST) {
    $email = $_POST['email'];

    if(!empty($email)) {
        $exists = $login_system->check_user_exists($email);

        if($exists) {
            $response = $login_system->send_reset_password_link($email);
            echo $response;
        } else {
            echo '<p class="full error">No account with this email exists.</p>';
        }
    } else {
        echo '<p class="full error">Please enter your email.</p>';
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

<p class="half-padding">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa, porro, ex maiores amet dolore cum vitae aut quos! Architecto, et illo vel facilis repellendus inventore labore explicabo assumenda exercitationem sit.</p>