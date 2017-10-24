<?php


namespace model\database;

use model\database\Connect\Connection;
use model\Promotion;

class PromotionsDao
{
    //Make Singletonn
    private static $instance;
    private $pdo;

    //Statements defined as constants
    const CREATE_PROMOTION = "INSERT INTO promotions (percent, start_date, end_date, product_id) VALUES (?, ?, ?, ?)";

    //Get connection in construct
    private function __construct()
    {

        $this->pdo = Connection::getInstance()->getConnection();
    }

    public static function getInstance()
    {

        if (self::$instance === null) {
            self::$instance = new PromotionsDao();
        }

        return self::$instance;
    }

    function createPromotion(Promotion $promotion)
    {
        $statement = $this->pdo->prepare(self::CREATE_PROMOTION);
        $statement->execute(
            $promotion->getPercent(),
            $promotion->getStartDate(),
            $promotion->getEndDate(),
            $promotion->getProductId()
        );
        $promoId = $this->pdo->lastInsertId();

        return $promoId;
    }

}