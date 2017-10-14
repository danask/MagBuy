<?php

namespace model\database;

use model\database\Connect\Connection;
use \PDOException;

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
    function checkUserExists(User $email) {

        try {
            $statement = $this->pdo->prepare(self::CHECK_USER_EXISTS);
            $statement->execute(array($email->getEmail));

            //Check if Database returned a user (1 or 0 Columns)
            if ($statement->rowCount()) {

                //Fetch User ID and return it as result
                $userId = $statement->fetch();
                return $userId['id'];
            } else {
                return false;

            }

        } catch (PDOException $e) {

            //HAVE TO ADD ERROR PAGE
            return false;
        }
    }



    //Function for password check
    function checkPassword(User $id, $log) {

        try {
            $statement = $this->pdo->prepare(self::CHECK_PASS);
            $statement->execute(array($log->getId, $log->getPassword));

            //Check if Database returned a user (1 or 0 Columns)
            if ($statement->rowCount()) {

                //Fetch User ID and return it as result
                $userId = $statement->fetch();
                return $userId['id'];
            } else {
                return false;

            }

        } catch (PDOException $e) {

            //HAVE TO ADD ERROR PAGE
            return false;
        }
    }



    //Function for registering user
    function registerUser (User $log) {

        try {
            $statement = $this->pdo->prepare(self::REGISTER_USER);
            $statement->execute(array($log->getEmail, $log->getEnabled, $log->getFirstName, $log->getLastName,
                                      $log->getMobileNumber, $log->getimageUrl, $log->getPassword, $log->getRole));

            //Return registered user's ID
            return $this->pdo->lastInsertId();

        } catch (PDOException $e) {

            //HAVE TO ADD ERROR PAGE
            return false;
        }
    }
}