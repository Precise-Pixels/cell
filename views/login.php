<h1>LOGIN</h1>

<form method="post" action="">
    <table>
        <tr>
            <td><label for="username">Username: </label></td>
            <td><input type="text" name="username"/></td>
        </tr>
    
        <tr>
            <td><label for="password">Password: </label></td>
            <td><input type="password" name="password"/></td>
        </tr>
    
        <tr>
            <td></td>
            <td><input type="submit" id="submit" value="Login" name="submit"/></td>
        </tr>
    </table>
</form>

<?php
if(isset($_SESSION['status'])) {
    if($_SESSION['status'] == 'notloggedin') {
        echo 'You must be logged in to view this page.';
        unset($_SESSION['status']);
    } elseif($_SESSION['status'] == 'loggedin') {
        header('location: /mycell');
    }
}

require_once('php/LoginSystem.php');
$login_system = new LoginSystem();
if($_POST) {
    if(!empty($_POST['username']) && !empty($_POST['password'])) {
        $response = $login_system->validate_user($_POST['username'], $_POST['password']);
        echo $response;
    } else {
        echo 'Please enter your username and password.';
    }
}
?>