<?php


namespace model\database;

use model\database\Connect\Connection;
use model\Product;
use PDO;


class ProductsDao
{

    //Make Singletonn
    private static $instance;
    private $pdo;

    //Statements defined as constants
    const CREATE_PRODUCT = "INSERT INTO products(title, description, price, quantity, visible, created_at,
                            subcategory_id) VALUES (?, ?, ?, ?, ?, ?, ?)";

    const GET_PRODUCT_BY_ID = "SELECT p.id, i.image_url, p.title, p.description, p.price, p.subcategory_id, pr.percent,
                                pr.start_date, pr.end_date, p.visible,
                               (SELECT AVG(rating) FROM reviews WHERE product_id = ?) average FROM products p 
                                INNER JOIN images i ON p.id = i.product_id 
                                LEFT JOIN promotions pr ON p.id = pr.product_id WHERE P.visible = 1 
                                GROUP BY p.id HAVING p.id = ?";

    const GET_MOST_REVIEWED = "SELECT * FROM products WHERE P.visible = 1 ORDER BY times_reviewed DESC";

    const GET_PRODUCTS_BY_SUBCAT = "SELECT p.id, i.image_url, p.title, p.description, p.price, p.subcategory_id,  
                                    p.visible, pr.percent, pr.start_date, pr.end_date FROM products p INNER JOIN images i 
                                    ON p.id = i.product_id LEFT JOIN promotions pr ON p.id = pr.product_id GROUP 
                                    BY P.id HAVING p.subcategory_id = ? AND p.visible = 1 ORDER BY p.created_at DESC";

    const GET_MOST_RATED_PRODUCTS = "SELECT P.id, P.title, I.image_url, P.price, pr.percent, pr.start_date, pr.end_date,
                                     (SELECT AVG(rating) 
                                     FROM reviews WHERE product_id = P.id) average FROM products P
                                     JOIN images I ON P.id = I.product_id JOIN reviews R ON P.id = R.product_id
                                     LEFT JOIN promotions pr ON P.id = pr.product_id
                                     WHERE P.visible = 1 GROUP BY P.id ORDER BY average DESC LIMIT 3";

    const GET_RELATED_PRODUCTS = "SELECT P.id, P.title, I.image_url, P.subcategory_id, P.price, pr.percent, pr.start_date,
                                  pr.end_date FROM products P LEFT JOIN promotions pr ON P.id = pr.product_id
                                  JOIN images I ON P.id = I.product_id WHERE P.visible = 1 AND NOT P.id = ?
                                  GROUP BY P.id HAVING P.subcategory_id = ? ORDER BY P.created_at DESC LIMIT 3";

    const GET_MOST_RECENT_PRODUCTS = "SELECT p.id, p.title, i.image_url, p.price, pr.percent, pr.start_date, pr.end_date 
                                      FROM products p 
                                      JOIN images i ON p.id = i.product_id LEFT JOIN promotions pr
                                      ON P.id = pr.product_id WHERE p.visible = 1 GROUP BY p.id 
                                      ORDER BY p.created_at DESC LIMIT 3";

    const GET_MOST_SOLD = "SELECT P.id, P.title, I.image_url, P.price, pr.percent, pr.start_date, pr.end_date,
                           (SELECT count(product_id) 
                           FROM order_products WHERE product_id = P.id) ordered FROM products P
                           JOIN images I ON P.id = I.product_id JOIN reviews R ON P.id = R.product_id
                           LEFT JOIN promotions pr ON P.id = pr.product_id WHERE P.visible = 1 GROUP BY P.id 
                           ORDER BY ordered DESC LIMIT 3";

    const SEARCH_PRODUCTS = "SELECT P.id, P.title, P.price, I.image_url FROM products P JOIN images I 
                              ON P.id = I.product_id WHERE P.visible = 1 GROUP BY P.id HAVING title LIKE ? LIMIT 3";
    const SEARCH_PRODUCTS_NO_LIMIT = "SELECT P.id, P.title, P.price, I.image_url FROM products P JOIN images I 
                              ON P.id = I.product_id WHERE P.visible = 1 GROUP BY P.id HAVING title LIKE ?";

    const GET_ALL_PRODUCTS_ADMIN = "SELECT p.id, p.title, p.description, p.price, p.quantity, p.visible, 
                                    p.created_at, sc.name AS subcat_name FROM products p LEFT JOIN subcategories sc
                                    ON p.subcategory_id = sc.id";

    const TOGGLE_VISIBILITY = "UPDATE products SET visible = ? WHERE id = ?";

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
     * @param Product $product - Receives new product's information object.
     * @return string - Returns added product's ID.
     */
    function createNewProduct(Product $product)
    {
        $statement = $this->pdo->prepare(self::CREATE_PRODUCT);
        $statement->execute(array(
            $product->getTitle(),
            $product->getDescription(),
            $product->getPrice(),
            $product->getQuantity(),
            $product->getVisible(),
            $product->getCreatedAt(),
            $product->getSubcategoryId()));

        return $this->pdo->lastInsertId();
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

    function getMostReviewedProducts()
    {
        $statement = $this->pdo->prepare(self::GET_MOST_REVIEWED);
        $statement->execute();
        $products = $statement->fetchAll();

        return $products;
    }

    function getProductsBySubcategory($subcatId)
    {
        $statement = $this->pdo->prepare(self::GET_PRODUCTS_BY_SUBCAT);
        $statement->execute(array($subcatId));
        $products = $statement->fetchAll();

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