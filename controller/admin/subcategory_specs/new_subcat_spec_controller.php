<?php

//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

if (isset($_POST['submit'])) {
    $specification = new \model\SubcatSpecification();

    //Try to accomplish connection with the database
    try {

        $specDao = \model\database\SubcatSpecificationsDao::getInstance();

        $specification->setName(htmlentities($_POST['name']));
        $specification->setSubcategoryId(htmlentities($_POST['subcategory_id']));


        $id = $specDao->createSpecification($specification);

        header("Location: ../../../view/admin/subcategory_specs/subcat_specs_view.php");


    } catch (PDOException $e) {

        header("Location: ../../../view/error/error_500.php");
    }

} else {
    $subcatDao = \model\database\SubCategoriesDao::getInstance();
    $subcategories = $subcatDao->getAllSubCategories();
}