<?php

$heightsString = $_POST['h'];
$resolution    = $_POST['r'];

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

// imagefilter($img, IMG_FILTER_GAUSSIAN_BLUR);
// imagefilter($img, IMG_FILTER_SMOOTH, -2);
// imagefilter($img, IMG_FILTER_GAUSSIAN_BLUR);

/*for ($i = 1; $i < 10; $i++) {
    imagefilter($img, IMG_FILTER_GAUSSIAN_BLUR);
}*/

imagepng($img, 'generated-image.png');
imagedestroy($img);