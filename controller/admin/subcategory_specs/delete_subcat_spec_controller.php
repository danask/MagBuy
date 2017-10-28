<?php

//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

if (isset($_GET['ssid'])) {
    //Try to accomplish connection with the database
    try {
        $specId = $_GET['ssid'];
        $specDao = \model\database\SubcatSpecificationsDao::getInstance();
        $specDao->deleteSubcatSpec($specId);

        header("Location: ../../../view/admin/subcategory_specs/subcat_spec_view.php");

    } catch (PDOException $e) {
        $message = $_SERVER['SCRIPT_NAME'] . " $e\n";
        error_log($message, 3, 'errors.log');
        header("Location: ../../../view/error/error_500.php");
        die();
    }
} else {
    header("Location: ../../../view/error/error_400.php");
    die();
}