<?php

//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}


if (isset($_GET['lp'])) {
    $loadedProducts = $_GET['lp'];
    $subcatId = $_GET['subcid'];

    $productsDao = \model\database\ProductsDao::getInstance();
    $products = $productsDao->getProductsBySubcategoryInfiScroll($subcatId, $loadedProducts);

    header('Content-Type: application/json');
    echo json_encode($products);
}