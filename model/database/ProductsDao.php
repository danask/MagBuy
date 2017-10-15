<?php


namespace model\database;

use model\database\Connect\Connection;
use \PDO;


class ProductsDao {

    //Make Singleton
    private static $instance;
    private $pdo;

    //Statements defined as constants
    const GET_ALL_AVAILABLE_PRODUCTS = "SELECT id, title, description, price FROM products";



    //Get connection in construct
    private function __construct() {
        $this->pdo = Connection::getInstance()->getConnection();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new ProductsDao();
        }

        return self::$instance;
    }



    //Function for checking if login is correct
    /**
     * @return array|bool - returns array with all the products
     */
    function getAllAvailableProducts() {

        $statement = $this->pdo->prepare(self::GET_ALL_AVAILABLE_PRODUCTS);
        $statement->execute();

        //Check if Database returned the products (1 or 0 Columns) because there might be no products
        if ($statement->rowCount()) {

            //Fetch all products and return them
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {

            return false;
        }
    }


}