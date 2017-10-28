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
        header("Location: ../../../view/error/pdo_error.php");
        die();
    }
} else {
    // error
}