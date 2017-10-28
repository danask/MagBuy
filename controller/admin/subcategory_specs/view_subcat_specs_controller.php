<?php

session_start();
//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

try {
    $subcatSpecDao = \model\database\SubcatSpecificationsDao::getInstance();
    $specs = $subcatSpecDao->getAllSubcategorySpecificationsAdmin();
} catch (PDOException $e) {
    header("Location: ../../../view/error/error_500.php");
    die();
}