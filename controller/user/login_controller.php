<?php

//Check for Session
require_once "../../utility/session_main.php";

//Autoload to require needed model files
function __autoload($className) {
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}


//Login Validation
if (isset($_POST['email']) && isset($_POST['password'])
    && strlen($_POST['email']) > 3 && strlen($_POST['email']) < 254
    && strlen($_POST['password']) >= 4 && strlen($_POST['password']) <= 12) {

    $user = new \model\User();

    //Try to accomplish connection with the database
    try {

        $userDao = \model\database\UserDao::getInstance();

        $user->setEmail(htmlentities($_POST['email']));
        $user->setPassword($_POST['password']);

        $result = $userDao->checkLogin($user);

        if ($result) {

            $_SESSION['loggedUser'] = $result;
            header("Location: ../../view/main/main.php");
        } else {

            header("Location: ../../view/user/login.php?error");
        }


    } catch (PDOException $e) {

        header("Location: ../../view/error/pdo_error.php");
    }
} else {

    //Locate to error Login Page
    header("Location: ../../view/user/login.php?error");
}