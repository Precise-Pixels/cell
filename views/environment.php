<h1>ENV</h1>

<?php
require_once('php/Environment.php');
$environment = new Environment();

$environment->getData($username, $envId);
?>