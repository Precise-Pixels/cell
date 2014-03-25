<?php

require('ProfanityFilter.php');

$str = $_POST['str'];

echo ProfanityFilter::containsProfanity($str);