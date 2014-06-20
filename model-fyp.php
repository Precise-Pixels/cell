<?php

$url  = 'https://api.github.com/repos/Precise-Pixels/cell/stats/contributors';
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $url,
    CURLOPT_USERAGENT => 'JaL-User-Agent'));
$contributors = json_decode(curl_exec($curl));

$commits = $contributors[0]->total + $contributors[1]->total + $contributors[2]->total;

$url  = 'https://api.github.com/repos/Precise-Pixels/cell/branches?per_page=999';
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $url,
    CURLOPT_USERAGENT => 'JaL-User-Agent'));
$branches = json_decode(curl_exec($curl));

$url  = 'https://api.github.com/repos/Precise-Pixels/cell/pulls?state=all&per_page=999';
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $url,
    CURLOPT_USERAGENT => 'JaL-User-Agent'));
$pulls = json_decode(curl_exec($curl));