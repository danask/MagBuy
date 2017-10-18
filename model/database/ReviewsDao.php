<?php


namespace model\database;

use model\database\Connect\Connection;
use model\Reviews;


class ReviewsDao
{

    //Make Singletonn
    private static $instance;
    private $pdo;

    //Statements defined as constants
    const ADD_REVIEW = "INSERT INTO reviews (title, comment, rating, user_id, product_id, created_at) 
                        VALUES (?, ?, ?, ?, ?, ?)";



    //Get connection in construct
    private function __construct()
    {
        $this->pdo = Connection::getInstance()->getConnection();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new ReviewsDao();
        }

        return self::$instance;
    }


    //Function for adding review
    function addNewReview(Reviews $reviews) {

        $statement = $this->pdo->prepare(self::ADD_REVIEW);
        $statement->execute(array(
                        $reviews->getTitle(),
                        $reviews->getComment(),
                        $reviews->getRating(),
                        $reviews->getUserId(),
                        $reviews->getProductId(),
                        $reviews->getCreatedAt()));

        return $this->pdo->lastInsertId();
    }

}