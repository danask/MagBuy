<?php

//Autoload to require needed model files
if (!function_exists("__autoload")) {
    function __autoload($className)
    {
        $className = '..\\..\\' . $className;
        require_once str_replace("\\", "/", $className) . '.php';
    }
}

try {
    $supercatDao = \model\database\SuperCategoriesDao::getInstance();
    $catDao = \model\database\CategoriesDao::getInstance();
    $subcatDao = \model\database\SubCategoriesDao::getInstance();

    $supercategories = $supercatDao->getAllSuperCategories();
    $categories = $catDao->getAllCategories();
    $subcategories = $subcatDao->getAllSubCategories();
} catch (PDOException $e) {

    header("Location: ../../view/error/pdo_error.php");
}