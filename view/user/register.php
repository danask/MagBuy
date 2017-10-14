<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="../../web/assets/css/login.css" type="text/css">

    <title>Login</title>
</head>
<body>

<div class="login-page">
    <div class="form">
        <form class="login-form" action="../../controller/user/login_controller.php" method="post">

            <input type="text" name="email" placeholder="Enter Your Email" required/>
            <input type="password" name="password" placeholder="Enter Your Password" required/>
            <input type="text" name="firstName" placeholder="Enter First Name" required/>
            <input type="text" name="lastName" placeholder="Enter Last Name" required/>
            <input type="number" name="mobilePhone" placeholder="Enter Mobile Number" required/>

            <input id="login" type="submit" value="REGISTER">
            <p class="message">Already a user? <a href="login.php">Log In</a></p>
        </form>
    </div>
</div>

</body>
</html>