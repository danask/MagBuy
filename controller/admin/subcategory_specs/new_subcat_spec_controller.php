<?php
//Include Error Handler
require_once '../../../utility/error_handler_dir_back.php';

//Include Admin/Mod check
require_once '../../../utility/admin_session.php';

//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

if (isset($_POST['submit'])) {
    $specification = new \model\SubcatSpecification();

    //Validation for input
    if (empty($_POST['name']) || strlen($_POST['name']) > 40 ){
        header('Location: ../../../view/error/error_400.php');
        die();
    }

    //Try to accomplish connection with the database
    try {

        $specDao = \model\database\SubcatSpecificationsDao::getInstance();

        $specification->setName(htmlentities($_POST['name']));
        $specification->setSubcategoryId(htmlentities($_POST['subcategory_id']));


        $id = $specDao->createSpecification($specification);

        header("Location: ../../../view/admin/subcategory_specs/subcat_specs_view.php");


    } catch (PDOException $e) {
        $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
        error_log($message, 3, '../../../errors.log');
        header("Location: ../../../view/error/error_500.php");
        die();
    }

} else {
    $subcatDao = \model\database\SubCategoriesDao::getInstance();
    $subcategories = $subcatDao->getAllSubCategoriesWithoutProducts();
}