<?php
//Include Error Handler
require_once '../../../utility/error_handler_dir_back.php';

//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

if (isset($_GET['pid'])) {
    //Try to accomplish connection with the database
    try {
        $productId = $_GET['pid'];
        $currentVis = $_GET['vis'];
        if ($currentVis == 1) {
            $toggleTo = 0;
        } else {
            $toggleTo = 1;
        }
        $productDao = \model\database\ProductsDao::getInstance();
        $productDao->toggleVisibility($productId, $toggleTo);

        header("Location: ../../../view/admin/products_promotions_reviews/products_view.php");

    } catch (PDOException $e) {
        $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
        error_log($message, 3, '../../../errors.log');
        header("Location: ../../../view/error/error_500.php");
        die();
    }
} else {
    header("Location: ../../../view/error/error_400.php");
    die();
}