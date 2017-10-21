<?php

session_start();

if (isset($_SESSION['cart']) && isset($_GET['pid'])) {

    $productId = $_GET['pid'];
    $cart = $_SESSION['cart'];

    if (array_key_exists($productId, $cart)) {
        unset($cart[$productId]);
    }
    if (count($cart) < 2) {
        unset($_SESSION['cart']);
    } else {
        $_SESSION['cart'] = $cart;
    }

} else {
    // 404 page
}