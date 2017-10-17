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
    function addFavourite(Favourites $favourite) {

        $statement = $this->pdo->prepare(self::ADD_PRODUCT_TO_FAVOURITES);
        $statement->execute(array($favourite->getUserId(), $favourite->getProductId()));

    }


}