<?php
if(isset($_SESSION['status']) && $_SESSION['status'] == 'loggedin') {
    echo '<a href="logout" class="btn">LOGOUT</a>';
} else {
    echo '<a href="login" class="btn">LOGIN / REGISTER</a>';
}