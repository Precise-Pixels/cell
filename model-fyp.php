<?php

$url  = 'https://api.github.com/repos/Precise-Pixels/cell/contributors';
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $url,
    CURLOPT_USERAGENT => 'JaL-User-Agent',
    CURLOPT_SSL_VERIFYPEER => false));
$contributors = json_decode(curl_exec($curl));

$commits = $contributors[0]->contributions + $contributors[1]->contributions + $contributors[2]->contributions;

$url  = 'https://api.github.com/repos/Precise-Pixels/cell/branches?per_page=999';
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $url,
    CURLOPT_USERAGENT => 'JaL-User-Agent',
    CURLOPT_SSL_VERIFYPEER => false));
$branches = json_decode(curl_exec($curl));

$url  = 'https://api.github.com/repos/Precise-Pixels/cell/pulls?state=all&per_page=999';
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $url,
    CURLOPT_USERAGENT => 'JaL-User-Agent',
    CURLOPT_SSL_VERIFYPEER => false));
$pulls = json_decode(curl_exec($curl));