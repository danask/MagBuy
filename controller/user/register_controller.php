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
    isset($_POST['password']) &&
    isset($_POST['password2']) &&
    isset($_POST['firstName']) &&
    isset($_POST['lastName']) &&
    isset($_POST['mobilePhone'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $mobilePhone = $_POST['mobilePhone'];

    if (filter_var($email, FILTER_VALIDATE_EMAIL) &&
        strlen($email) > 3 &&
        strlen($email) < 254 &&
        strlen($password) >= 4 &&
        strlen($password) < 20 &&
        strlen($password2) >= 4 &&
        strlen($password2) < 20 &&
        $password == $password2 &&
        strlen($firstName) >= 4 &&
        strlen($firstName) < 20 &&
        strlen($lastName) >= 4 &&
        strlen($lastName) < 20 &&
        ctype_digit($mobilePhone) &&
        strlen($mobilePhone) == 10) {

        //Create user's object
        $user = new \model\User();

        //Try to accomplish connection with the database
        try {
            $userDao = \model\database\UserDao::getInstance();

            $user->setEmail(htmlentities($email));
            $user->setPassword(sha1($password));
            $user->setFirstName(htmlentities($firstName));
            $user->setLastName(htmlentities($lastName));
            $user->setMobilePhone(htmlentities($mobilePhone));

            //Check if user exists
            if ($userDao->checkUserExist($user)) {

                //Locate to error Register Page
                header("Location: ../../view/user/register.php?error");
                ob_flush();
            } else {

                $id = $userDao->registerUser($user);
                $_SESSION['loggedUser'] = $id;

                header("Location: ../../view/main/index.php");
                ob_flush();
            }

        } catch (PDOException $e) {

            header("Location: ../../view/error/pdo_error.php");
            ob_flush();
        }

    } else {

        //Locate to error Register Page
        header("Location: ../../view/user/register.php?error");
        ob_flush();
    }
} else {

    //Locate to error Register Page
    header("Location: ../../view/user/register.php?error");
    ob_flush();
}


