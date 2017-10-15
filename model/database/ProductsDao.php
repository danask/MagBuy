<?php


namespace model\database;

use model\database\Connect\Connection;
use PDO;


class ProductsDao
{

    //Make Singleton
    private static $instance;
    private $pdo;

    //Statements defined as constants
    const GET_ALL_AVAILABLE_PRODUCTS = "SELECT id, title, description, price FROM products ORDER BY created_at DESC";
    const GET_PRODUCT_BY_ID = "SELECT * FROM products WHERE id = ?";
    const GET_PRODUCT_IMAGES = "SELECT image_url FROM product_images WHERE product_id = ?";
    const GET_MOST_SOLD = "SELECT * FROM products ORDER BY times_sold DESC";
    const GET_MOST_REVIEWED = "SELECT * FROM products ORDER BY times_reviewed DESC";


    //Get connection in construct
    private function __construct()
    {
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
    function getAllAvailableProducts()
    {

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

    function getProductByID($productId)
    {
        $statement = $this->pdo->prepare(self::GET_PRODUCT_BY_ID);
        $statement->execute($productId);
        $product = $statement->fetch();

        return $product;
    }

    function getProductImages($productId)
    {
        $statement = $this->pdo->prepare(self::GET_PRODUCT_IMAGES);
        $statement->execute($productId);
        $productImages = $statement->fetchAll();

        return $productImages;
    }

    function getProductsFilteredByPrice($priceFilter)
    {
        if ($priceFilter === "mostExpensive") {
            $filter = "DESC";
        } elseif ($priceFilter === "leastExpensive") {
            $filter = "ASC";
        }
        $statement = $this->pdo->prepare("SELECT * FROM products ORDER BY price $filter");
        $statement->execute();
        $products = $statement->fetchAll();

        return $products;
    }

    function getMostSoldProducts()
    {
        $statement = $this->pdo->prepare(self::GET_MOST_SOLD);
        $statement->execute();
        $products = $statement->fetchAll();

        return $products;
    }

    function getMostReviewedProducts()
    {
        $statement = $this->pdo->prepare(self::GET_MOST_REVIEWED);
        $statement->execute();
        $products = $statement->fetchAll();

        return $products;
    }


}