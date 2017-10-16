<?php

//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

$supercatDao = \model\database\SuperCategoriesDao::getInstance();
$catDao = \model\database\CategoriesDao::getInstance();
$subcatDao = \model\database\SubCategoriesDao::getInstance();

$supercategories = $supercatDao->getAllSuperCategories();
$categories = $catDao->getAllCategories();
$subcategories = $subcatDao->getAllSubCategories();