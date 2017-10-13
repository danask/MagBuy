<?php

// Start Session
session_start();

// Check if user have session (if user is logged)
if (isset($_SESSION['loggedUser'])) {

    //Redirect to Main
    header('Location: view/main.php');

} else {

    //Redirect to Login screen
    header('Location: view/login.php');
}