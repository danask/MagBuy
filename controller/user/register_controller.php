<?php
//Include Error Handler
require_once '../../utility/error_handler.php';
//Check if user is logged
require_once '../../utility/session_main.php';

//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}


//Validation
if (!empty($_POST['email']) &&
    !empty($_POST['password']) &&
    !empty($_POST['password2']) &&
    !empty($_POST['firstName']) &&
    !empty($_POST['lastName']) &&
    !empty($_POST['mobilePhone'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $mobilePhone = $_POST['mobilePhone'];

    if (!(filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($email) > 3 && strlen($email) < 254)) {

        //Locate to error Register Page
        header("Location: ../../view/error/error_400.php");
        die();
    }

    if (!(ctype_digit($mobilePhone) && strlen($mobilePhone) == 10)) {

        //Locate to error page Wrong Mobile Number
        header("Location: ../../view/user/register.php?errorMN");
        die();
    }

    if (!(strlen($password) >= 4 && strlen($password) < 20 && strlen($password2) >= 4 && strlen($password2) < 20)) {
        //Locate to error page Wrong Password length
        header("Location: ../../view/user/register.php?errorPassSyntax");
        die();
    }

    if (!($password == $password2)) {
        //Locate to error page Wrong Password match
        header("Location: ../../view/user/register.php?errorPassMatch");
        die();
    }

    if (!(strlen($firstName) >= 4 && strlen($firstName) < 20)) {
        //Locate to error page Wrong First Name length
        header("Location: ../../view/user/register.php?errorFN");
        die();
    }

    if (!(strlen($lastName) >= 4 && strlen($lastName) < 20)) {
        //Locate to error page Wrong Last Name length
        header("Location: ../../view/user/register.php?errorLN");
        die();
    }


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

        //Check if it's first user and make it admin (role = 3)
        if($userDao->checkIfUserFirst()) {
            $user->setRole(3);
        }

        //Check if user exists
        if ($userDao->checkUserExist($user)) {

            //Locate to error Register Page
            header("Location: ../../view/user/register.php?errorEmail");
            die();
        } else {

            $id = $userDao->registerUser($user);
            $_SESSION['loggedUser'] = $id;

            header("Location: ../../view/main/index.php");
            die();
        }

    } catch (PDOException $e) {
        $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
        error_log($message, 3, '../../errors.log');
        header("Location: ../../view/error/error_500.php");
        die();
    }

} else {

    //Locate to error Register Page
    header("Location: ../../view/error/error_400.php");
    die();
}


