<?php

//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

$cartProducts = array();
if (isset($_SESSION['cart'])) {
    $cartProductIds = $_SESSION['cart'];
    $cartProductIds = explode(';', $cartProductIds);
    $productsDao = \model\database\ProductsDao::getInstance();
    foreach ($cartProductIds as $productId) {
        try {
            $cartProducts[] = $productsDao->getProductByID($productId);
        } catch (PDOException $e) {
            header("Location: ../../view/error/pdo_error.php");
        }
    }
}

//Try to accomplish connection with the database
try {

    $productsDao = \model\database\ProductsDao::getInstance();

    $products = $productsDao->getAllAvailableProducts();


} catch (PDOException $e) {

    header("Location: ../../view/error/pdo_error.php");
}