<?php
//Include Error Handler
require_once '../../../utility/error_handler.php';

//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}


if (isset($_GET['scid'])) {
    $subCatId = $_GET['scid'];

    try {
        $specsDao = \model\database\SubcatSpecificationsDao::getInstance();
        $specs = $specsDao->getAllSpecificationsForSubcategory($subCatId);
    } catch (PDOException $e) {
        $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
        error_log($message, 3, 'errors.log');
        header("Location: ../../../view/error/error_500.php");
        die();
    }

    header('Content-Type: application/json');
    echo json_encode($specs);
} else {
    header("Location: ../../../view/error/error_400.php");
    die();
}