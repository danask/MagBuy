<?php


namespace model\database;

use model\database\Connect\Connection;
use model\ProductSpecification;

class ProductSpecificationsDao
{
    //Make Singletonn
    private static $instance;
    private $pdo;

    //Statements defined as constants
    const FILL_SPEC = "INSERT INTO subcat_specification_value (value, subcat_spec_id, product_id) VALUES (?, ?, ?)";
    const GET_SPECS_FOR_PRODUCT = "SELECT v.value, s.name FROM subcat_specification_value v
INNER JOIN subcat_specifications s ON v.subcat_spec_id = s.id WHERE v.product_id = ?";

    //Get connection in construct
    private function __construct()
    {
        $this->pdo = Connection::getInstance()->getConnection();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new ProductSpecificationsDao();
        }

        return self::$instance;
    }

    function fillSpecification(ProductSpecification $specification)
    {
        $statement = $this->pdo->prepare(self::FILL_SPEC);
        $statement->execute(array($specification->getValue(), $specification->getSubcatSpecId(), $specification->getProductId()));

        return true;
    }

    function getAllSpecificationsForProduct($productId)
    {
        $statement = $this->pdo->prepare(self::GET_SPECS_FOR_PRODUCT);
        $statement->execute(array($productId));

        $specifications = $statement->fetchAll();

        return $specifications;
    }
}