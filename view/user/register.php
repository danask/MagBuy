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

            <input type="text" name="email" placeholder="Your Email" required/>
            <input type="password" name="password" placeholder="Your Password" required/>
            <input type="password" name="password2" placeholder="Repeat Password" required/>
            <input type="text" name="firstName" placeholder="First Name" required/>
            <input type="text" name="lastName" placeholder="Last Name" required/>
            <input type="tel" name="mobilePhone" placeholder="Mobile Number" required/>

            <input id="login" type="submit" value="REGISTER">

            <?php if(isset($_GET['error'])){ echo "
            <li class='wrongReg'>Email might exists</li><li class='wrongReg'>Password: between 4 and 12 symbols</li>
            <li class='wrongReg'>Passwords must match</li>
            <li class='wrongReg'>Names: between 4 and 20 symbols</li>
            <li class='wrongReg'>Mobile phone must be 10 digits</li>"; };?>
            <p class="message">Already a user? <a href="login.php">&nbspLog In</a></p>
        </form>
    </div>
</div>

</body>
</html>