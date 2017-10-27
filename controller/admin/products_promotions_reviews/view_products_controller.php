<?php

session_start();
//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

try {
    $productDao = \model\database\ProductsDao::getInstance();
    $products = $productDao->getAllProductsAdmin();
} catch (PDOException $e) {
    header("Location: ../../../view/error/pdo_error.php");
    die();
}