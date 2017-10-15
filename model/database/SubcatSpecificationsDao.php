<?php


namespace model\database;

use model\database\Connect\Connection;
use model\SubcatSpecification;

class SubcatSpecificationsDao
{
    //Make Singletonn
    private static $instance;
    private $pdo;

    //Statements defined as constants
    const CREATE_SPEC = "INSERT INTO subcat_specifications (name, subcategory_id) VALUES (?, ?)";

    //Get connection in construct
    private function __construct()
    {
        $this->pdo = Connection::getInstance()->getConnection();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new SubcatSpecificationsDao();
        }

        return self::$instance;
    }

    function createSpecification(SubcatSpecification $specification)
    {
        $statement = $this->pdo->prepare(self::CREATE_SPEC);
        $statement->execute(array($specification->getName(), $specification->getSubcategoryId()));

        return $this->pdo->lastInsertId();
    }
}