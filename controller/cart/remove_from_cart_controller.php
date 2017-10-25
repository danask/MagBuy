<?php

session_start();
//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

if (isset($_SESSION['cart']) && isset($_GET['pid'])) {
    $productId = $_GET['pid'];
    $cart = $_SESSION['cart'];
    if (isset($_GET['pqty'])) {
        $cartProduct = $cart[$productId];
        $cartProduct->setQuantity($cartProduct->getQuantity() - 1);
        $cart[$productId] = $cartProduct;
        $_SESSION['cart'] = $cart;
        echo "tuk";
    } else {
        if (array_key_exists($productId, $cart)) {
            unset($cart[$productId]);
        }
        if (count($cart) < 2) {
            unset($_SESSION['cart']);
        } else {
            $_SESSION['cart'] = $cart;
        }
        echo "tam";
    }
} else {
    // 404 page
}