<?php

// Start Session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user have session (if user is logged)

if (!isset($_SESSION['role'])) {

    //Redirect to Error
    header("Location: ../../../view/error/error_400.php");
    die();
}

if (isset($_SESSION['role']) && $_SESSION['role'] != 3 && $_SESSION['role'] != 2) {

    //Redirect to Error
    header("Location: ../../../view/error/error_400.php");
    die();
}