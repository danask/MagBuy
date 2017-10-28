<?php
//Include Error Handler
require_once '../../utility/error_handler.php';
//Check for session
require_once '../../utility/session_main.php';

if(!isset($_SESSION['passReset'])) {
    header('Location: ../../view/user/login.php');
    die();
}

if(abs(($_SESSION['passReset']['time'] - time())) > 600) {
    session_destroy();
    header('Location: ../../view/user/login.php');
    die();
}

//Autoload to require needed model files
function __autoload($className) {
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

if (!empty($_POST['pass1']) && !empty($_POST['pass2'])) {

    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    if (!($pass1 == $pass2)) {
        header("Location: ../../view/user/newPass.php?errorPassMatch");
        die();
    }

    if (strlen($pass1) >= 4 && strlen($pass1) <= 20) {

        $user = new model\User;

        try {
            $userDao = model\database\UserDao::getInstance();

            $user->setPassword(sha1($pass1));
            $user->setEmail($_SESSION['passReset']['email']);

            $userDao->resetPassword($user);

            session_destroy();
            header("Location: ../../view/user/login.php");
            die();

        } catch (PDOException $e) {
            $message = $_SERVER['SCRIPT_NAME'] . " $e\n";
            error_log($message, 3, 'errors.log');
            header("Location: ../../view/error/error_500.php");
            die();
        }
    } else {
        header('Location: ../../view/user/newPass.php?errorPassSyntax');
        die();
    }
} else {
    header('Location: ../../view/user/newPass.php?errorPassSyntax');
}