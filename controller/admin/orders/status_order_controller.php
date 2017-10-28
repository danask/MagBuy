<?php

//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}


if (isset($_GET['oid'])) {
    try {
        $orderId = $_GET['oid'];
        $newStatus = $_GET['ns'];
        $orderDao = \model\database\OrdersDao::getInstance();
        $specs = $orderDao->changeOrderStatus($orderId, $newStatus);

    } catch (PDOException $e) {
        header("Location: ../../../view/error/error_500.php");
        die();
    }
}