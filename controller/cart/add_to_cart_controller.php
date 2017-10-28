<?php
//Include Error Handler
require_once '../../utility/error_handler.php';

session_start();
//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

if (isset($_GET['pid'])) {

    $productId = $_GET['pid'];
    $quantity = $_GET['pqty'];
    try {
        $productsDao = \model\database\ProductsDao::getInstance();
        $productImagesDao = \model\database\ProductImagesDao::getInstance();
        $productDetails = $productsDao->getProductByID($productId);
        $productImage = $productImagesDao->getFirstProductImage($productId);
    } catch (PDOException $e) {
        $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
        error_log($message, 3, 'errors.log');
        header("Location: ../../view/error/error_500.php");
        die();
    }
    $cartProduct = new \model\CartProduct();
    $cartProduct->setId($productId);
    $cartProduct->setTitle($productDetails['title']);
    if ($productDetails['percent'] != null) {
        $cartProduct->setPrice(round($productDetails['price'] - (($productDetails['price'] * $productDetails['percent']) / 100), 2));
    } else {
        $cartProduct->setPrice($productDetails['price']);
    }
    $cartProduct->setImage($productImage);

    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
        if (array_key_exists($cartProduct->getId(), $cart)) {
            $cartProduct->setQuantity($cart[$cartProduct->getId()]->getQuantity() + $quantity);
            $cart[$cartProduct->getId()] = $cartProduct;
        } else {
            $cartProduct->setQuantity($quantity);
            $cart[$cartProduct->getId()] = $cartProduct;
        }
        $_SESSION['cart'] = $cart;
    } else {
        $cartProduct->setQuantity($quantity);
        $cart[$cartProduct->getId()] = $cartProduct;
        $_SESSION['cart'] = $cart;
    }

    header("Location: ../../view/main/index.php");
    die();
} else {
    header('Location: ../../view/error/error_404.php');
    die();
}