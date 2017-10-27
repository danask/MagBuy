<?php

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
        header("Location: ../../../view/error/pdo_error.php");
        die();
    }
} else {
    // error
}