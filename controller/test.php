<?php

function __autoload($className) {
    $className = '..\\' . $className;
    $className = str_replace("\\", "/", $className);
    require_once $className . '.php';
}

$var =  \model\database\UserDao::getInstance();

var_dump($var->checkUserExists("lachezar"));