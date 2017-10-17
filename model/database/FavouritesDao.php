<?php

namespace model\database;

use model\database\Connect\Connection;
use model\Favourites;


class FavouritesDao {

    //Make Singleton
    private static $instance;
    private $pdo;

    //Statements defined as constants
    const ADD_PRODUCT_TO_FAVOURITES = "INSERT INTO favourites (user_id, product_id) VALUES (?, ?)";
    const REMOVE_PRODUCT_FROM_FAVOURITES = "DELETE FROM favourites WHERE user_id = ? AND product_id = ?";
    const CHECK_IF_IN_FAVOURITES = "SELECT id FROM favourites WHERE user_id = ? AND product_id = ?";


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

}