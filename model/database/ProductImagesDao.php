<?php


namespace model\database;

use model\database\Connect\Connection;
use model\ProductImage;
use PDO;

class ProductImagesDao {

    //Make Singleton
    private static $instance;
    private $pdo;

    //Statements defined as constants
    const ADD_PRODUCT_IMAGE = "INSERT INTO images (image_url, product_id) VALUES (?, ?)";

    const GET_PRODUCT_IMAGES = "SELECT image_url FROM images WHERE product_id = ?";

    const GET_FIRST_IMAGE = "SELECT image_url FROM images WHERE product_id = ? LIMIT 1";




    //Get connection in construct
    private function __construct() {
        $this->pdo = Connection::getInstance()->getConnection();
    }

    public static function getInstance() {

        if (self::$instance === null) {
            self::$instance = new ProductImagesDao();
        }

        return self::$instance;
    }




    /**
     * Function for adding product's image path to database.
     * @param ProductImage $image - Receives product's image path and product's ID.
     */
    function addProductImage(ProductImage $image) {

        $statement = $this->pdo->prepare(self::ADD_PRODUCT_IMAGE);
        $statement->execute(array(
            $image->getImageUrl(),
            $image->getProductId()));
    }



    /**
     * Function for getting all images for product.
     * @param $productId - Receives product's ID.
     * @return array - Returns product's images in associative array.
     */
    function getAllProductImages($productId) {

        $statement = $this->pdo->prepare(self::GET_PRODUCT_IMAGES);
        $statement->execute(array($productId));
        $images = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $images;
    }


    /**
     * Function for getting first product's image.
     * @param $productId - Receives product's ID.
     * @return mixed - Returns images path.
     */
    function getFirstProductImage($productId) {

        $statement = $this->pdo->prepare(self::GET_FIRST_IMAGE);
        $statement->execute(array($productId));
        $image = $statement->fetch();

        return $image['image_url'];
    }
}