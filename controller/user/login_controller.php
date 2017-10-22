<?php

//Check if user is logged
require_once '../../utility/session_main.php';

//Autoload to require needed model files
function __autoload($className) {

    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}


//Validation
if (isset($_POST['email']) &&
    isset($_POST['password'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (strlen($email) > 3 &&
        strlen($email) < 254 &&
        strlen($password) >= 4 &&
        strlen($password) <= 12) {


        //Get user's object
        $user = new \model\User();

        //Try to accomplish connection with the database
        try {
            $userDao = \model\database\UserDao::getInstance();

            $user->setEmail(htmlentities($email));
            $user->setPassword(sha1($password));

            $result = $userDao->checkLogin($user);

            if ($result) {

                $_SESSION['loggedUser'] = $result;
                $userDao->setLastLogin($user);

                header("Location: ../../view/main/index.php");
                ob_flush();
            } else {

                header("Location: ../../view/user/login.php?error");
                ob_flush();
            }


        } catch (PDOException $e) {

            header("Location: ../../view/error/pdo_error.php");
            ob_flush();
        }
    } else {

        //Locate to error Login Page
        header("Location: ../../view/user/login.php?error");
        ob_flush();
    }
} else {

    //Locate to error Login Page
    header("Location: ../../view/user/login.php?error");
    ob_flush();
}