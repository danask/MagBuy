<?php

//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

if (isset($_GET['scid'])) {
    //Try to accomplish connection with the database
    try {
        $superCatId = $_GET['scid'];
        $supercatDao = \model\database\SuperCategoriesDao::getInstance();
        $supercatDao->deleteSuperCategory($superCatId);

//        header("Location: ../../../view/admin/supercategories/supercategories_view.php");

    } catch (PDOException $e) {
        header("Location: ../../view/error/pdo_error.php");
        die();
    }
} else {
    // error
}