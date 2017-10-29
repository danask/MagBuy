<?php
//Include Error Handler
require_once '../../utility/error_handler.php';

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

try {
    $productsDao = \model\database\ProductsDao::getInstance();
    $products = $productsDao->getFilteredProductsWithSubCategory($filters, $subcatId);
} catch (PDOException $e) {
    $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
    error_log($message, 3, '../../errors.log');
    header("Location: ../../view/error/error_500.php");
    die();
}

header('Content-Type: application/json');
echo json_encode($products);
