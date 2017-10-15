<?php


namespace model\database;

use model\database\Connect\Connection;
use model\SuperCategory;

class SuperCategoriesDao
{
    //Make Singletonn
    private static $instance;
    private $pdo;

    //Statements defined as constants
    const CREATE_SUPERCAT = "INSERT INTO supercategories (name) VALUES (?)";

    //Get connection in construct
    private function __construct()
    {
        $this->pdo = Connection::getInstance()->getConnection();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new SuperCategoriesDao();
        }

        return self::$instance;
    }

    function createSuperCategory(SuperCategory $superCategory)
    {
        $statement = $this->pdo->prepare(self::CREATE_SUPERCAT);
        $statement->execute(array($superCategory->getName()));

        return $this->pdo->lastInsertId();
    }
}