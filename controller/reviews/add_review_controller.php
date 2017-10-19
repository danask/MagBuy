<?php

//Check for Session
require_once "../../utility/no_session_main.php";

//Autoload to require needed model files
function __autoload($className) {
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}


$review = new \model\Reviews();

$review->setRating($_POST['rating']);
$review->setTitle($_POST['title']);
$review->setComment($_POST['review']);
$review->setUserId($_SESSION['loggedUser']);
$review->setProductId($_GET['pid']);

$reviewDao = \model\database\ReviewsDao::getInstance();

$reviewDao->addNewReview($review);

header("Location: ../../view/main/single.php?pid=" . $_GET['pid']);
