<?php

//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

if (isset($_POST['submit'])) {
    $category = new \model\Category();

    //Try to accomplish connection with the database
    try {

        $catDao = \model\database\CategoriesDao::getInstance();

        $category->setName(htmlentities($_POST['name']));
        $category->setSupercategoryId(htmlentities($_POST['supercategory_id']));
        $category->setId($_POST['cat_id']);


        $catDao->editCategory($category);

        header("Location: ../../../view/admin/categories/categories_view.php");


    } catch (PDOException $e) {
        header("Location: ../../view/error/pdo_error.php");
        die();
    }

} else {
    try {
        $catId = $_GET['cid'];
        $supercatDao = \model\database\SuperCategoriesDao::getInstance();
        $catDao = \model\database\CategoriesDao::getInstance();
        $supercategories = $supercatDao->getAllSuperCategories();
        $cat = $catDao->getCategoryById($catId);
    } catch (PDOException $e) {

        header("Location: ../../view/error/pdo_error.php");
    }
}