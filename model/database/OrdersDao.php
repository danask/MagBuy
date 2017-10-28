<?php


namespace model\database;

use model\database\Connect\Connection;
use model\Order;
use PDO;

class OrdersDao
{
    //Make Singletonn
    private static $instance;
    private $pdo;

    //Statements defined as constants
    const ADD_NEW_ORDER = "INSERT INTO orders (user_id, created_at, status) VALUES (?, ?, ?)";
    const ADD_ORDER_PRODUCT = "INSERT INTO order_products (order_id, product_id, quantity) VALUES (?, ?, ?)";
    const GET_ALL_ORDERS_ADMIN = "SELECT o.id, u.email AS email, o.created_at, o.status FROM orders o
                                LEFT JOIN users u ON o.user_id = u.id";
    const CHANGE_ORDER_STATUS = "UPDATE orders SET status = ? WHERE id = ?";

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

    function newOrder(Order $order, $cart)
    {
        $this->pdo->beginTransaction();

        try {
            //create new order and get id
            $statement = $this->pdo->prepare(self::ADD_NEW_ORDER);
            $statement->execute(array($order->getUserId(), $order->getCreatedAt(), $order->getStatus()));
            $orderId = $this->pdo->lastInsertId();

            //fill order with products and return the id, total price and quantity of the order as array
            $totalPrice = 0;
            $quantity = 0;
            foreach ($cart as $cartProduct) {
                $totalPrice += $cartProduct->getPrice() * $cartProduct->getQuantity();
                $quantity += $cartProduct->getQuantity();

                $statement = $this->pdo->prepare(self::ADD_ORDER_PRODUCT);
                $statement->execute(array($orderId, $cartProduct->getId(), $cartProduct->getQuantity()));
            }
            $result = [$orderId, $totalPrice, $quantity];
            $this->pdo->commit();

            return $result;

        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            return false;
        }
    }

    function getAllOrdersAdmin()
    {
        $statement = $this->pdo->prepare(self::GET_ALL_ORDERS_ADMIN);
        $statement->execute();

        $orders = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $orders;
    }

    function changeOrderStatus($orderId, $newStatus)
    {
        $statement = $this->pdo->prepare(self::CHANGE_ORDER_STATUS);
        $statement->execute(array($newStatus, $orderId));

        return true;
    }
}