<?php

//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}


$mostSold = $_GET['msf'];
$mostReviewed = $_GET['mrf'];
$newest = $_GET['newf'];
$highestRated = $_GET['hrf'];
$subcatId = $_GET['scid'];
$filters = array('msf' => $mostSold, 'mrf' => $mostReviewed, 'newf' => $newest, 'hrf' => $highestRated);

$productsDao = \model\database\ProductsDao::getInstance();
$products = $productsDao->getFilteredProductsWithSubCategory($filters, $subcatId);

header('Content-Type: application/json');
echo json_encode($products);
