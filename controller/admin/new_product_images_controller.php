<?php

//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

if (isset($_POST['submit'])) {

    $productId = $_POST['product_id'];

    for ($i = 1; $i < 5; $i++) {

        $imagesDirectory = null;
        $imageName = "pic$i";
        $image = new \model\ProductImage();


        if(isset($_FILES[$imageName]['tmp_name'])) {

            $tmpName = $_FILES[$imageName]['tmp_name'];


            if (!is_uploaded_file($tmpName)) {

                //Redirect to Error page
                header('Location: ../../view/error/admin_upload_error.php');
            }

            //Get the uploaded file's type, extension and size
            $fileFormat = mime_content_type($tmpName);
            $type = explode("/", $fileFormat)[0];
            $extension = explode("/", $fileFormat)[1];
            $fileSize = filesize($tmpName);


            //Validate image file - image file below 2MB
            if ($type == "image" && $fileSize < 2048576) {

                $uploadTime = microtime();
                $imagesDirectory = "../../web/uploads/productImages/$productId-$uploadTime.$extension";

            } else {

                //Redirect to Error page
                header('Location: ../../view/error/admin_upload_error.php');
            }


            $image->setImageUrl($imagesDirectory);
            $image->setProductId($productId);

        } else {

            //Redirect to Error page
            header('Location: ../../view/error/admin_upload_error.php');
        }

        try {

            $productImageDao = \model\database\ProductImagesDao::getInstance();
            $productImageDao->addProductImage($image);

            move_uploaded_file($tmpName, $imagesDirectory);

            header("Location: ../../view/main/index.php");

        } catch (PDOException $e) {

            header("Location: ../../view/error/pdo_error.php");
        }
    }

} else {
    
    //Redirect to Error page
    header('Location: ../../view/error/admin_upload_error.php');
}