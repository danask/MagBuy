<?php


namespace model\database;

use model\Category;
use model\database\Connect\Connection;

class CategoriesDao
{
    //Make Singletonn
    private static $instance;
    private $pdo;

    //Statements defined as constants
    const CREATE_CAT = "INSERT INTO categories (name, supercategory_id) VALUES (?, ?)";

    //Get connection in construct
    private function __construct()
    {
        $this->pdo = Connection::getInstance()->getConnection();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new CategoriesDao();
        }

        return self::$instance;
    }

    function createCategory(Category $category)
    {
        $statement = $this->pdo->prepare(self::CREATE_CAT);
        $statement->execute(array($category->getName(), $category->getSupercategoryId()));

        return $this->pdo->lastInsertId();
    }
}