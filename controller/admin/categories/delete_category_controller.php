<?php

//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

if (isset($_GET['cid'])) {
    //Try to accomplish connection with the database
    try {
        $catId = $_GET['cid'];
        $catDao = \model\database\CategoriesDao::getInstance();
        $catDao->deleteCategory($catId);

        header("Location: ../../../view/admin/categories/categories_view.php");

    } catch (PDOException $e) {
        header("Location: ../../../view/error/pdo_error.php");
        die();
    }
} else {
    // error
}