<?php

session_start();
//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

if (isset($_SESSION['loggedUser'])) {

    $products = null;
    $favourites = new \model\Favourites();

    $favourites->setUserId($_SESSION['loggedUser']);

//Try to accomplish connection with the database
    try {

        $favouritesDao = \model\database\FavouritesDao::getInstance();


        $products = $favouritesDao->getAllFavourites($favourites);

    } catch (PDOException $e) {

        header("Location: ../../view/error/pdo_error.php");
    }

} else {

    header('Location: index.php');
}