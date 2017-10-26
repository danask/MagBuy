<?php


namespace model\database;

use model\database\Connect\Connection;
use model\SuperCategory;
use PDO;

class SuperCategoriesDao
{

    //Make Singletonn
    private static $instance;
    private $pdo;

    //Statements defined as constants
    const CREATE_SUPERCAT = "INSERT INTO supercategories (name) VALUES (?)";

    const GET_ALL_SUPERCATS = "SELECT * FROM supercategories";

    const GET_SUPERCAT_BY_ID = "SELECT * FROM supercategories WHERE id = ?";

    const EDIT_SUPERCAT = "UPDATE supercategories SET name = ? WHERE id = ?";

    const DELETE_SUPERCAT = "DELETE FROM supercategories WHERE id = ?";


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


    /**
     * Function for creating super category.
     * @param SuperCategory $superCategory - Receives super category's name as object.
     * @return string - Returns super category's ID.
     */
    function createSuperCategory(SuperCategory $superCategory)
    {
        $statement = $this->pdo->prepare(self::CREATE_SUPERCAT);
        $statement->execute(array(
            $superCategory->getName()));

        return $this->pdo->lastInsertId();
    }


    /**
     * Function for getting all super categories.
     * @return array - Returns super categories as associative array.
     */
    function getAllSuperCategories()
    {
        $statement = $this->pdo->prepare(self::GET_ALL_SUPERCATS);
        $statement->execute();
        $supercategories = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $supercategories;
    }

    function getSuperCategoryById($superCatId)
    {
        $statement = $this->pdo->prepare(self::GET_SUPERCAT_BY_ID);
        $statement->execute(array($superCatId));
        $supercategory = $statement->fetch();

        return $supercategory;
    }

    function editSuperCategory(SuperCategory $superCat)
    {
        $statement = $this->pdo->prepare(self::EDIT_SUPERCAT);
        $statement->execute(array($superCat->getName(), $superCat->getId()));

        return true;
    }

    function deleteSuperCategory($superCatId)
    {
        $statement = $this->pdo->prepare(self::DELETE_SUPERCAT);
        $statement->execute(array($superCatId));

        return true;
    }
}