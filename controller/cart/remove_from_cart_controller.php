<?php

session_start();

if (isset($_SESSION['cart']) && isset($_GET['pid'])) {
//    if (!isset($_SESSION['loggedUser'])) {
//        header('Location: ../../view/user/login.php');
//    }
    $productId = $_GET['pid'];

    $cart = $_SESSION['cart'];
    $cart = explode(";", $cart);
    if (in_array($productId, $cart)) {
        $key = array_search($productId, $cart);
        unset($cart[$key]);
    }
    $_SESSION['cart'] = implode(";", $cart);

    header("Location: ../../view/main/index.php");
} else {
    // 404 page
}