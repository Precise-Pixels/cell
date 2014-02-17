<?php

$heightsString = $_POST['h'];
$resolution    = $_POST['r'];
$tileSize      = $_POST['t'];

$imgWidth = $imgHeight = $resolution;

$img = imagecreatetruecolor($imgWidth, $imgHeight);

$rows = explode('-', $heightsString);
// var_dump($rows);

foreach($rows as $y => $row) {
    $columns = explode(',', $row);
    // var_dump($columns);
    foreach($columns as $x => $column) {
        // var_dump($column);
        $colour = imagecolorallocate($img, $column, $column, $column);
        // var_dump($x,$y);
        // var_dump($colour);
        imagesetpixel($img,$x,$y,$colour);
    }
}

$scaledImg = imagecreatetruecolor($tileSize, $tileSize);
imagecopyresampled($scaledImg, $img, 0, 0, 0, 0, $tileSize, $tileSize, $resolution, $resolution);

// imagefilter($scaledImg, IMG_FILTER_GAUSSIAN_BLUR);
// imagefilter($scaledImg, IMG_FILTER_SMOOTH, -2);
// imagefilter($scaledImg, IMG_FILTER_GAUSSIAN_BLUR);

// for ($i = 1; $i < 10; $i++) {
    // imagefilter($scaledImg, IMG_FILTER_GAUSSIAN_BLUR);
// }

imagepng($scaledImg, 'generated-image.png');
imagedestroy($scaledImg);

// imagepng($img, 'generated-image.png');
// imagedestroy($img);