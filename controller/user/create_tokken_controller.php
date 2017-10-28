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

//When email is reset
if (!empty($_POST['email'])) {

    $userEmail = $_POST['email'];

    //Check if user exists
    $user = new \model\User;

    try {

        $userDao = \model\database\UserDao::getInstance();
        $user->setEmail($userEmail);

        if (!($userDao->checkUserExist($user))) {

            header('Location: ../../view/user/forgotten.php?error');
            die();
        }


        $tokken = sha1($userEmail . microtime());

        require_once 'send_tokken_controller.php';

        $_SESSION['passReset']['email'] = $userEmail;
        $_SESSION['passReset']['tokken'] = $tokken;
        $_SESSION['passReset']['time'] = time();

        header("Location: ../../view/user/forgotten.php?tokken");
        die();

    } catch (PDOException $e) {
        $message = $_SERVER['SCRIPT_NAME'] . " $e\n";
        error_log($message, 3, 'errors.log');
        header("Location: ../../view/error/error_500.php");
        die();
    }
}

//When tokken is received
if (!empty($_POST['tokken'])) {

    $tokkenReceive = $_POST['tokken'];
    $tokken = $_SESSION['passReset']['tokken'];
    $email = $_SESSION['passReset']['email'];



    if($tokkenReceive == $tokken){

        header('Location: ../../view/user/newPass.php');
        die();
    } else {

        session_destroy();
        header ('Location: ../../view/user/forgotten.php?errorTokken');
        die();
    }

}