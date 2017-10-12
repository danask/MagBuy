<?php

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
            $userId = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $userId[0]['id'];
        } else {
            return false;

        }
    } catch (Exception $e) {
//In case of PDO error, redirect to Error page
        header("Location: ../view/error.php");
    }
}