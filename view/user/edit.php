<?php
//Require old user's info and check for session (checked in controller)
require_once "../../controller/user/get_users_info_controller.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSS for login/register/edit form -->
    <link rel="stylesheet" href="../../web/assets/css/user.css" type="text/css">

    <title>Edit</title>
</head>
<body>

<div class="login-page">
    <div id="logo"><a href="../main/index.php"><img src="../../web/assets/images/logo.png"></a></div>
    <div class="form">
        <form enctype="multipart/form-data" class="login-form" action="../../controller/user/edit_controller.php"
              method="post">

            <input type="text" name="email" value="<?= $userArr["email"] ?>" required/>
            <input type="password" name="passwordOld" placeholder="Your Current Password" required/>
            <input type="password" name="password" placeholder="New Password (Optional)"/>
            <input type="text" name="firstName" value="<?= $userArr["first_name"] ?>" required/>
            <input type="text" name="lastName" value="<?= $userArr["last_name"] ?>" required/>
            <input type="tel" name="mobilePhone" value="<?= $userArr["mobile_phone"] ?>" required/>
            <input type="text" name="address" <?php if ($userArr['full_adress']) {
                echo "value=\"" . $userArr['full_adress'] . "\"";
            } else {
                echo "placeholder=\"Enter Address\"";
            } ?> >
            <div id="fileupload">
                <input class="radio" type="radio" name="personal" value="1" <?php if ($userArr['is_personal'] == 1) {
                    echo "checked";
                } ?> >&nbspPersonal&nbsp&nbsp&nbsp
                <input class="radio" type="radio" name="personal" value="2" <?php if ($userArr['is_personal'] == 2) {
                    echo "checked";
                } ?> >&nbspBusiness
            </div>
            <div id="fileupload">
                <p id="fileuploadMessage">Profile picture</p>
                <input type="file" name="image"/>
            </div>

            <input id="login" type="submit" value="UPDATE">
            <?php if (isset($_GET['error']) || isset($_GET['errorUpload'])) {
                echo "
            <li class='wrongReg'>Email might exists</li>
            <li class='wrongReg'>Password: between 4 and 12 symbols</li>
            <li class='wrongReg'>Enter your current password</li>
            <li class='wrongReg'>Names: between 4 and 20 symbols</li>
            <li class='wrongReg'>Mobile phone must be 10 digits</li>
            <li class='wrongReg'>Address: between 4 and 200 symbols</li>
            <li class='wrongReg'>Image must be below 2MB</li>";
            }; ?>
            <p class="message"><a href="../main/index.php">Back to offers?</a></p>
        </form>
    </div>
</div>

</body>
</html>