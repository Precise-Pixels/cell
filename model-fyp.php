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

$url  = 'https://api.github.com/repos/Precise-Pixels/cell/branches?per_page=100&page=1';
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $url,
    CURLOPT_USERAGENT => 'JaL-User-Agent',
    CURLOPT_SSL_VERIFYPEER => false));
$branches1 = json_decode(curl_exec($curl));

$url  = 'https://api.github.com/repos/Precise-Pixels/cell/branches?per_page=100&page=2';
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $url,
    CURLOPT_USERAGENT => 'JaL-User-Agent',
    CURLOPT_SSL_VERIFYPEER => false));
$branches2 = json_decode(curl_exec($curl));

$branches = count($branches1) + count($branches2);

$url  = 'https://api.github.com/repos/Precise-Pixels/cell/pulls?state=all&per_page=100&page=1';
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $url,
    CURLOPT_USERAGENT => 'JaL-User-Agent',
    CURLOPT_SSL_VERIFYPEER => false));
$pulls1 = json_decode(curl_exec($curl));

$url  = 'https://api.github.com/repos/Precise-Pixels/cell/pulls?state=all&per_page=100&page=2';
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $url,
    CURLOPT_USERAGENT => 'JaL-User-Agent',
    CURLOPT_SSL_VERIFYPEER => false));
$pulls2 = json_decode(curl_exec($curl));

$pulls = count($pulls1) + count($pulls2);