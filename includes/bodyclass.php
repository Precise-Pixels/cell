<?php
echo str_replace('/', '_', substr(parse_url($_SERVER['REQUEST_URI'])['path'], 1));