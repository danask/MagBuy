<?php


namespace model\database;

use model\database\Connect\Connection;
use model\SubcatSpecification;
use PDO;

class SubcatSpecificationsDao {

    //Make Singleton
    private static $instance;
    private $pdo;

    //Statements defined as constants
    const CREATE_SPEC = "INSERT INTO subcat_specifications (name, subcategory_id) VALUES (?, ?)";

    const GET_ALL_SPEC_FOR_SUBCAT = "SELECT * FROM subcat_specifications WHERE subcategory_id = ?";


    //Get connection in construct
    private function __construct() {

        $this->pdo = Connection::getInstance()->getConnection();
    }

    public static function getInstance() {

        if (self::$instance === null) {
            self::$instance = new SubcatSpecificationsDao();
        }

        return self::$instance;
    }



    /**
     * Function for creating specifications.
     * @param SubcatSpecification $specification - Receives specifications name and ID as object.
     * @return string - Returns specifications ID.
     */
    function createSpecification(SubcatSpecification $specification) {

        $statement = $this->pdo->prepare(self::CREATE_SPEC);
        $statement->execute(array(
            $specification->getName(),
            $specification->getSubcategoryId()));

        return $this->pdo->lastInsertId();
    }


    /**
     * Function for getting specifications for subcategory.
     * @param $subcatId - Receives subcategory ID.
     * @return array - Returns specifications as associative array.
     */
    function getAllSpecificationsForSubcategory($subcatId) {

        $statement = $this->pdo->prepare(self::GET_ALL_SPEC_FOR_SUBCAT);
        $statement->execute(array($subcatId));

        $specs = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $specs;
    }
}