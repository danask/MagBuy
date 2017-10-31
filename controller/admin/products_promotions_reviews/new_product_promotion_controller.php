<?php
//Include Error Handler
require_once '../../../utility/error_handler_dir_back.php';

//Include Admin/Mod check
require_once '../../../utility/admin_mod_session.php';

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
        $favDao = \model\database\FavouritesDao::getInstance();
        $productsDao = \model\database\ProductsDao::getInstance();

        $id = $promoDao->createPromotion($promotion);

        $productInfo = $productsDao->getProductByID($productId);
        $subscribedUsers = $favDao->subscribedUsersForProduct($productId);


        //Send mails

        $msgBody = "Dear customer, there will be promotion for " . $productInfo['title'] . " with " . $percent .
            " discount, starting from  " . $startDate . " to " . $endDate . ". Thank you for visiting our site!";

        foreach ($subscribedUsers as $userEmail) {
            $userEmail = $userEmail['email'];

            require_once 'send_promotion_controller.php';
        }

        header("Location: ../../../view/admin/products_promotions_reviews/promotions_product_view.php?pid=" . $productId);




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