<?php
//Include Error Handler
require_once '../../../utility/error_handler.php';

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
        $message = $_SERVER['SCRIPT_NAME'] . " $e\n";
        error_log($message, 3, 'errors.log');
        header("Location: ../../../view/error/error_500.php");
        die();
    }
} else {
    header("Location: ../../../view/error/error_400.php");
    die();
}