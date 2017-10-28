<?php
//Include Error Handler
require_once '../../../utility/error_handler_dir_back.php';

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
        $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
        error_log($message, 3, 'errors.log');
        header("Location: ../../../view/error/error_500.php");
        die();
    }

} else {
    try {
        $catDao = \model\database\CategoriesDao::getInstance();
        $categories = $catDao->getAllCategories();
    } catch (PDOException $e) {
        $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
        error_log($message, 3, 'errors.log');
        header("Location: ../../../view/error/error_500.php");
        die();
    }
}