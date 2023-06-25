<?php


if (isset($_POST['my_file_upload'])) {
    // ВАЖНО! тут должны быть все проверки безопасности передавемых файлов и вывести ошибки если нужно

    $uploaddir = './uploads'; // . - текущая папка где находится submit.php

    // cоздадим папку если её нет
    if (!is_dir($uploaddir))
        mkdir($uploaddir, 0777);

    $files = $_FILES; // полученные файлы
    $done_files = array();

    // переместим файлы из временной директории в указанную
    foreach ($files as $file) {
        $file_name = $file['name'];
        $uploaded_file = $file['tmp_name'];
        $upl_img_properties = getimagesize($uploaded_file);
        list($width, $height) = getimagesize($uploaded_file);
        $file_name_id = rand(10, 100);
        $new_file_name = "Resized Image_" . $file_name_id;
        $folder_path = "./uploads/";
        $img_ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $image_type = $upl_img_properties[2];

        switch ($image_type) {
            //for PNG Image
            case IMAGETYPE_PNG:
                $image_type_id = imagecreatefrompng($uploaded_file);
                $target_layer = image_resize($image_type_id, $upl_img_properties[0], $upl_img_properties[1], $width, $height);
                imagepng($target_layer, $folder_path . $new_file_name . "." . $img_ext);
                break;
            //for GIF Image
            case IMAGETYPE_GIF:
                $image_type_id = imagecreatefromgif($uploaded_file);
                $target_layer = image_resize($image_type_id, $upl_img_properties[0], $upl_img_properties[1], $width, $height);
                imagegif($target_layer, $folder_path . $new_file_name . "." . $img_ext);
                break;
            //for JPEG Image
            case IMAGETYPE_JPEG:
                $image_type_id = imagecreatefromjpeg($uploaded_file);
                $target_layer = image_resize($image_type_id, $upl_img_properties[0], $upl_img_properties[1], $width, $height);
                imagejpeg($target_layer, $folder_path . $new_file_name . "." . $img_ext);
                break;

            default:
                echo "Please select a 'PNG', 'GIF'or JPEG image";
                exit;
                break;
        }

        //for the record move the uploaded file to the resized image directory
        move_uploaded_file($uploaded_file, $folder_path . "Original Image_" . $file_name_id . "." . $img_ext);

        die(json_encode(array('name' => "Resized Image_" . $file_name_id . "." . $img_ext)));

        echo "Image is resized according to given Width and Height";

        if (move_uploaded_file($file['tmp_name'], "$uploaddir/$file_name")) {
            $done_files[] = realpath("$uploaddir/$file_name");
        }

        die(json_encode(array('name' => $file_name)));
    }

    $data = $done_files ? array('files' => $done_files) : array('error' => 'Ошибка загрузки файлов.');

    die(json_encode($data));
}


function image_resize($image_type_id, $img_width, $img_height, $width, $height)
{
    $k = $width / $height;

    $target_width = 1100;
    $target_height = $target_width / $k;
    $target_layer = imagecreatetruecolor($target_width, $target_height);
    imagecopyresampled($target_layer, $image_type_id, 0, 0, 0, 0, $target_width, $target_height, $img_width, $img_height);
    return $target_layer;
}