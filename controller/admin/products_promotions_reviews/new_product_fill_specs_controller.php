<?php

//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}


if (isset($_GET['scid'])) {
    $subCatId = $_GET['scid'];
    $specsDao = \model\database\SubcatSpecificationsDao::getInstance();
    $specs = $specsDao->getAllSpecificationsForSubcategory($subCatId);

    header('Content-Type: application/json');
    echo json_encode($specs);
}