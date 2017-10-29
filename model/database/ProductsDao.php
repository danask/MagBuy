<?php


namespace model\database;

use model\database\Connect\Connection;
use model\Product;
use PDO;
use PDOException;


class ProductsDao
{

    //Make Singletonn
    private static $instance;
    private $pdo;

    //Statements defined as constants

    const GET_PRODUCT_BY_ID = "SELECT p.id, i.image_url, p.title, p.description, p.price, p.subcategory_id, pr.percent,
                                pr.start_date, pr.end_date, p.visible,
                               (SELECT AVG(rating) FROM reviews WHERE product_id = ?) average FROM products p 
                                INNER JOIN images i ON p.id = i.product_id 
                                LEFT JOIN promotions pr ON p.id = pr.product_id WHERE P.visible = 1 
                                GROUP BY p.id HAVING p.id = ?";

    const GET_PRODUCTS_BY_SUBCAT = "SELECT p.id, i.image_url, p.title, p.description, p.price, p.subcategory_id,  
                                    p.visible, pr.percent, pr.start_date, pr.end_date FROM products p INNER JOIN images i 
                                    ON p.id = i.product_id LEFT JOIN promotions pr ON p.id = pr.product_id GROUP 
                                    BY P.id HAVING p.subcategory_id = ? AND p.visible = 1 ORDER BY p.created_at DESC LIMIT 8";

    const GET_MOST_RATED_PRODUCTS = "SELECT P.id, P.title, I.image_url, P.price, pr.percent, pr.start_date, pr.end_date,
                                     (SELECT AVG(rating) 
                                     FROM reviews WHERE product_id = P.id) average FROM products P
                                     JOIN images I ON P.id = I.product_id JOIN reviews R ON P.id = R.product_id
                                     LEFT JOIN promotions pr ON P.id = pr.product_id
                                     WHERE P.visible = 1 GROUP BY P.id ORDER BY average DESC LIMIT 4";

    const GET_RELATED_PRODUCTS = "SELECT P.id, P.title, I.image_url, P.subcategory_id, P.price, pr.percent, pr.start_date,
                                  pr.end_date FROM products P LEFT JOIN promotions pr ON P.id = pr.product_id
                                  JOIN images I ON P.id = I.product_id WHERE P.visible = 1 AND NOT P.id = ?
                                  GROUP BY P.id HAVING P.subcategory_id = ? ORDER BY P.created_at DESC LIMIT 4";

    const GET_MOST_RECENT_PRODUCTS = "SELECT p.id, p.title, i.image_url, p.price, pr.percent, pr.start_date, pr.end_date 
                                      FROM products p 
                                      JOIN images i ON p.id = i.product_id LEFT JOIN promotions pr
                                      ON P.id = pr.product_id WHERE p.visible = 1 GROUP BY p.id 
                                      ORDER BY p.created_at DESC LIMIT 4";

    const GET_MOST_SOLD = "SELECT P.id, P.title, I.image_url, P.price, pr.percent, pr.start_date, pr.end_date,
                          (SELECT SUM(OP.quantity) FROM order_products OP JOIN orders O ON OP.order_id = O.id
                          WHERE O.status = 3 AND OP.product_id = P.id) ordered FROM products P JOIN
                          images I ON P.id = I.product_id LEFT JOIN promotions pr ON P.id = pr.product_id
                          WHERE P.visible = 1 GROUP BY P.id ORDER BY ordered DESC LIMIT 4";

    const SEARCH_PRODUCTS = "SELECT P.id, P.title, P.price, I.image_url FROM products P JOIN images I 
                              ON P.id = I.product_id WHERE P.visible = 1 GROUP BY P.id HAVING title LIKE ? LIMIT 3";
    const SEARCH_PRODUCTS_NO_LIMIT = "SELECT P.id, P.title, P.price, I.image_url FROM products P JOIN images I 
                              ON P.id = I.product_id WHERE P.visible = 1 GROUP BY P.id HAVING title LIKE ?";

    const GET_ALL_PRODUCTS_ADMIN = "SELECT p.id, p.title, p.description, p.price, p.quantity, p.visible, 
                                    p.created_at, sc.name AS subcat_name FROM products p LEFT JOIN subcategories sc
                                    ON p.subcategory_id = sc.id";

    const TOGGLE_VISIBILITY = "UPDATE products SET visible = ? WHERE id = ?";

    const CREATE_PRODUCT_INFO = "INSERT INTO products(title, description, price, quantity, visible, created_at,
                                  subcategory_id) VALUES (?, ?, ?, ?, ?, ?, ?)";

    const CREATE_PRODUCT_IMAGES = "INSERT INTO images (image_url, product_id) VALUES (?, ?)";

    const CREATE_PRODUCT_SPECS = "INSERT INTO subcat_specification_value (value, subcat_spec_id, product_id)
                                            VALUES (?, ?, ?)";

    const GET_SUBCAT_PRODUCTS_NEWEST = "SELECT p.id, i.image_url, p.title, p.description, p.price, p.subcategory_id,  
                                    p.visible, pr.percent, pr.start_date, pr.end_date FROM products p INNER JOIN images i 
                                    ON p.id = i.product_id LEFT JOIN promotions pr ON p.id = pr.product_id GROUP 
                                    BY P.id HAVING p.subcategory_id = :sub AND p.visible = 1 ORDER BY p.created_at DESC 
                                    LIMIT 8 OFFSET :off";

    const GET_SUBCAT_PRODUCTS_MOST_SOLD = "SELECT p.id, i.image_url, p.title, p.description, p.price, p.subcategory_id,  
                                    p.visible, pr.percent, pr.start_date, pr.end_date, (SELECT SUM(op.quantity)
                                    FROM order_products op JOIN orders o ON op.order_id = o.id
                                    WHERE o.status = 3 AND op.product_id = p.id) ordered FROM products p INNER JOIN images i 
                                    ON p.id = i.product_id LEFT JOIN promotions pr ON p.id = pr.product_id GROUP 
                                    BY P.id HAVING p.subcategory_id = :sub AND p.visible = 1 ORDER BY ordered DESC 
                                    LIMIT 8 OFFSET :off";

    const GET_SUBCAT_PRODUCTS_MOST_REVIEWED = "SELECT p.id, i.image_url, p.title, p.description, p.price, p.subcategory_id,  
                                    p.visible, pr.percent, pr.start_date, pr.end_date, (SELECT COUNT(product_id) 
                                     FROM reviews WHERE product_id = P.id) average FROM products p INNER JOIN images i 
                                    ON p.id = i.product_id LEFT JOIN promotions pr ON p.id = pr.product_id GROUP 
                                    BY P.id HAVING p.subcategory_id = :sub AND p.visible = 1 ORDER BY average DESC 
                                    LIMIT 8 OFFSET :off";

    const GET_SUBCAT_PRODUCTS_HIGHEST_RATED = "SELECT p.id, i.image_url, p.title, p.description, p.price, p.subcategory_id,  
                                    p.visible, pr.percent, pr.start_date, pr.end_date, (SELECT AVG(rating) 
                                     FROM reviews WHERE product_id = P.id) average FROM products p INNER JOIN images i 
                                    ON p.id = i.product_id LEFT JOIN promotions pr ON p.id = pr.product_id GROUP 
                                    BY P.id HAVING p.subcategory_id = :sub AND p.visible = 1 ORDER BY average DESC 
                                    LIMIT 8 OFFSET :off";

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


    /**
     * Function for creating new product.
     * @param Product $product
     * @param $images
     * @param $specs
     * @return string - Returns added product's ID.
     */
    function createNewProduct(Product $product, $images, $specs)
    {
        $this->pdo->beginTransaction();
        try {
            //product info
            $title = $product->getTitle();
            $description = $product->getDescription();
            $price = $product->getPrice();
            $quantity = $product->getQuantity();
            $visible = $product->getVisible();
            $createdAt = $product->getCreatedAt();
            $subcatId = $product->getSubcategoryId();
            $statement = $this->pdo->prepare(self::CREATE_PRODUCT_INFO);
            $statement->execute(array($title, $description, $price, $quantity, $visible, $createdAt, $subcatId));
            $productId = $this->pdo->lastInsertId();

            //product images
            foreach ($images as $image) {
                $statement = $this->pdo->prepare(self::CREATE_PRODUCT_IMAGES);
                $statement->execute(array($image, $productId));
            }

            //product specs
            foreach ($specs as $spec) {
                $value = $spec->getValue();
                $specId = $spec->getSubcatSpecId();;

                $statement = $this->pdo->prepare(self::CREATE_PRODUCT_SPECS);
                $statement->execute(array($value, $specId, $productId));
            }

            $this->pdo->commit();

            return $productId;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            return false;
        }
    }


    /**
     * Function for getting product by ID.
     * @param $productId - Receives product's ID.
     * @return mixed - Returns product as associative array.
     */
    function getProductByID($productId)
    {
        $statement = $this->pdo->prepare(self::GET_PRODUCT_BY_ID);
        $statement->execute(array($productId, $productId));
        $product = $statement->fetch(PDO::FETCH_ASSOC);

        return $product;
    }


    function getProductsBySubcategory($subcatId)
    {
        $statement = $this->pdo->prepare(self::GET_PRODUCTS_BY_SUBCAT);
        $statement->execute(array($subcatId));
        $products = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }

    function getSubCatProducts($subcatId, $offset, $filter)
    {
        switch ($filter) {
            case 1:
                $statement = $this->pdo->prepare(self::GET_SUBCAT_PRODUCTS_NEWEST);
                break;
            case 2:
                $statement = $this->pdo->prepare(self::GET_SUBCAT_PRODUCTS_MOST_SOLD);
                break;
            case 3:
                $statement = $this->pdo->prepare(self::GET_SUBCAT_PRODUCTS_MOST_REVIEWED);
                break;
            case 4:
                $statement = $this->pdo->prepare(self::GET_SUBCAT_PRODUCTS_HIGHEST_RATED);
                break;
        }

        $statement->bindValue(':sub', (int)$subcatId, PDO::PARAM_INT);
        $statement->bindValue(':off', (int)$offset, PDO::PARAM_INT);

        $statement->execute();
        $products = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }

    function getProductPrice($productId)
    {
        $statement = $this->pdo->prepare(self::GET_PRODUCT_BY_ID);
        $statement->execute(array($productId));
        $product = $statement->fetch();

        return $product['price'];
    }

    //Function for getting top 3 rated products for main page
    function getTopRated()
    {

        $statement = $this->pdo->prepare(self::GET_MOST_RATED_PRODUCTS);
        $statement->execute(array());
        $products = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }

    //Function for getting related products
    function getRelated($subCat, $product)
    {

        $statement = $this->pdo->prepare(self::GET_RELATED_PRODUCTS);
        $statement->execute(array($product, $subCat));
        $products = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }

    //Function for getting most recent products
    function getMostRecent()
    {

        $statement = $this->pdo->prepare(self::GET_MOST_RECENT_PRODUCTS);
        $statement->execute(array());
        $products = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }


    //Function for searching products
    function searchProduct($needle)
    {

        $statement = $this->pdo->prepare(self::SEARCH_PRODUCTS);
        $statement->execute(array("%$needle%"));

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    //Function for searching products without limit
    function searchProductNoLimit($needle)
    {

        $statement = $this->pdo->prepare(self::SEARCH_PRODUCTS_NO_LIMIT);
        $statement->execute(array("%$needle%"));

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    //Function for getting most sold
    function mostSoldProducts()
    {

        $statement = $this->pdo->prepare(self::GET_MOST_SOLD);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    function getAllProductsAdmin()
    {
        $statement = $this->pdo->prepare(self::GET_ALL_PRODUCTS_ADMIN);
        $statement->execute();

        $products = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }

    function toggleVisibility($productId, $toggleTo)
    {
        $statement = $this->pdo->prepare(self::TOGGLE_VISIBILITY);
        $statement->execute(array($toggleTo, $productId));

        return true;
    }
}