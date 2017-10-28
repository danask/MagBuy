<?php
//Include Error Handler
require_once '../../../utility/error_handler.php';

//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

if (isset($_GET['cid'])) {
    //Try to accomplish connection with the database
    try {
        $catId = $_GET['cid'];
        $catDao = \model\database\CategoriesDao::getInstance();
        $catDao->deleteCategory($catId);

        header("Location: ../../../view/admin/categories/categories_view.php");
        die();

    } catch (PDOException $e) {
        $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
        error_log($message, 3, 'errors.log');
        header("Location: ../../../view/error/error_500.php");
        die();
    }
} else {
    header("Location: ../../../view/error/error_400.php");
    die();
}