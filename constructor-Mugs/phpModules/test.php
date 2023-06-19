<?php
// ---------------------------------------------------------------------------------
//  Resize Image
// ---------------------------------------------------------------------------------
function ResizeImage($FileName, $SaveFile, $MaxWidth, $MaxHeight = null)
{

    $extension = GetFileExtension($FileName);

    switch (strtolower($extension)) {
        case "gif":
            $objImage = imagecreatefromgif($FileName);
            break;
        case "png":
            $objImage = imagecreatefrompng($FileName);
            break;
        default:
            $objImage = imagecreatefromjpeg($FileName);
            break;
    }

    list($width, $height, $type, $attr) = getimagesize($FileName);
    $TargetWidth = $width;
    $TargetHeight = $height;
    if (!is_null($MaxWidth)) {
        if ($MaxWidth < $TargetWidth) {
            $TargetWidth = $MaxWidth;
            $TargetHeight = round($TargetHeight * $TargetWidth / $width);
        }
    }
    if (!is_null($MaxHeight)) {
        if ($MaxHeight < $TargetHeight) {
            $TargetHeight = $MaxHeight;
            $TargetWidth = round($TargetWidth * $TargetHeight / $height);
        }
    }


    $DestImage = imagecreatetruecolor($TargetWidth, $TargetHeight);

    // handle transparancy    
    if (($type == IMAGETYPE_GIF) || ($type == IMAGETYPE_PNG)) {
        $trnprt_indx = imagecolortransparent($objImage);
        // If we have a specific transparent color
        if ($trnprt_indx >= 0) {
            // Get the original image's transparent color's RGB values
            $trnprt_color = imagecolorsforindex($objImage, $trnprt_indx);
            // Allocate the same color in the new image resource
            $trnprt_indx = imagecolorallocate($DestImage, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);

            // Completely fill the background of the new image with allocated color.
            imagefill($DestImage, 0, 0, $trnprt_indx);

            // Set the background color for new image to transparent
            imagecolortransparent($DestImage, $trnprt_indx);
        } elseif ($type == IMAGETYPE_PNG) {

            // Turn off transparency blending (temporarily)
            imagealphablending($DestImage, false);

            // Create a new transparent color for image
            $color = imagecolorallocatealpha($DestImage, 0, 0, 0, 127);

            // Completely fill the background of the new image with allocated color.
            imagefill($DestImage, 0, 0, $color);

            // Restore transparency blending
            imagesavealpha($DestImage, true);
        }
    }



    imagecopyresampled($DestImage, $objImage, 0, 0, 0, 0, $TargetWidth, $TargetHeight, $width, $height);
    switch (strtolower($extension)) {
        case "gif":
            imagegif($DestImage, $SaveFile);
            break;
        case "png":
            imagepng($DestImage, $SaveFile, 0);
            break;
        default:
            imagejpeg($DestImage, $SaveFile, 100);
            break;
    }
}

// ---------------------------------------------------------------------------------
//  GetFileExtension
// ---------------------------------------------------------------------------------
function GetFileExtension($inFileName)
{
    return substr($inFileName, strrpos($inFileName, '.') + 1);
}

//ResizeImage('ScreenShots - 1123373.png', 'test.png', 1700);

$image = new Imagick(__DIR__ . '/ScreenShots - 1123373.png'); // default 72 dpi image
$image->resizeImage(796, 341, imagick::FILTER_UNDEFINED, 1);
//$image->setImageResolution(300, 300);
$image->setImageResolution(796, 300); // it change only image density.
//$image->resampleImage(796, 300, imagick::FILTER_UNDEFINED, 1);
$image->writeImage(__DIR__ . "/img-500dpi.png"); // this image will have 500 dpi

?>
