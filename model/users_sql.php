<?php

//Include connection
require_once "sqlConnection.php";

//Function to check if user exists

/**
 * @param $email - receives email to check if user exists
 * @return bool - returns the existing user ID or false if the user doesn't exist
 */

function checkUserExist($email)
{
    try {

        //Get PDO connection, using the function above

        $pdo = getConnection();

        //Prepare statement to execute in the Database(prevention of Database injection)
        $statement = $pdo->prepare("SELECT id, email FROM users WHERE name = ?");

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
    } catch (Exception $e) {

        //HAVE TO ADD ERROR PAGE
        return false;
    }
}


//Function for checking if user entered correct password


function checkPass($logingUserId, $password){

    try{

        //Get PDO connection, using the function above
        $pdo = getConnection();

        //If Password is null, check only username(for registration) otherwise check both(for login)
        //Check for Registration
        if ($password == null) {
            //Prepare statement to execute in the Database(prevention of Database injection)
            $statement = $pdo->prepare("SELECT 'name' FROM users WHERE 'name' = ?");
            //Execute statement
            $statement->execute(array($username));
            //Check if Database returned a user (1 or 0 Columns)
            if ($statement->rowCount()) {
                return true;
            } else {
                return false;
            }
            //Check for Login
        } else {
            //Prepare statement to execute in the Database(prevention of Database injection)
            $statement = $pdo->prepare("SELECT user_id, name, password FROM users WHERE name = ? AND password = ?");
            //Execute statement
            $statement->execute(array($username, $password));
            //Check if Database returned a user (1 or 0 Columns)
            if ($statement->rowCount()) {
                //Fetch User ID and return it as result
                $userInfo = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $userInfo[0]['user_id'];
            } else {
                return false;
            }
        }
    } catch (Exception $e) {
        //In case of PDO error, redirect to Error page
        header("Location: ../view/error.php");
    }
}
