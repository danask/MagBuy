<?php

session_start();
//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
    $cartIsEmpty = 0;
} else {
    $cart = array();
    $cartIsEmpty = 1;
}

if (isset($_GET['oid'])) {
    $orderNumber = $_GET['oid'];
    $orderSuccessful = 1;
} else {
    $orderSuccessful = 0;
}