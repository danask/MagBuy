<?php

//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

$product = null;

//Try to accomplish connection with the database
try {


    $productId = $_GET['pid'];
    $productsDao = \model\database\ProductsDao::getInstance();
    $specsDao = \model\database\ProductSpecificationsDao::getInstance();
    $reviewsDao = \model\database\ReviewsDao::getInstance();
    $imagesDao = \model\database\ProductImagesDao::getInstance();

    $product = $productsDao->getProductByID($productId);
    $specifications = $specsDao->getAllSpecificationsForProduct($productId);
    $reviews = $reviewsDao->getReviewsForProduct($productId);
    $images = $imagesDao->getAllProductImages($productId);
    $reviewsCount = count($reviews);
    $relatedProducts = $productsDao->getRelated($productId);

    //Check if rating is null
    if($product['average'] === null) {
        $product['average'] = 0;
    } else {
        $product['average'] = round($product['average'], 0);
    }

} catch (PDOException $e) {

    header("Location: ../../view/error/pdo_error.php");
}