<?php
//Include Error Handler
require_once '../../utility/error_handler.php';
//Check if user is logged
require_once '../../utility/session_main.php';

//Autoload to require needed model files
function __autoload($className) {

    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}


//Validation
if (!empty($_POST['email']) &&
    !empty($_POST['password'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (strlen($email) > 3 &&
        strlen($email) < 254 &&
        strlen($password) >= 4 &&
        strlen($password) <= 12) {


        //Get user's object
        $user = new \model\User();

        //Try to accomplish connection with the database
        try {
            $userDao = \model\database\UserDao::getInstance();

            $user->setEmail(htmlentities($email));
            $user->setPassword(sha1($password));

            $result = $userDao->checkLogin($user);

            if ($result) {

                //Check for enabled user
                if (!$userDao->checkEnabled($result)) {

                    header("Location: ../../view/user/login.php?blocked");
                    die();
                }


                $_SESSION['loggedUser'] = $result;
                $_SESSION['role'] = 1;
                $userDao->setLastLogin($user);


                //Check if user is admin (role = 3)
                if($userDao->checkIfLoggedUserIsAdmin($user) == 3) {
                    $_SESSION['role'] = 3;
                } elseif ($userDao->checkIfLoggedUserIsAdmin($user) == 2) {
                    $_SESSION['role'] = 2;
                } else {
                    $_SESSION['role'] = 1;
                }


                header("Location: ../../view/main/index.php");
                die();
            } else {

                header("Location: ../../view/user/login.php?error");
                die();
            }


        } catch (PDOException $e) {
            $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
            error_log($message, 3, '../../errors.log');
            header("Location: ../../view/error/error_500.php");
            die();
        }
    } else {

        //Locate to error Login Page
        header("Location: ../../view/user/login.php?error");
        die();
    }
} else {

    //Locate to error Login Page
    header("Location: ../../view/user/login.php?error_400");
    die();
}