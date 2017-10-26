<?php

session_start();
//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

try {
    $superCatDao = \model\database\SuperCategoriesDao::getInstance();
    $superCats = $superCatDao->getAllSuperCategories();
} catch (PDOException $e) {
    header("Location: ../../view/error/pdo_error.php");
    die();
}