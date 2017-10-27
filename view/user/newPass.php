<?php
//Check for Session
require_once "../../utility/session_main.php";

if(!isset($_SESSION['passReset'])) {
    header('Location: ../../view/user/login.php');
}
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

    <title>Login</title>
</head>
<body>

<div class="login-page">
    <div id="logo"><a href="../main/index.php"><img src="../../web/assets/images/logo.png"></a></div>
    <div class="form">
        <form class="login-form" action="../../controller/user/new_pass_controller.php" method="post">
            <input type="password" name="pass1" placeholder="Enter New Password"
                   pattern=".{4,20}" required title="Password 4 to 20 characters"/>
            <input type="password" name="pass2" placeholder="Repeat New Password"
                   pattern=".{4,20}" required title="Password 4 to 20 characters"/>

            <p class="wrongInput" <?= ($_GET['errorPassSyntax']) ?:"style='display: block;'"?>>
                Passwords must be between 4 and 12 symbols!</p>
            <p class="wrongInput" <?= ($_GET['errorPassMatch']) ?:"style='display: block;'"?>>
                Passwords doesn't match!</p>

            <input id="login" type="submit" value="UPDATE">

        </form>
    </div>
</div>

</body>
</html>