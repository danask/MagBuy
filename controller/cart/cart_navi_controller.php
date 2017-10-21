<?php

if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
    $cartItems = 0;
    $cartTotalPrice = 0;
    foreach ($cart as $cartProduct) {
        $cartItems += $cartProduct->getQuantity();
        $cartTotalPrice += $cartProduct->getPrice() * $cartProduct->getQuantity();
    }

} else {
    $cartItems = "0";
    $cartTotalPrice = "0.00";
}