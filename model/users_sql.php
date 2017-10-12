<?php


//Include PDO connection function
require_once "sqlConnection.php";



//Function to check if user exists

/**
 * @param $email - receives email to check if user exists
 * @return bool - returns the existing user ID or false if the user doesn't exist
 */

function checkUserExist($email){

    //Try the code for exceptions
    try {

        //Get PDO connection, using the function above
        $pdo = getConnection();

        //Prepare statement to execute in the Database(prevention of Database injection)
        $statement = $pdo->prepare("SELECT id, email FROM users WHERE email = ?");

        //Execute statement
        $statement->execute(array($email));

        //Check if Database returned a user (1 or 0 Columns)
        if ($statement->rowCount()) {

            //Fetch User ID and return it as result
            $userId = $statement->fetch();
            return $userId['id'];
        } else {
            return false;

        }

        //Catch exception and perform action
    } catch (PDOException $e) {

        //HAVE TO ADD ERROR PAGE
        return false;
    }
}


//Function for checking if user entered correct password

/**
 * @param $logingUserId - receive loging user id
 * @param $password - receive user's entered password
 * @return mixed - return user's id for session if password match or false if doesn't
 */

function checkPass($logingUserId, $password){

    //Try the code for exceptions
    try{

        //Get PDO connection, using the function above
        $pdo = getConnection();


            //Prepare statement to execute in the Database(prevention of Database injection)
            $statement = $pdo->prepare("SELECT id, password FROM users WHERE id = ? AND password = ?");

            //Execute statement
            $statement->execute(array($logingUserId, $password));

            //Check if Database returned a user (1 or 0 Columns)
            if ($statement->rowCount()) {

                //Fetch User ID and return it as result
                $userInfo = $statement->fetch();
                return $userInfo['id'];
            } else {
                return false;
            }

        //Catch exception and perform action
    } catch (PDOException $e) {

        //HAVE TO ADD ERROR PAGE
        return false;
    }
}
