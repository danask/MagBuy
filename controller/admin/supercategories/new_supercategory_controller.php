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


        $id = $supercatDao->createSuperCategory($supercategory);

        header("Location: ../../../view/admin/supercategories/supercategories_view.php");


    } catch (PDOException $e) {
        header("Location: ../../../view/error/error_500.php");
        die();
    }

} else {

    //Locate to error page
}