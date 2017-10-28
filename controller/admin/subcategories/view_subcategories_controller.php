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
    $message = $_SERVER['SCRIPT_NAME'] . " $e\n";
    error_log($message, 3, 'errors.log');
    header("Location: ../../../view/error/error_500.php");
    die();
}