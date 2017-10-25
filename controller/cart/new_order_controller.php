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
        foreach ($cart as $cartProduct) {
            $ordersDao->addOrderProduct($orderId, $cartProduct->getId(), $cartProduct->getQuantity());
        }
        unset($_SESSION['cart']);
        $_SESSION['oid'] = $orderId;
        header("Location: ../../view/main/checkout.php");
    } catch (PDOException $e) {
        header("Location: ../../view/error/pdo_error.php");
    }
} else {
    //error
}