<?php

//Check if user is logged
require_once '../../utility/session_main.php';


//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

if(!empty($_POST['email'])) {

    $userEmail = $_POST['email'];

    $tokken = sha1($userEmail . microtime());

    require_once 'send_tokken_controller.php';

    $_SESSION['passReset']['email'] = $userEmail;
    $_SESSION['passReset']['tokken'] = $tokken;

    header("Location: ../../view/user/forgotten.php?tokken");
    die();
}

if (!empty($_POST['tokken'])) {

    $tokkenReceive = $_POST['tokken'];
    $tokken = $_SESSION['passReset']['tokken'];
    $email = $_SESSION['passReset']['email'];



    if($tokkenReceive == $tokken){

        header('Location: ../../view/user/newPass.php');
        die();
    } else {

        header ('Location: ../../view/user/forgotten.php?errorTokken');
    }

}