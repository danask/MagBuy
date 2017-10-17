<?php

namespace model\database;

use model\database\Connect\Connection;
use model\User;
use \PDOException;


class UserDao {

    //Make Singleton
    private static $instance;
    private $pdo;

    //Statements defined as constants
    const CHECK_LOGIN = "SELECT id, email, password FROM users WHERE email = ? AND password = ?";
    const CHECK_USER_EXIST = "SELECT id FROM users WHERE email = ?";
    const REGISTER_USER = "INSERT INTO users (email, enabled, first_name, last_name, mobile_phone,
                           image_url, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    const REGISTER_USER_ADDRESS = "INSERT INTO adresses (full_adress, is_personal, user_id) VALUES (?, ?, ?)";
    const EDIT_USER = "UPDATE users SET email = ?, enabled = ?, first_name = ?, last_name = ?, mobile_phone = ?,
                           image_url = ?, password = ?, role = ? WHERE id = ?";
    const UPDATE_ADDRESS = "UPDATE adresses SET full_adress = ?, is_personal = ? WHERE user_id = ?";
    const CHECK_ADDRESS_SET = "SELECT id FROM adresses WHERE user_id = ?";
    const GET_USER_INFO = "SELECT U.id, U.email, U.enabled, U.first_name, U.last_name, U.mobile_phone, U.image_url, 
                                  U.password, U.last_login, U.role, A.full_adress, A.is_personal  FROM users AS U 
                                  JOIN adresses AS A ON U.id = A.user_id WHERE A.user_id = ?";


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
    /**
     * @param User $user - receive user object
     * @return bool|int - return user id or false
     */
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
    /**
     * @param User $user - receive user object
     * @return bool - return of user exists or not
     */
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
    /**
     * @param User $user - receive user object
     * @return string - return registered user's id
     */
    function registerUser (User $user) {


        //Use try catch, to have transaction
        try {

            $this->pdo->beginTransaction();

            $statement = $this->pdo->prepare(self::REGISTER_USER);
            $statement->execute(array($user->getEmail(), $user->getEnabled(), $user->getFirstName(), $user->getLastName(),
                $user->getMobilePhone(), $user->getImageUrl(), $user->getPassword(), $user->getRole()));

            $lastInsertId = $this->pdo->lastInsertId();

            $statement = $this->pdo->prepare(self::REGISTER_USER_ADDRESS);
            $statement->execute(array($user->getAddress(), $user->getPersonal(), $lastInsertId));

            $this->pdo->commit();
            //Return registered user's ID
            return $lastInsertId;

        } catch (PDOException $e) {

            $this->pdo->rollBack();
            header("Location: ../../view/error/pdo_error.php");

        }
    }


    //Function for editing users
    /**
     * @param User $user - receive user object and edit the existing with it
     */
    function editUser (User $user) {

        try {

            $this->pdo->beginTransaction();

            $statement = $this->pdo->prepare(self::EDIT_USER);
            $statement->execute(array($user->getEmail(), $user->getEnabled(), $user->getFirstName(), $user->getLastName(),
                $user->getMobilePhone(), $user->getImageUrl(), $user->getPassword(), $user->getRole(), $user->getId()));

            $statement = $this->pdo->prepare(self::UPDATE_ADDRESS);
            $statement->execute(array($user->getAddress(), $user->getPersonal(), $user->getId()));

            $this->pdo->commit();

        } catch (PDOException $e) {

            $this->pdo->rollBack();
            header("Location: ../../view/error/pdo_error.php");

        }


    }


    //Function for checking existing address
    /**
     * @param User $user - receive user object
     * @return bool - returns true of there is address and false if there isn't
     */
    function checkAddressSet (User $user) {
        $statement = $this->pdo->prepare(self::CHECK_ADDRESS_SET);
        $statement->execute(array($user->getId()));

        //Check if Database returned a user (1 or 0 Columns)
        if ($statement->rowCount()) {

            //User exists, return true
            return true;
        } else {
            return false;

        }
    }




    //Function for getting user's info (used in edit predefined info)
    /**
     * @param User $user - receive user object
     * @return mixed - return all info for the user
     */
    function getUserInfo (User $user) {

        $statement = $this->pdo->prepare(self::GET_USER_INFO);
        $statement->execute(array($user->getId()));

        $userInfo = $statement->fetch();
        return $userInfo;
    }
}