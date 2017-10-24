<?php

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

    header("Location: ../../view/error/pdo_error.php");
}