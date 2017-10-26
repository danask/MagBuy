<?php

//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

if (isset($_POST['submit'])) {
    $subcategory = new \model\SubCategory();

    //Try to accomplish connection with the database
    try {

        $subcatDao = \model\database\SubCategoriesDao::getInstance();

        $subcategory->setName(htmlentities($_POST['name']));
        $subcategory->setCategoryId(htmlentities($_POST['category_id']));


        $id = $subcatDao->createSubCategory($subcategory);

        header("Location: ../../../view/main/index.php");


    } catch (PDOException $e) {

        header("Location: ../../../view/error/pdo_error.php");
    }

} else {
    try {
        $catDao = \model\database\CategoriesDao::getInstance();
        $categories = $catDao->getAllCategories();
    } catch (PDOException $e) {

        header("Location: ../../../view/error/pdo_error.php");
    }
}