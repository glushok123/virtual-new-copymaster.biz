<?php

if (isset($_POST['image'])) {  
    $file_name_id= rand(1,10000000);
    $filteredData = substr($_POST['image'], strpos($_POST['image'], ",")+1);
    $unencodedData = base64_decode($filteredData);
    file_put_contents('uploads/screenShots/ScreenShots - ' . $file_name_id . '.png', $unencodedData);
    die(json_encode(array('name' => 'uploads/screenShots/ScreenShots - ' . $file_name_id . '.png')));
}