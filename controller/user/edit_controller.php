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
$userId = $_SESSION['loggedUser'];
$picture = null;


//Check if file is uploaded
if(isset($_FILES['image']['tmp_name'])) {

    $picture = true;

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

        $uploadTime = microtime();
        $imagesDirectory = "../../web/uploads/profileImage/$userId-$uploadTime.$extension";

    } else {

        //Redirect to Error page
        header('Location: ../../view/user/edit.php?errorUpload');
    }
} else {

    $picture = false;
}

//END IMAGE FILE HANDLE

//If password isn't set
if (!isset($_POST['password'])) {
    $_POST['password'] = 0;
}


//Radio and address buttons validation
if(isset($_POST['personal'])) {
    if (!($_POST['personal'] == 1 || $_POST['personal'] == 2)) {

        //Locate to error Register Page
        header("Location: ../../view/user/edit.php?error");
    }
}

if (isset($_POST['address'])) {
    if(!(strlen($_POST['address']) > 4 && strlen($_POST['address']) < 200)){

        //Locate to error Register Page
        header("Location: ../../view/user/edit.php?error");
    }
}


//Update Validation
if (isset($_POST['email']) && (isset($_POST['password']) || $_POST['password'] == 0) && isset($_POST['firstName'])
    && isset($_POST['lastName']) && isset($_POST['mobilePhone'])
    && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && strlen($_POST['email']) > 3
    && strlen($_POST['email']) < 254 && ((strlen($_POST['password']) >= 4 && strlen($_POST['password']) < 20) || $_POST['password'] == 0)
    && strlen($_POST['firstName']) >= 4 && strlen($_POST['firstName']) < 20 && strlen($_POST['lastName']) >= 4
    && strlen($_POST['lastName']) < 20 && ctype_digit($_POST['mobilePhone']) && strlen($_POST['mobilePhone']) == 10) {


    $user = new \model\User();

    //Try to accomplish connection with the database
    try {

        $userDao = \model\database\UserDao::getInstance();

        $user->setEmail(htmlentities($_POST['email']));
        $user->setEnabled(1);
        $user->setFirstName(htmlentities($_POST['firstName']));
        $user->setLastName(htmlentities($_POST['lastName']));
        $user->setMobilePhone(htmlentities($_POST['mobilePhone']));
        $user->setRole(1);
        $user->setId($userId);
        $user->setAddress(htmlentities($_POST['address']));
        $user->setPersonal(htmlentities($_POST['personal']));


        //Get current user's info
        $userArr = $userDao->getUserInfo($user);

        //Check if password is correct
        if(sha1($_POST['passwordOld']) != $userArr['password']) {

            //Locate to error Register Page
            header("Location: ../../view/user/edit.php?error");

            //Sends buffer
            ob_flush();
        }

        //Check if password is changed or is the same
        if (strlen($_POST['password']) == 0) {
            $user->setPassword($userArr['password']);
        } else {
            $user->setPassword(sha1($_POST['password']));
        }

        //Check if picture is changed or is the same
        if ($picture) {
            $user->setImageUrl($imagesDirectory);
        } else {
            $user->setImageUrl($userArr['image_url']);
        }

        //Check if address is set
        if(isset($_POST['address'])) {
            $user->setAddress(htmlentities($_POST['address']));
        } else {
            $user->setAddress(0);
        }

        //Check if radio button is set
        if(isset($_POST['personal'])){
            $user->setPersonal(htmlentities($_POST['personal']));
        } else {
            $user->setPersonal(0);
        }

        //Check if user exists and if user's new email is the same as old one
        if ($userDao->checkUserExist($user) && $userArr['email'] != $user->getEmail()) {

            //Locate to error Register Page
            header("Location: ../../view/user/edit.php?error");
        } else {

            $userDao->editUser($user);

            //Move file to permanent directory
            if($picture) {
                move_uploaded_file($tmpName, $imagesDirectory);
            }

            header("Location: ../../view/main/index.php");
        }


    } catch (PDOException $e) {

        header("Location: ../../view/error/pdo_error.php");
    }

} else {

    //Locate to error Register Page
    header("Location: ../../view/user/edit.php?error");
}