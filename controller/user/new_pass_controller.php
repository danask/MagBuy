<?php

session_start();

if(!isset($_SESSION['passReset'])) {
    header('Location: ../../view/user/login.php');
}

if(abs(($_SESSION['passReset']['time'] - time())) > 600) {
    session_destroy();
    header('Location: ../../view/user/login.php');
    die();
}

//Check for Session
require_once "../../utility/no_session_main.php";

//Autoload to require needed model files
function __autoload($className) {
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

if (!empty($_POST['pass1']) && !empty($_POST['pass2'])) {

    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    if (!($pass1 == $pass2)) {
        header("Location: ../../view/user/newPass?errorPassMatch");
    }

    if (strlen($pass1) >= 4 && strlen($pass1) <= 20) {

        $user = new model\User;

        $userDao = model\database\UserDao::getInstance();

        $user->setPassword(sha1($pass1));
        $user->setEmail($_SESSION['passReset']['email']);

        $userDao->resetPassword($user);

        session_destroy();
        header("Location: ../../view/user/login.php");
        die();
    } else {
        header('Location: ../../view/user/newPass.php?errorPassSyntax');
        die();
    }
} else {
    header('Location: ../../view/user/newPass.php?errorPassSyntax');
}