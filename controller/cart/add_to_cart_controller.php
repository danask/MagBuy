<?php

session_start();

if (isset($_GET['pid'])) {
//    if (!isset($_SESSION['loggedUser'])) {
//        header('Location: ../../view/user/login.php');
//    }
    $productId = $_GET['pid'];

    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
        $cart = $cart . ";" . $productId;
        $_SESSION['cart'] = $cart;
    } else {
        $_SESSION['cart'] = $productId;
        var_dump($_SESSION['cart']);
    }

    header("Location: ../../view/main/index.php");
} else {
    // 404 page
}