<?php

namespace model\database;

use model\database\Connect\Connection;
use model\User;
use \PDO;


class UserDao {

    //Make Singleton
    private static $instance;
    private $pdo;

    //Statements defined as constants
    const CHECK_LOGIN = "SELECT id, email, password FROM users WHERE email = ? AND password = ?";
    const CHECK_USER_EXIST = "SELECT id FROM users WHERE email = ?";
    const REGISTER_USER = "INSERT INTO users (email, enabled, first_name, last_name, mobile_phone,
                           image_url, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    const EDIT_USER = "UPDATE users SET email = ?, enabled = ?, first_name = ?, last_name = ?, mobile_phone = ?,
                           image_url = ?, password = ?, role = ? WHERE id = ?";
    const GET_USER_INFO = "SELECT id, email, enabled, first_name, last_name, mobile_phone,
                           image_url, password, last_login, role FROM users WHERE id = ?";


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



    //Function for checking if login is correct
    function checkLogin(User $user) {

        $statement = $this->pdo->prepare(self::CHECK_LOGIN);
        $statement->execute(array($user->getEmail(), $user->getPassword()));

        //Check if Database returned a user (1 or 0 Columns)
        if ($statement->rowCount()) {

            //Fetch User ID and return it as result
            $userId = $statement->fetch();
            return (int)$userId['id'];
        } else {
            return false;

        }
    }



    //Function for checking if user exists
    function checkUserExist(User $user) {

        $statement = $this->pdo->prepare(self::CHECK_USER_EXIST);
        $statement->execute(array($user->getEmail()));

        //Check if Database returned a user (1 or 0 Columns)
        if ($statement->rowCount()) {

            //User exists, return true
            return true;
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


    //Function for editing users
    function editUser (User $user) {

        $statement = $this->pdo->prepare(self::EDIT_USER);
        $statement->execute(array($user->getEmail(), $user->getEnabled(), $user->getFirstName(), $user->getLastName(),
            $user->getMobilePhone(), $user->getImageUrl(), $user->getPassword(), $user->getRole(), $user->getId()));
    }


    //Function for getting user's info
    function getUserInfo (User $user) {

        $statement = $this->pdo->prepare(self::GET_USER_INFO);
        $statement->execute(array($user->getId()));

        $userInfo = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $userInfo[0];
    }
}
