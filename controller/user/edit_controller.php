<?php
//Include Error Handler
require_once '../../utility/error_handler.php';
//Check for Session
require_once "../../utility/no_session_main.php";
//Include custom imageCrop Function
require_once "../../utility/imageCrop.php";
//Autoload to require needed model files

function __autoload($className){
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}



//HANDLE IMAGE FILE

$imagesDirectory = null;
$tmpName = null;
$userId = $_SESSION['loggedUser'];
$picture = null;

//Check if file is uploaded
if (!empty($_FILES['image']['tmp_name'])) {

    $picture = true;
    $tmpName = $_FILES['image']['tmp_name'];

    //Check if file is uploaded successfully
    if (!is_uploaded_file($tmpName)) {
        //Redirect to Error page
        header('Location: ../../view/error/error_400.php');
        die();
    }

    //Get the uploaded file's type, extension and size
    $fileFormat = mime_content_type($tmpName);
    $type = explode("/", $fileFormat)[0];
    $extension = explode("/", $fileFormat)[1];
    $fileSize = filesize($tmpName);

    if (!($extension == "jpeg" || $extension == "jpg" || $extension == "png" || $extension == "gif")) {
        //Redirect to error file type or size edit
        header('Location: ../../view/user/edit.php?errorUL');
        die();
    }

    //Validate image file - image file below 5MB
    if ($type == "image" && $fileSize < 5048576) {
        $uploadTime = microtime();
        $imagesDirectory = "../../web/uploads/profileImage/$userId-$uploadTime.$extension";
    } else {
        //Redirect to error file type or size edit
        header('Location: ../../view/user/edit.php?errorUL');
        die();
    }
} else {
    $picture = false;
}
//END IMAGE FILE HANDLE


//If password isn't set
if (empty($_POST['password'])) {
    $_POST['password'] = false;
}

//Radio and address buttons validation
if (!empty($_POST['personal'])) {
    if (!($_POST['personal'] == 1 || $_POST['personal'] == 2)) {
        //Locate to error Register Page
        header('Location: ../../view/error/error_400.php');
        die();
    }
} else {
    $_POST['personal'] = 0;
}

if (!empty($_POST['address'])) {
    if (!(strlen($_POST['address']) > 4 && strlen($_POST['address']) < 200)) {
        //Locate to error Register Page
        header("Location: ../../view/user/edit.php?errorAR");
        die();
    }
} else {
    $_POST['address'] = 0;
}



//Update Validation
if (!empty($_POST['email']) && (!empty($_POST['password']) || $_POST['password'] === false) && !empty($_POST['firstName'])
    && !empty($_POST['lastName']) && !empty($_POST['mobilePhone'])) {


    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $mobilePhone = $_POST['mobilePhone'];

    //Validate Email input
    if (!(filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($email) > 3 && strlen($email) < 254)) {
        //Redirect to Error page
        header('Location: ../../view/error/error_400.php');
        die();
    }

    //Validate password input
    if (!((strlen($password) >= 4 && strlen($password) <= 20) || $password === false)) {
        //Redirect password input error edit
        header('Location: ../../view/user/edit.php?errorPassSyntax');
        die();
    }

    if (!(strlen($firstName) >= 4 && strlen($firstName) < 20)) {
        //Redirect First Name input error edit
        header('Location: ../../view/user/edit.php?errorFN');
        die();
    }

    if (!(strlen($lastName) >= 4 && strlen($lastName) < 20)) {
        //Redirect Last Name input error edit
        header('Location: ../../view/user/edit.php?errorLN');
        die();
    }

    if (!(ctype_digit($mobilePhone) && strlen($mobilePhone) == 10)) {
        //Redirect Last Name input error edit
        header('Location: ../../view/user/edit.php?errorMN');
        die();
    }

    $user = new \model\User();

    //Try to accomplish connection with the database
    try {

        $userDao = \model\database\UserDao::getInstance();

        $user->setEmail(htmlentities($email));
        $user->setFirstName(htmlentities($firstName));
        $user->setLastName(htmlentities($lastName));
        $user->setMobilePhone(htmlentities($mobilePhone));
        $user->setId($userId);
        $user->setAddress(htmlentities($_POST['address']));
        $user->setPersonal(htmlentities($_POST['personal']));

        //Get current user's info
        $userArr = $userDao->getUserInfo($user);

        //Check if password is correct
        if (sha1($_POST['passwordOld']) == $userArr['password']) {

            //Check if password is changed or is the same
            if ($password === false) {
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
            if (!empty($_POST['address'])) {
                $user->setAddress(htmlentities($_POST['address']));
            } else {
                $user->setAddress(0);
            }

            //Check if radio button is set
            if (!empty($_POST['personal'])) {
                $user->setPersonal(htmlentities($_POST['personal']));
            } else {
                $user->setPersonal(0);
            }

            //Check if user exists and if user's new email is the same as old one
            if ($userDao->checkUserExist($user) && $userArr['email'] != $user->getEmail()) {
                //Locate to error Register Page
                header("Location: ../../view/user/edit.php?errorEmail");
                die();
            } else {

                $user->setRole($userArr['role']);

                $userDao->editUser($user);

                //Move file to permanent directory
                if ($picture) {
                    move_uploaded_file($tmpName, $imagesDirectory);
                    cropImage($imagesDirectory, 200);
                }


                if(isset($_GET['addAddress'])) {
                    header("Location: ../../view/main/checkout.php");
                    die();
                } else {
                    header("Location: ../../view/main/index.php");
                    die();
                }
            }
        } else {
            //Locate to error Register Page
            header("Location: ../../view/user/edit.php?errorPassMatch");
            die();
        }
    } catch (PDOException $e) {
        $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
        error_log($message, 3, '../../errors.log');
        header("Location: ../../view/error/error_500.php");
        die();
    }
} else {
    //Redirect to Error page
    header('Location: ../../view/error/error_400.php');
    die();
}