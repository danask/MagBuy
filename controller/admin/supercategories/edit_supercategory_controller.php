<?php

//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

if (isset($_POST['submit'])) {
    $supercategory = new \model\SuperCategory();

    //Try to accomplish connection with the database
    try {

        $supercatDao = \model\database\SuperCategoriesDao::getInstance();

        $supercategory->setName(htmlentities($_POST['name']));
        $supercategory->setId($_POST['supercat_id']);


        $supercatDao->editSuperCategory($supercategory);

        header("Location: ../../../view/admin/supercategories/supercategories_view.php");


    } catch (PDOException $e) {
        header("Location: ../../../view/error/pdo_error.php");
        die();
    }
} else {
    try {
        $superCatId = $_GET['scid'];
        $supercatDao = \model\database\SuperCategoriesDao::getInstance();
        $superCat = $supercatDao->getSuperCategoryById($superCatId);
    } catch (PDOException $e) {
        header("Location: ../../../view/error/pdo_error.php");
        die();
    }
}