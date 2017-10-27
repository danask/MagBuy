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

    <title>Forgotten Password</title>
</head>
<body>

<div class="login-page">
    <div id="logo"><a href="../main/index.php"><img src="../../web/assets/images/logo.png"></a></div>
    <div class="form">
        <form class="login-form" action="../../controller/user/create_tokken_controller.php" method="POST">
            <?php if(isset($_GET['tokken'])) { echo "<p id=\"resetPasswordMessage\">Check email for reset password tokken.</p>
            <input type=\"text\" name=\"tokken\" placeholder=\"Enter Tokken\"/><input type=\"hidden\" 
            name=\"emailHidden\" value='" . $_GET['tokken'] . "'>";}
            else {echo "<input type=\"email\" name=\"email\" placeholder=\"Enter Your Email\">";}?>
            <?php if(isset($_GET['errorTokken'])) {echo "<p id=\"wrongTokken\">Wrong Tokken! Try again.</p>";} ?>
            <input id="login" type="submit" value="Reset Password">

            <?php if(isset($_GET['error'])){ echo "<p id=\"wrongLogin\">User not found!</p>"; };?>
            <p class="message">Not registered? <a href="register.php">Create an account</a></p>

        </form>
    </div>
</div>

</body>
</html>