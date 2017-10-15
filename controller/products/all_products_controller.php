<?php

//Autoload to require needed model files
function __autoload($className) {
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

$products = null;

//Try to accomplish connection with the database
try {

    $productsDao = \model\database\ProductsDao::getInstance();

    $products = $productsDao->getAllAvailableProducts();


} catch (PDOException $e) {

    header("Location: ../../view/error/pdo_error.php");
}