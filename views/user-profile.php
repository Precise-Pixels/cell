<h1>PROFILE</h1>

<?php
require_once('php/User.php');
$user = new User();

$data = $user->getData($userHandle);

if(!$data) {
    header('location: /404');
} else {
    var_dump($data);
}
?>