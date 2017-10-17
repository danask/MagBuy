<?php

if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
    $cart = explode(';', $cart);
    $cartItems = count($cart);
    $cartTotalPrice = 0;

    $productsDao = \model\database\ProductsDao::getInstance();
    foreach ($cart as $productId) {
        try {
            $price = $productsDao->getProductPrice($productId);
            $cartTotalPrice += $price;
        } catch (PDOException $e) {
            header("Location: ../../view/error/pdo_error.php");
        }
    }
} else {
    $cartItems = "0";
    $cartTotalPrice = "0.00";
}