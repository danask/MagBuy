<?php


namespace model\database;

use model\database\Connect\Connection;
use model\Order;

class OrdersDao
{
    //Make Singletonn
    private static $instance;
    private $pdo;

    //Statements defined as constants
    const ADD_NEW_ORDER = "INSERT INTO orders (id, user_id, created_at, status) VALUES (?, ?, ?, ?)";
    const ADD_ORDER_PRODUCT = "INSERT INTO order_products (order_id, product_id, quantity) VALUES (?, ?, ?)";

    //Get connection in construct
    private function __construct()
    {

        $this->pdo = Connection::getInstance()->getConnection();
    }

    public static function getInstance()
    {

        if (self::$instance === null) {
            self::$instance = new OrdersDao();
        }

        return self::$instance;
    }

    function newOrder(Order $order)
    {
        $statement = $this->pdo->prepare(self::ADD_NEW_ORDER);
        $statement->execute(array($order->getId(), $order->getUserId(), $order->getCreatedAt(), $order->getStatus()));
        $orderId = $this->pdo->lastInsertId();

        return $orderId;
    }

    function addOrderProduct($orderId, $productId, $quantity)
    {
        $statement = $this->pdo->prepare(self::ADD_ORDER_PRODUCT);
        $statement->execute(array($orderId, $productId, $quantity));

        return true;
    }

}