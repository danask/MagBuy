<?php


namespace model\database;

use model\database\Connect\Connection;
use model\SubCategory;

class SubCategoriesDao
{
    //Make Singletonn
    private static $instance;
    private $pdo;

    //Statements defined as constants
    const CREATE_SUBCAT = "INSERT INTO subcategories (name, category_id) VALUES (?, ?)";
    const GET_ALL_SUBCATS = "SELECT * FROM subcategories";

    //Get connection in construct
    private function __construct()
    {
        $this->pdo = Connection::getInstance()->getConnection();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new SubCategoriesDao();
        }

        return self::$instance;
    }

    function createSubCategory(SubCategory $subCategory)
    {
        $statement = $this->pdo->prepare(self::CREATE_SUBCAT);
        $statement->execute(array($subCategory->getName(), $subCategory->getCategoryId()));

        return $this->pdo->lastInsertId();
    }

    function getAllSubCategories()
    {
        $statement = $this->pdo->prepare(self::GET_ALL_SUBCATS);
        $statement->execute();
        $subcategories = $statement->fetchAll();

        return $subcategories;
    }
}