<?php

//Include Admin check
require_once '../../../utility/admin_session.php';

//Check if user is blocked
require_once "../../../utility/blocked_user.php";

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../../../web/assets/css/adminPanel.css">
</head>
<body>
<div class="page">
    <form action="../../../controller/admin/supercategories/new_supercategory_controller.php" method="post">
        <input type="text" name="name" placeholder="Supercategory name" maxlength="40" required/><br>
        <input type="submit" value="Create" name="submit">
    </form>
    <a href="supercategories_view.php">
        <button>Back to Supercategories</button>
    </a>
</div>
</body>
</html>
