<?php

//TESTING

function __autoload($className) {
    $className = '..\\' . $className;
    $className = str_replace("\\", "/", $className);
    require_once $className . '.php';
}

$user = new \model\User();
$userDao = \model\database\UserDao::getInstance();

$user->setEmail("lachezar");
$user->setEnabled("1");
$user->setFirstName("Lachezar");
$user->setLastName("Gadzhev");
$user->setMobilePhone("02130123");
$user->setImageUrl("sdadasd");
$user->setPassword("parola");
$user->setRole("1");


try {
    $result = $userDao->registerUser($user);
    var_dump($result);

} catch (PDOException $e){
    return false;
}