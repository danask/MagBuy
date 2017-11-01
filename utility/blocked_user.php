<?php

// Start Session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'autoloader.php';

if(isset($_SESSION['loggedUser']) ) {


    try {

        $userDao = \model\database\UserDao::getInstance();

        if (!$userDao->checkEnabled($_SESSION['loggedUser'])){
            $_SESSION['enabled'] = 0;
        }

    } catch (PDOException $e) {
        $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
        error_log($message, 3, '../errors.log');
        header("Location: ../view/error/error_500.php");
        die();
    }


    // Check if user have session (if user is logged)
    if (isset($_SESSION['enabled']) && $_SESSION['enabled'] == 0) {

        session_destroy();

        //Redirect to Main
        header('Location: ../../view/user/login.php?blocked');
        die();
    }

}