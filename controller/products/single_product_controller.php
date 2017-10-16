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

    $product = $productsDao->getProductByID($productId);
    $specifications = $specsDao->getAllSpecificationsForProduct($productId);

} catch (PDOException $e) {

    header("Location: ../../view/error/pdo_error.php");
}