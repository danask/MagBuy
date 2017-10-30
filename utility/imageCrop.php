<?php

/**
 * Function for cropping center of image using aspect ratio
 * @param $imagePath - Receives path of image with extension
 * @param $cropPX - Receives pixel for both width and height
 */
function cropImage($imagePath, $cropPX){

    //Getting the image dimensions
    list($width, $height) = getimagesize($imagePath);

    //Function for creating image for any format
    if(!function_exists('imageCreateFromAny')) {
        function imageCreateFromAny($filepath)
        {

            $im = null;

            $type = exif_imagetype($filepath); // [] If you don't have exif you could use getImageSize()
            $allowedTypes = array(
                1,  // [] gif
                2,  // [] jpg
                3,  // [] png
                6   // [] bmp
            );
            if (!in_array($type, $allowedTypes)) {
                return false;
            }
            switch ($type) {
                case 1 :
                    $im = imageCreateFromGif($filepath);
                    break;
                case 2 :
                    $im = imageCreateFromJpeg($filepath);
                    break;
                case 3 :
                    $im = imageCreateFromPng($filepath);
                    break;
            }
            return $im;
        }
    }

    //Saving the image into memory (for manipulation with GD Library)
    $myImage = imageCreateFromAny($imagePath);


// Calculating the part of the image to use for thumbnail
    if ($width > $height) {
        $y = 0;
        $x = ($width - $height) / 2;
        $smallestSide = $height;
    } else {
        $x = 0;
        $y = ($height - $width) / 2;
        $smallestSide = $width;
    }

// Copying the part into thumbnail
    $thumbSize = $cropPX;
    $thumb = imagecreatetruecolor($thumbSize, $thumbSize);
    imagecopyresampled($thumb, $myImage, 0, 0, $x, $y, $thumbSize, $thumbSize, $smallestSide, $smallestSide);

//Final output
    imagejpeg($thumb, $imagePath);
}