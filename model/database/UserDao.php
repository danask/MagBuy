<?php

namespace model\database;

use model\database\Connect\Connection;
use model\User;


class UserDao {

    //Make Singleton
    private static $instance;
    private $pdo;

    //Statements defined as constants
    const CHECK_USER_EXISTS = "SELECT id, email FROM users WHERE email = ?";
    const CHECK_PASS = "SELECT id, password FROM users WHERE id = ? AND password = ?";
    const REGISTER_USER = "INSERT INTO users (email, enabled, first_name, last_name, mobile_phone,
                           image_url,password, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";


    //Get connection in construct
    private function __construct() {
        $this->pdo = Connection::getInstance()->getConnection();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new UserDao();
        }
        return self::$instance;
    }



    //Function for checking if user exists
    function checkUserExists(User $user) {

        $statement = $this->pdo->prepare(self::CHECK_USER_EXISTS);
        $statement->execute(array($user->getEmail()));

        //Check if Database returned a user (1 or 0 Columns)
        if ($statement->rowCount()) {

            //Fetch User ID and return it as result
            $userId = $statement->fetch();
            return (int)$userId['id'];
        } else {
            return false;

        }
    }



    //Function for password check
    function checkPassword(User $user) {

        $statement = $this->pdo->prepare(self::CHECK_PASS);
        $statement->execute(array($user->getId(), $user->getPassword()));

        //Check if Database returned a user (1 or 0 Columns)
        if ($statement->rowCount()) {

            //Fetch User ID and return it as result
            $userId = $statement->fetch();
            return (int)$userId['id'];
        } else {
            return false;

        }
    }



    //Function for registering user
    function registerUser (User $user) {

        $statement = $this->pdo->prepare(self::REGISTER_USER);
        $statement->execute(array($user->getEmail(), $user->getEnabled(), $user->getFirstName(), $user->getLastName(),
            $user->getMobilePhone(), $user->getImageUrl(), $user->getPassword(), $user->getRole()));

        //Return registered user's ID
        return $this->pdo->lastInsertId();
    }
}