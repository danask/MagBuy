<?php
namespace model\database;
use model\database\Connect\Connection;
use model\User;
use PDOException;
class UserDao {

    //Make Singleton
    private static $instance;
    private $pdo;


    //Statements defined as constants
    const CHECK_LOGIN = "SELECT id, email, password FROM users WHERE email = ? AND password = ?";

    const CHECK_USER_EXIST = "SELECT id FROM users WHERE email = ?";

    const REGISTER_USER = "INSERT INTO users (email, enabled, first_name, last_name, mobile_phone,
                           image_url, password, last_login, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    const REGISTER_USER_ADDRESS = "INSERT INTO adresses (full_adress, is_personal, user_id) VALUES (?, ?, ?)";

    const EDIT_USER = "UPDATE users SET email = ?, enabled = ?, first_name = ?, last_name = ?, mobile_phone = ?,
                           image_url = ?, password = ?, role = ? WHERE id = ?";

    const UPDATE_ADDRESS = "UPDATE adresses SET full_adress = ?, is_personal = ? WHERE user_id = ?";

    const CHECK_ADDRESS_SET = "SELECT id FROM adresses WHERE NOT full_adress = '0' AND user_id = ?";

    const GET_USER_INFO = "SELECT U.id, U.email, U.enabled, U.first_name, U.last_name, U.mobile_phone, U.image_url, 
                                  U.password, U.last_login, U.role, A.full_adress, A.is_personal  FROM users AS U 
                                  JOIN adresses AS A ON U.id = A.user_id WHERE A.user_id = ?";

    const SET_LAST_LOGIN = "UPDATE users SET last_login = ? WHERE email = ?";

    const IS_FIRST_USER = "SELECT id FROM users";

    const ROLE = "SELECT role FROM users WHERE email = ? AND password = ?";

    const RESET_PASS = "UPDATE users SET password = ? WHERE email = ?";





    //Get connection in construct
    private function __construct() {

        $this->pdo = Connection::getInstance()->getConnection();
    }

    public static function getInstance() {

        if (self::$instance === null) {
            self::$instance = new UserDao();
        }
        return self::$instance;
    }




    /**
     * Function for checking if login is correct.
     * @param User $user - Receive user object with information about it.
     * @return bool|int - Returns user's ID.
     */
    function checkLogin(User $user) {

        $statement = $this->pdo->prepare(self::CHECK_LOGIN);
        $statement->execute(array(
            $user->getEmail(),
            $user->getPassword()));

        if ($statement->rowCount()) {

            $userId = $statement->fetch();
            return (int)$userId['id'];
        } else {

            return false;
        }
    }



    /**
     * Function for checking if user exists.
     * @param User $user - Receives user's email as object.
     * @return bool - Returns if user exists.
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



    /**
     * Function for registering user.
     * @param User $user - Receives user's information as object.
     * @return string - Returns registered user's ID.
     */
    function registerUser(User $user) {

        //Use try catch, to have transaction
        try {
            $this->pdo->beginTransaction();

            $statement = $this->pdo->prepare(self::REGISTER_USER);
            $statement->execute(array(
                $user->getEmail(),
                $user->getEnabled(),
                $user->getFirstName(),
                $user->getLastName(),
                $user->getMobilePhone(),
                $user->getImageUrl(),
                $user->getPassword(),
                $user->getLastLogin(),
                $user->getRole()));

            $lastInsertId = $this->pdo->lastInsertId();

            $statement = $this->pdo->prepare(self::REGISTER_USER_ADDRESS);
            $statement->execute(array(
                $user->getAddress(),
                $user->getPersonal(),
                $lastInsertId));


            $this->pdo->commit();

            return $lastInsertId;
        } catch (PDOException $e) {

            $this->pdo->rollBack();
                $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
                error_log($message, 3, 'errors.log');
                header("Location: ../../view/error/error_500.php");
                die();
        }
    }




    /**
     * Function for editing users.
     * @param User $user - Receives new information about user as object.
     */
    function editUser(User $user) {

        //Use try catch, to have transaction
        try {
            $this->pdo->beginTransaction();

            $statement = $this->pdo->prepare(self::EDIT_USER);
            $statement->execute(array(
                $user->getEmail(),
                $user->getEnabled(),
                $user->getFirstName(),
                $user->getLastName(),
                $user->getMobilePhone(),
                $user->getImageUrl(),
                $user->getPassword(),
                $user->getRole(),
                $user->getId()));

            $statement = $this->pdo->prepare(self::UPDATE_ADDRESS);
            $statement->execute(array(
                $user->getAddress(),
                $user->getPersonal(),
                $user->getId()));

            $this->pdo->commit();
        } catch (PDOException $e) {

            $this->pdo->rollBack();
            header("Location: ../../view/error/error_500.php");
        }
    }



    /**
     * Function for checking existing address.
     * @param User $user - Receive user's ID as object.
     * @return bool - Returns true or false if exists.
     */
    function checkAddressSet(User $user) {

        $statement = $this->pdo->prepare(self::CHECK_ADDRESS_SET);
        $statement->execute(array(
            $user->getId()));

        if ($statement->rowCount()) {

            return true;
        } else {

            return false;
        }
    }



    /**
     * Function for getting user's info.
     * @param User $user - Receives user's ID as object.
     * @return mixed - Returns user's info as array.
     */
    function getUserInfo(User $user) {

        $statement = $this->pdo->prepare(self::GET_USER_INFO);
        $statement->execute(array(
            $user->getId()));

        $userInfo = $statement->fetch();

        return $userInfo;
    }


    /**
     * Function for setting last login.
     * @param User $user - Receives user's login time and email.
     */
    function setLastLogin(User $user) {

        $statement = $this->pdo->prepare(self::SET_LAST_LOGIN);
        $user->setLastLogin();
        $statement->execute(array(
            $user->getLastLogin(),
            $user->getEmail()));
    }

    /**
     *
     * @return bool - Returns true if user is admin (first registered)
     */
    function checkIfUserFirst() {

        $statement = $this->pdo->prepare(self::IS_FIRST_USER);
        $statement->execute();

        if ($statement->rowCount()) {
            //Existing users
            return false;
        } else {
            //First User
            return true;
        }
    }

    function checkIfLoggedUserIsAdmin(User $user) {

        $statement = $this->pdo->prepare(self::ROLE);
        $statement->execute(array(
            $user->getEmail(),
            $user->getPassword()));

            $userRole = $statement->fetch();
            return (int)$userRole['role'];
    }


    function resetPassword (User $user) {

        $statement = $this->pdo->prepare(self::RESET_PASS);
        $statement->execute(array(
            $user->getPassword(),
            $user->getEmail()));
    }
}