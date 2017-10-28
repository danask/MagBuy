<?php
//Include Error Handler
require_once '../../utility/error_handler.php';

//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

$products = null;

//Try to accomplish connection with the database
try {
    $subcatId = $_GET['subcid'];


    $productsDao = \model\database\ProductsDao::getInstance();
    $subCat = \model\database\SubCategoriesDao::getInstance();

    $products = $productsDao->getProductsBySubcategory($subcatId);
    $categoryName = $subCat->getSubCategoryName($subcatId);


} catch (PDOException $e) {
    $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
    error_log($message, 3, 'errors.log');
    header("Location: ../../view/error/error_500.php");
    die();
}