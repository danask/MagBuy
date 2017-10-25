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
    $userId = $_SESSION['loggedUser'];
    $order = new \model\Order($userId, $cart);

    try {
        $ordersDao = \model\database\OrdersDao::getInstance();
        $orderId = $ordersDao->newOrder($order);
        $totalPrice = 0;
        $quantity = 0;
        foreach ($cart as $cartProduct) {
            $ordersDao->addOrderProduct($orderId, $cartProduct->getId(), $cartProduct->getQuantity());
            $totalPrice += $cartProduct->getPrice() * $cartProduct->getQuantity();
            $quantity += $cartProduct->getQuantity();
        }
        unset($_SESSION['cart']);
        $_SESSION['oid'] = $orderId;
        $_SESSION['oItems'] = $quantity;
        $_SESSION['oTotalPrice'] = $totalPrice;
    } catch (PDOException $e) {
        header("Location: ../../view/error/pdo_error.php");
    }
    header("Location: ../../view/main/checkout.php");
} else {
    //error
}