<?php

session_start();
//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

try {
    $subcatDao = \model\database\SubCategoriesDao::getInstance();
    $subCats = $subcatDao->getAllSubCategoriesAdmin();
} catch (PDOException $e) {
    header("Location: ../../view/error/pdo_error.php");
    die();
}