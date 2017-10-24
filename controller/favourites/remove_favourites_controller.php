<?php

//Check for Session
require_once "../../utility/no_session_main.php";

//Autoload to require needed model files
function __autoload($className) {
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

if (isset($_SESSION['loggedUser']) && isset($_GET['product_id_remove'])) {

    $userId = $_SESSION['loggedUser'];
    $productId = $_GET['product_id_remove'];

    $favourites = new \model\Favourites();

    try {

        $favouritesDao = \model\database\FavouritesDao::getInstance();

        $favourites->setUserId($userId);
        $favourites->setProductId($productId);

        $favouritesDao->removeFavourite($favourites);
        $products = $favouritesDao->getAllFavourites($favourites);

        if(count($products) == 0) {
            echo true;
        } else {
            echo false;
        }


    } catch (PDOException $e) {

        header("Location: ../../view/error/pdo_error.php");
    }

}