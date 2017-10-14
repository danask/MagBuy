<?php

//Check for Session
require_once "../../utility/no_session_main.php";


//Autoload to require needed model files
function __autoload($className) {
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}


//HANDLE IMAGE FILE

$imagesDirectory = null;
$tmpName = null;
$userId = null;

//Check if file is uploaded
if(isset($_FILES['image']['tmp_name'])) {

    $tmpName = $_FILES['image']['tmp_name'];

    //Check if file is uploaded successfully
    if (!is_uploaded_file($tmpName)) {

        //Redirect to Error page
        header('Location: ../../view/user/edit.php?errorUpload');
    }

    //Get the uploaded file's type, extension and size
    $fileFormat = mime_content_type($tmpName);
    $type = explode("/", $fileFormat)[0];
    $extension = explode("/", $fileFormat)[1];
    $fileSize = filesize($tmpName);


    //Validate image file - image file below 2MB
    if ($type == "image" && $fileSize < 2048576) {

        $userId = $_SESSION['loggedUser'];
        $uploadTime = microtime();
        $imagesDirectory = "../../web/uploads/profileImage/$userId-$uploadTime.$extension";

    } else {

        //Redirect to Error page
        header('Location: ../../view/user/edit.php?errorUpload');
    }
} else {

    //Redirect to Error page
    header('Location: ../../view/user/edit.php?errorUpload');
}





//Update Validation
if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['firstName']) && isset($_POST['lastName'])
    && isset($_POST['mobilePhone']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
    && strlen($_POST['email']) > 3 && strlen($_POST['email']) < 254 && strlen($_POST['password']) >= 4
    && strlen($_POST['password']) < 20 && strlen($_POST['firstName']) >= 4 && strlen($_POST['firstName']) < 20
    && strlen($_POST['lastName']) >= 4 && strlen($_POST['lastName']) < 20 && ctype_digit($_POST['mobilePhone'])
    && strlen($_POST['mobilePhone']) == 10) {


    $user = new \model\User();

    //Try to accomplish connection with the database
    try {

        $userDao = \model\database\UserDao::getInstance();

        $user->setEmail($_POST['email']);
        $user->setEnabled(1);
        $user->setPassword(sha1($_POST['password']));
        $user->setFirstName($_POST['firstName']);
        $user->setLastName($_POST['lastName']);
        $user->setImageUrl($imagesDirectory);
        $user->setMobilePhone($_POST['mobilePhone']);
        $user->setRole(1);
        $user->setId($userId);


        //Check if user exists
        if($userDao->checkUserExist($user)) {

            //Locate to error Register Page
            header("Location: ../../view/user/edit.php?error");
        } else {

            $userDao->editUser($user);

            //Move file to permanent directory
            move_uploaded_file($tmpName, $imagesDirectory);

            header("Location: ../../view/main/main.php");
        }


    } catch (PDOException $e) {

        header("Location: ../../view/error/pdo_error.php");
    }

} else {

    //Locate to error Register Page
    header("Location: ../../view/user/edit.php?error");
}