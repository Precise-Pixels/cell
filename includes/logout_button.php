<?php
if(isset($_SESSION['status']) && $_SESSION['status'] == 'loggedin') {
    echo '<a href="/logout"><button>Logout</button></a>';
}