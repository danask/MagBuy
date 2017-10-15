<?php

//Check for Session
require_once "../../utility/session_main.php";


//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\' . $className;
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

        header("Location: ../../view/main/main.php");


    } catch (PDOException $e) {

        header("Location: ../../view/error/pdo_error.php");
    }

} else {

    //Locate to error page
}