<?php
//Include Error Handler
require_once '../../utility/error_handler.php';
//Check for Session
require_once "../../utility/no_session_main.php";

//Autoload to require needed model files
function __autoload($className) {
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}


//Get user's object
$user = new \model\User();

//Try to accomplish connection with the database
try {
    $userDao = \model\database\UserDao::getInstance();

    $user->setId($_SESSION['loggedUser']);

    //Receive array with user's info
    $userArr = $userDao->getUserInfo($user);


} catch (PDOException $e) {
    $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
    error_log($message, 3, '../../errors.log');
    header("Location: ../../view/error/error_500.php");
    die();
}