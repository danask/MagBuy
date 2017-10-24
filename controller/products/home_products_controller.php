<?php

//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

$product = null;

try {

    $productsDao = \model\database\ProductsDao::getInstance();

    $topRated = $productsDao->getTopRated();
    $mostRecent = $productsDao->getMostRecent();
    $mostSold = $productsDao->mostSoldProducts();

} catch (PDOException $e) {

    header("Location: ../../view/error/pdo_error.php");
}