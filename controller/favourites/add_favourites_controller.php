<?php

//Check for Session
require_once "../../utility/no_session_main.php";

//Autoload to require needed model files
function __autoload($className) {
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

if (isset($_SESSION['loggedUser']) && isset($_GET['product_id'])) {

    $userId = $_SESSION['loggedUser'];
    $productId = $_GET['product_id'];

    $favourites = new \model\Favourites();

    try {

        $favouritesDao = \model\database\FavouritesDao::getInstance();

        $favourites->setUserId($userId);
        $favourites->setProductId($productId);

        $favouritesDao->addFavourite($favourites);



    } catch (PDOException $e) {

        header("Location: ../../view/error/error_500.php");
    }

}