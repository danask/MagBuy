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

    const GET_REVIEWS_FOR_PRODUCT = "SELECT r.id, r.title, r.comment, r.rating, r.user_id, r.product_id, r.created_at, 
                                      u.image_url, u.first_name FROM reviews r JOIN users u ON u.id = r.user_id 
                                      WHERE product_id = ? ORDER BY r.created_at DESC";

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