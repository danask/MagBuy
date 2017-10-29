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
    $percent = $_POST['percent'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $productId = $_POST['product_id'];
    $promotion = new \model\Promotion($percent, $startDate, $endDate, $productId);

    //Try to accomplish connection with the database
    try {

        $promoDao = \model\database\PromotionsDao::getInstance();

        $id = $promoDao->createPromotion($promotion);

        header("Location: ../../../view/main/single.php?pid=" . $productId);


    } catch (PDOException $e) {
        $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
        error_log($message, 3, '../../../errors.log');
        header("Location: ../../../view/error/error_500.php");
        die();
    }
} else {
    header("Location: ../../../view/error/error_400.php");
    die();
}