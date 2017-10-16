<?php

//Check for Session
//require_once "../../utility/session_main.php";


//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

if (isset($_POST['submit'])) {
    $productId = $_POST['product_id'];
    $specsDao = \model\database\SubcatSpecificationsDao::getInstance();
    $productSpecs = $specsDao->getAllSpecificationsForSubcategory($_POST['subcat_id']);

    foreach ($productSpecs as $specification) {
        $specId = $specification['id'];
        $value = $_POST['spec-' . $specId];
        $specification = new \model\ProductSpecification($value, $specId, $productId);

        try {

            $productSpecsDao = \model\database\ProductSpecificationsDao::getInstance();

            $id = $productSpecsDao->fillSpecification($specification);

            header("Location: ../../view/main/main.php");

        } catch (PDOException $e) {

//            header("Location: ../../view/error/pdo_error.php");
        }
    }

} elseif (isset($_POST['final_submit'])) {


} else {
    //Locate to error page
}