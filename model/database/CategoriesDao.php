<?php


namespace model\database;

use model\Category;
use model\database\Connect\Connection;
use PDO;

class CategoriesDao
{
    //Make Singleton
    private static $instance;
    private $pdo;

    //Statements defined as constants
    const CREATE_CAT = "INSERT INTO categories (name, supercategory_id) VALUES (?, ?)";

    const GET_ALL_CATS = "SELECT * FROM categories";



    //Get connection in construct
    private function __construct() {
        $this->pdo = Connection::getInstance()->getConnection();
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new CategoriesDao();
        }

        return self::$instance;
    }



    /**
     * Function for creating category.
     * @param Category $category - Receives new category name and it's super category ID.
     * @return string - Returns the new category's ID.
     */
    function createCategory(Category $category)
    {
        $statement = $this->pdo->prepare(self::CREATE_CAT);
        $statement->execute(array(
            $category->getName(),
            $category->getSupercategoryId()));

        return $this->pdo->lastInsertId();
    }



    /**
     * Function for getting categories.
     * @return array - Returns all categories as associative array.
     */
    function getAllCategories()
    {
        $statement = $this->pdo->prepare(self::GET_ALL_CATS);
        $statement->execute();
        $categories = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $categories;
    }
}