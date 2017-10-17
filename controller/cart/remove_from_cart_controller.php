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
    if (count($cart) < 2) {
        unset($_SESSION['cart']);
    } else {
        $_SESSION['cart'] = implode(";", $cart);
    }
    var_dump($cart);

} else {
    // 404 page
}