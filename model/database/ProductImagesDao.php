<?php


namespace model\database;

use model\database\Connect\Connection;
use model\ProductImage;

class ProductImagesDao
{
    //Make Singleton
    private static $instance;
    private $pdo;

    //Statements defined as constants
    const ADD_PRODUCT_IMAGE = "INSERT INTO images (image_url, product_id) VALUES (?, ?)";
    const GET_PRODUCT_IMAGES = "SELECT image_url FROM images WHERE product_id = ?";

    //Get connection in construct
    private function __construct()
    {
        $this->pdo = Connection::getInstance()->getConnection();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new ProductImagesDao();
        }

        return self::$instance;
    }


    //Function for adding image path to database for products

    /**
     * @param ProductImage $image
     * @return bool
     */
    function addProductImage(ProductImage $image)
    {
        $statement = $this->pdo->prepare(self::ADD_PRODUCT_IMAGE);
        $statement->execute(array($image->getImageUrl(), $image->getProductId()));

        return true;
    }

    function getAllProductImages($productId)
    {
        $statement = $this->pdo->prepare(self::GET_PRODUCT_IMAGES);
        $statement->execute(array($productId));
        $images = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $images;
    }
}