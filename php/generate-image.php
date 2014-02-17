<?php

$heightsString = $_POST['h'];
$resolution    = $_POST['r'];
$tileSize      = $_POST['t'];

$imgWidth = $imgHeight = $resolution;

$img = imagecreatetruecolor($imgWidth, $imgHeight);

$rows = explode('-', $heightsString);

foreach($rows as $y => $row) {
    $columns = explode(',', $row);
    foreach($columns as $x => $column) {
        $colour = imagecolorallocate($img, $column, $column, $column);
        imagesetpixel($img,$x,$y,$colour);
    }
}

$scaledImg = imagecreatetruecolor($tileSize, $tileSize);
imagecopyresampled($scaledImg, $img, 0, 0, 0, 0, $tileSize, $tileSize, $resolution, $resolution);

for ($i = 1; $i < 10; $i++) {
    imagefilter($scaledImg, IMG_FILTER_GAUSSIAN_BLUR);
}

imagepng($scaledImg, 'generated-image.png');
imagedestroy($scaledImg);