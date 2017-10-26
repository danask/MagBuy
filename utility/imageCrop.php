<?php

function cropImage($path, $cropPX)
{

//Your Image
    $imgSrc = $path;

//getting the image dimensions
    list($width, $height) = getimagesize($imgSrc);


    function imageCreateFromAny($filepath)
    {

        $im = null;

        $type = exif_imagetype($filepath); // [] if you don't have exif you could use getImageSize()
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

    //saving the image into memory (for manipulation with GD Library)
    $myImage = imageCreateFromAny($imgSrc);


// calculating the part of the image to use for thumbnail
    if ($width > $height) {
        $y = 0;
        $x = ($width - $height) / 2;
        $smallestSide = $height;
    } else {
        $x = 0;
        $y = ($height - $width) / 2;
        $smallestSide = $width;
    }

// copying the part into thumbnail
    $thumbSize = $cropPX;
    $thumb = imagecreatetruecolor($thumbSize, $thumbSize);
    imagecopyresampled($thumb, $myImage, 0, 0, $x, $y, $thumbSize, $thumbSize, $smallestSide, $smallestSide);

//final output
    header('Content-type: image/jpeg');
    imagejpeg($thumb, $imgSrc);

}