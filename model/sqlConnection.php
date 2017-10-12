<?php

//Constants for Database Connection
define('DB_IP', "127.0.0.1");
define('DB_PORT', "3306");
define('DB_USER', "root");
define('DB_PASS', "");
define('DB_NAME', "MagBuy");

//Define PDO variable to access it outside of functions(like rollback in catch)
$pdo = null;

//Function to create connection between server and Database (Called in Query functions below)

/**
 * @return PDO - adjust it to a variable to have PDO connection
 */

function getConnection()
{
    try {
        $pdo = new PDO("mysql:host=" . DB_IP . ":" . DB_PORT . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {

        //HAVE TO ADD ERROR PAGE
        return false;
    }
}