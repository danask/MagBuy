<?php

function __autoload($className) {
    $className = '..\\' . $className;
    $className = str_replace("\\", "/", $className);
    require_once $className . '.php';
}

$user = new \model\User();
$userDao = \model\database\UserDao::getInstance();

$user->setEmail("lachezar");


try {
    $result = $userDao->checkUserExists($user);
    var_dump($result);

} catch (PDOException $e){
    return false;
}