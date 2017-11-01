<?php
require_once "../../../controller/admin/subcategories/new_subcategory_controller.php";

//Check if user is blocked
require_once "../../../utility/blocked_user_dir_back.php";
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
    <form action="../../../controller/admin/subcategories/new_subcategory_controller.php" method="post">
        <input type="text" name="name" placeholder="Subcategory name" maxlength="40" required/><br>
        <select name="category_id" required>
            <option disabled selected value="">Choose Category</option>
            <?php
            foreach ($categories as $category) {
                echo "<option value=\"" . $category['id'] . "\">" . $category['name'] . "</option>";
            }
            ?>
        </select><br>
        <input type="submit" value="Create" name="submit">
    </form>
    <a href="subcategories_view.php">
        <button>Back to SubCategories</button>
    </a>
</div>
</body>
</html>
