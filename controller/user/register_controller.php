<?php

//Check for Session
require_once "../../utility/session_main.php";


//Autoload to require needed model files
function __autoload($className) {
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}


//Register Validation
if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['firstName']) && isset($_POST['lastName'])
    && isset($_POST['mobilePhone']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
    && strlen($_POST['email']) > 3 && strlen($_POST['email']) < 254 && strlen($_POST['password']) >= 4
    && strlen($_POST['password']) < 20 && strlen($_POST['firstName']) >= 4 && strlen($_POST['firstName']) < 20
    && strlen($_POST['lastName']) >= 4 && strlen($_POST['lastName']) < 20 && ctype_digit($_POST['mobilePhone'])
    && strlen($_POST['mobilePhone']) == 10) {

    $user = new \model\User();

    //Try to accomplish connection with the database
    try {

        $userDao = \model\database\UserDao::getInstance();

        $user->setEmail(htmlentities($_POST['email']));
        $user->setEnabled(1);
        $user->setPassword(sha1($_POST['password']));
        $user->setFirstName(htmlentities($_POST['firstName']));
        $user->setLastName(htmlentities($_POST['lastName']));
        $user->setImageUrl("../../web/uploads/default.jpg");
        $user->setMobilePhone((int)htmlentities($_POST['mobilePhone']));
        $user->setRole(1);

        //Check if user exists
        if($userDao->checkUserExist($user)) {

            //Locate to error Register Page
            header("Location: ../../view/user/register.php?error");
        } else {

            $id = $userDao->registerUser($user);
            $_SESSION['loggedUser'] = $id;
            header("Location: ../../view/main/main.php");
        }



    } catch (PDOException $e) {

        header("Location: ../../view/error/pdo_error.php");
    }

} else {

    //Locate to error Register Page
    header("Location: ../../view/user/register.php?error");
}


