<?php

//Check for Session
require_once "../../utility/no_session_main.php";

//Autoload to require needed model files
function __autoload($className) {
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}


//Get logged user's info
$user = new \model\User();

//Try to accomplish connection with the database
try {

    $userDao = \model\database\UserDao::getInstance();

    $user->setId($_SESSION['loggedUser']);

    //Receive array with user's info
    $userArr = $userDao->getUserInfo($user);


} catch (PDOException $e) {

    header("Location: ../../view/error/pdo_error.php");
}