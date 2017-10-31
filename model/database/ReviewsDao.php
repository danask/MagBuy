<?php


namespace model\database;

use model\database\Connect\Connection;
use model\Reviews;
use PDO;


class ReviewsDao
{

    //Make Singletonn
    private static $instance;
    private $pdo;

    //Statements defined as constants
    const ADD_REVIEW = "INSERT INTO reviews (title, comment, rating, user_id, product_id, created_at) 
                        VALUES (?, ?, ?, ?, ?, ?)";

    const GET_REVIEWS_FOR_PRODUCT = "SELECT R.id, R.title, R.comment, R.rating, R.user_id, R.product_id, R.created_at, 
                                      U.image_url, U.first_name FROM reviews R JOIN users U ON U.id = R.user_id 
                                      WHERE product_id = ? ORDER BY R.created_at DESC";

    const REMOVE_REVIEW = "DELETE FROM reviews WHERE id = ?";


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


    /**
     * Function for adding review.
     * @param Reviews $reviews - Receives review information, products and user's ID as object.
     * @return string - Returns review's ID.
     */
    function addNewReview(Reviews $reviews)
    {

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


    /**
     * Function for getting all reviews for product.
     * @param $productId - Receives product's ID.
     * @return array - Returns reviews for product.
     */
    function getReviewsForProduct($productId)
    {

        $statement = $this->pdo->prepare(self::GET_REVIEWS_FOR_PRODUCT);
        $statement->execute(array($productId));

        $reviewsReceived = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $reviewsReceived;
    }


    /**
     * Function for deleting reviews.
     * @param $productId - Receives product's ID.
     */
    function removeReview($productId)
    {

        $statement = $this->pdo->prepare(self::REMOVE_REVIEW);
        $statement->execute(array($productId));
    }
}