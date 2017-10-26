<?php
require_once "../../../controller/admin/supercategories/edit_supercategory_controller.php";
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
    <form action="../../../controller/admin/supercategories/edit_supercategory_controller.php" method="post">
        <input type="hidden" name="supercat_id" value="<?= $superCat['id'] ?>">
        Name:<br>
        <input type="text" name="name" placeholder="Supercategory name" value="<?= $superCat['name'] ?>" required
               style="width: 300px"/><br>
        <input type="submit" value="Edit" name="submit">
    </form>
    <a href="supercategories_view.php">
        <button>Back to Supercategories</button>
    </a>
</div>
</body>
</html>
