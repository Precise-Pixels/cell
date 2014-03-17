<?php

if(isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

require_once('php/Environment.php');
$environments      = Environment::getRecentEnvironments($page);
$totalEnvironments = Environment::getTotalEnvironments();