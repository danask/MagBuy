<?php

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

        header("Location: ../../view/error/pdo_error.php");
    }

} else {

    //When isFavourite is 3, it means user is not logged (using numbers, because we have 1 and 2)
    $isFavourite = 3;
}