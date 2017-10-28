<?php
//Include Error Handler
require_once '../../utility/error_handler.php';

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

        $result = $ordersDao->newOrder($order, $cart);
        if ($result === false) {
            header("Location: ../../view/error/error_500.php");
            die();
        }
        $orderId = $result[0];
        $totalPrice = $result[1];
        $quantity = $result[2];

        unset($_SESSION['cart']);
        $_SESSION['oid'] = $orderId;
        $_SESSION['oItems'] = $quantity;
        $_SESSION['oTotalPrice'] = $totalPrice;
    } catch (PDOException $e) {
        $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
        error_log($message, 3, 'errors.log');
        header("Location: ../../view/error/error_500.php");
        die();
    }
    header("Location: ../../view/main/checkout.php");
    die();
} else {
    header("Location: ../../view/error/error_400.php");
    die();
}