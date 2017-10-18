<?php

namespace model\database;

use model\database\Connect\Connection;
use model\Favourites;
use PDO;


class FavouritesDao {

    //Make Singleton
    private static $instance;
    private $pdo;

    //Statements defined as constants
    const ADD_PRODUCT_TO_FAVOURITES = "INSERT INTO favourites (user_id, product_id) VALUES (?, ?)";
    const REMOVE_PRODUCT_FROM_FAVOURITES = "DELETE FROM favourites WHERE user_id = ? AND product_id = ?";
    const CHECK_IF_IN_FAVOURITES = "SELECT id FROM favourites WHERE user_id = ? AND product_id = ?";
    const ALL_FAVOURITES_BY_USER_ID = "SELECT P.id, P.title, P.description, P.price, I.image_url, F.user_id, P.visible FROM products P 
                                      JOIN favourites F ON P.id = F.product_id JOIN images I ON P.id = I.product_id 
                                      GROUP BY F.id HAVING F.user_id = ? AND P.visible = 1";


    //Get connection in construct
    private function __construct() {
        $this->pdo = Connection::getInstance()->getConnection();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new FavouritesDao();
        }
        return self::$instance;
    }



    //Function for adding product to user's favourites
    /**
     * @param Favourites $favourite
     */
    function addFavourite(Favourites $favourite) {

        $statement = $this->pdo->prepare(self::ADD_PRODUCT_TO_FAVOURITES);
        $statement->execute(array($favourite->getUserId(), $favourite->getProductId()));

    }



    //Function for removing from favourites
    /**
     * @param Favourites $favourite
     */
    function removeFavourite(Favourites $favourite) {

        $statement = $this->pdo->prepare(self::REMOVE_PRODUCT_FROM_FAVOURITES);
        $statement->execute(array($favourite->getUserId(), $favourite->getProductId()));

    }


    //Function for checking if product is in favourites

    /**
     * @param Favourites $favourite - user ID and product ID
     * @return int - 1 - product is in favourites, 2 - product is not in favourites
     */
    function checkFavourites(Favourites $favourite) {

        $statement = $this->pdo->prepare(self::CHECK_IF_IN_FAVOURITES);
        $statement->execute(array($favourite->getUserId(), $favourite->getProductId()));

        if ($statement->rowCount()) {

            //1 if product is in favourites (using numbers, because we have 3)
            return 1;
        } else {

            //2 if product is not in favourites (using numbers, because we have 3)
            return 2;
        }
    }

    //Function for getting all products for user from favourites
    function getAllFavourites (Favourites $favourites) {

        $statement = $this->pdo->prepare(self::ALL_FAVOURITES_BY_USER_ID);
        $statement->execute(array($favourites->getUserId()));

        $favouritesUser = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $favouritesUser;
    }
}