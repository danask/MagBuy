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
    const BIGGEST_ACTIVE_BY_PRODUCT_ID = "SELECT percent, start_date, end_date FROM promotions 
                                          WHERE product_id = ? ORDER BY percent DESC LIMIT 1";

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
        $statement->execute(array(
                $promotion->getPercent(),
                $promotion->getStartDate(),
                $promotion->getEndDate(),
                $promotion->getProductId())
        );
        $promoId = $this->pdo->lastInsertId();

        return $promoId;
    }

    function getBiggestActivePromotionByProductId($productId)
    {
        $statement = $this->pdo->prepare(self::BIGGEST_ACTIVE_BY_PRODUCT_ID);
        $statement->execute(array($productId));
        $promotion = $statement->fetch();

        return $promotion;
    }

}