<?php

// Start Session
session_start();

// Check if user have session (if user is logged)
if (isset($_SESSION['loggedUser'])) {

    //Redirect to Main
    header('Location: ../../view/main/index.php');
}