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

            <input type="email" name="email" value="<?= $userArr["email"] ?>" required/>
            <p class="wrongInput" <?= ($_GET['errorEmail']) ?:"style='display: block;'"?>>
                Email already exists!</p>

            <input type="password" name="passwordOld" placeholder="Your Current Password"
                   pattern=".{4,20}" required title="Password 4 to 20 characters"/>
            <p class="wrongInput" <?= ($_GET['errorPassMatch']) ?:"style='display: block;'"?>>
                Wrong Password!</p>

            <input type="password" name="password" placeholder="New Password (Optional)"
                   pattern=".{4,20}" title="Password 4 to 20 characters"/>
            <p class="wrongInput" <?= ($_GET['errorPassSyntax']) ?:"style='display: block;'"?>>
                Passwords must be between 4 and 12 symbols!</p>

            <input type="text" name="firstName" value="<?= $userArr["first_name"] ?>"
                   pattern=".{4,20}" required title="First Name 4 to 20 characters"/>
            <p class="wrongInput"  <?= ($_GET['errorFN']) ?:"style='display: block;'"?>>
                First Name should be between 4 and 20 symbols!</p>

            <input type="text" name="lastName" value="<?= $userArr["last_name"] ?>"
                   pattern=".{4,20}" required title="Last Name 4 to 20 characters"/>
            <p class="wrongInput"  <?= ($_GET['errorLN']) ?:"style='display: block;'"?>>
                Last Name should be between 4 and 20 symbols!</p>

            <input type="tel" name="mobilePhone" value="<?= $userArr["mobile_phone"] ?>"
                   pattern="[0-9]{10}" required title="Number must be 10 digits"/>
            <p class="wrongInput"  <?= ($_GET['errorMN']) ?:"style='display: block;'"?>>
                Mobile Number should be 10 digits!</p>

            <input type="text" name="address" <?php if ($userArr['full_adress']) {
                echo "value=\"" . $userArr['full_adress'] . "\"";
            } else {
                echo "placeholder=\"Enter Address\"";
            } ?> pattern=".{4,200}" title="Password 4 to 200 characters" ><p class="wrongInput"  <?= ($_GET['errorAR']) ?:"style='display: block;'"?>>
                Address must be between 4 and 200 symbols!</p>
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
            <p class="wrongInput"  <?= ($_GET['errorUL']) ?:"style='display: block;'"?>>
                Please upload image file below 5MB (jpg/jpeg/png/gif)</p>

            <input id="login" type="submit" value="UPDATE">

            <p class="message"><a href="../main/index.php">Back to offers?</a></p>
        </form>
    </div>
</div>

</body>
</html>