<?php
//Check for Session
require_once "../../utility/session_main.php";
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

    <title>Register</title>
</head>
<body>

<div class="login-page">
    <div id="logo"><a href="../main/index.php"><img src="../../web/assets/images/logo.png"></a></div>
    <div class="form">
        <form class="login-form" action="../../controller/user/register_controller.php" method="post">

            <p id='wrongField' class="wrongInput" <?= ($_GET['errorField']) ?:"style='display: block;'"?>>
                All fields are required!</p>
            <input type="text" name="email" placeholder="Your Email" required/>
            <p id='wrongEmail' class="wrongInput" <?= ($_GET['errorEmail']) ?:"style='display: block;'"?>>
                Email already exists!</p>
            <input type="password" name="password" placeholder="Your Password" required/>
            <p id='wrongPass' class="wrongInput" <?= ($_GET['errorPassSyntax']) ?:"style='display: block;'"?>>
                Passwords must be between 4 and 12 symbols!</p>
            <p id='passMatch' class="wrongInput" <?= ($_GET['errorPassMatch']) ?:"style='display: block;'"?>>
                Passwords doesn't match!</p>
            <input type="password" name="password2" placeholder="Repeat Password" required/>
            <input type="text" name="firstName" placeholder="First Name" required/>
            <p id='wrongFN' class="wrongInput"  <?= ($_GET['errorFN']) ?:"style='display: block;'"?>>
                First Name should be between 4 and 20 symbols!</p>
            <input type="text" name="lastName" placeholder="Last Name" required/>
            <p id='wrongLN' class="wrongInput"  <?= ($_GET['errorLN']) ?:"style='display: block;'"?>>
                Last Name should be between 4 and 20 symbols!</p>
            <input type="tel" name="mobilePhone" placeholder="Mobile Number" required/>
            <p id='wrongMN' class="wrongInput"  <?= ($_GET['errorMN']) ?:"style='display: block;'"?>>
                Mobile Number should be 10 digits!</p>

            <input id="login" type="submit" value="REGISTER">
            <p class="message">Already a user? <a href="login.php">&nbspLog In</a></p>
        </form>
    </div>
</div>

</body>
</html>