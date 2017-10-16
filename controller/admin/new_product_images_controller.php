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

        $image = new \model\ProductImage($imageUrl, $productId);

        try {

            $productImageDao = \model\database\ProductImagesDao::getInstance();

            $productImageDao->addProductImage($image);

            header("Location: ../../view/main/index.php");

        } catch (PDOException $e) {
            echo "PDO EXCEPTION";
//            header("Location: ../../view/error/pdo_error.php");
        }
    }

} else {
    //Locate to error page
}