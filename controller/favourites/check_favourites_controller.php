<?php
//Include Error Handler
require_once '../../utility/error_handler.php';

session_start();

if(isset($_SESSION['loggedUser'])) {

//Autoload is declared in single_product_controller

    $favourites = new \model\Favourites();

//Try to accomplish connection with the database
    try {

        $favouritesDao = \model\database\FavouritesDao::getInstance();

        $favourites->setUserId($_SESSION['loggedUser']);
        $favourites->setProductId($product['id']);

        $isFavourite = $favouritesDao->checkFavourites($favourites);


} catch (PDOException $e) {
        $message = $_SERVER['SCRIPT_NAME'] . " $e\n";
        error_log($message, 3, 'errors.log');
        header("Location: ../../view/error/error_500.php");
        die();
    }

} else {

    //When isFavourite is 3, it means user is not logged (using numbers, because we have 1 and 2)
    $isFavourite = 3;
}