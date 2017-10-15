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
    const GET_ALL_SPEC_FOR_SUBCAT = "SELECT * FROM subcat_specifications WHERE subcategory_id = ?";

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

    function getAllSpecificationsForSubcategory($subcatId)
    {
        $statement = $this->pdo->prepare(self::GET_ALL_SPEC_FOR_SUBCAT);
        $statement->execute(array($subcatId));
        $specs = $statement->fetchAll();

        return $specs;
    }
}