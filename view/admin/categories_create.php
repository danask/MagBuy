<?php
//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

$supercatDao = \model\database\SuperCategoriesDao::getInstance();
$supercategories = $supercatDao->getAllSuperCategories();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form class="login-form" action="../../controller/admin/new_category_controller.php" method="post">
    <input type="text" name="name" placeholder="Category name" required/>
    <select name="supercategory_id">
        <?php
        foreach ($supercategories as $supercategory) {
            echo "<option value=\"" . $supercategory['id'] . "\">" . $supercategory['name'] . "</option>";
        }
        ?>
    </select>
    <input type="submit" value="Create" name="submit">
</form>
</body>
</html>
