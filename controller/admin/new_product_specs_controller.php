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
    $specificationIds = json_decode($_POST['spec_ids'], TRUE);

    for ($i = 0; $i < $_POST['specs_total']; $i++) {
        $specId = $specificationIds[$i];
        $value = $_POST[$specId];
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