<?php

//TESTING

function __autoload($className) {
    $className = '..\\..\\' . $className;
    $className = str_replace("\\", "/", $className);
    require_once $className . '.php';
}

$user = new \model\User();
$userDao = \model\database\UserDao::getInstance();

$user->setId(6);
$user->setEmail("pesho");
$user->setEnabled("1");
$user->setFirstName("kusdsdr");
$user->setLastName("kusdsdr");
$user->setMobilePhone("02130123");
$user->setImageUrl("sdadasd");
$user->setPassword("parola");
$user->setRole("1");


try {
    $result = $userDao->getUserInfo($user);
    var_dump($result);

} catch (PDOException $e){
    return false;
}