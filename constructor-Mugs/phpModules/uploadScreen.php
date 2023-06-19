<?php

if (isset($_POST['image'])) {
    $file_name_id = rand(1, 10000000);
    $filteredData = substr($_POST['image'], strpos($_POST['image'], ",") + 1);
    $unencodedData = base64_decode($filteredData);
    file_put_contents('uploads/screenShots/ScreenShots - ' . $file_name_id . '.png', $unencodedData);

    $image = new IMagick(__DIR__ . '/uploads/screenShots/ScreenShots - ' . $file_name_id . '.png');

    $flattened = new IMagick();
    $flattened->newImage($image->getImageWidth(), $image->getImageHeight(), new ImagickPixel("white"));

    $flattened->compositeImage($image, imagick::COMPOSITE_OVER, 0, 0);

    $flattened->setImageFormat("jpg");
    $flattened->writeImage(__DIR__ . '/uploads/screenShots/ScreenShots - ' . $file_name_id . '.jpg');

    $image->clear();
    $image->destroy();
    $flattened->clear();
    $flattened->destroy();

    die(json_encode(array('name' => 'uploads/screenShots/ScreenShots - ' . $file_name_id . '.jpg')));
}