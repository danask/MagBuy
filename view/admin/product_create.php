<?php
//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

$subcatDao = \model\database\SubCategoriesDao::getInstance();
$subcategories = $subcatDao->getAllSubCategories();
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
<form action="../../controller/admin/new_product_controller.php" method="post">
    <input type="text" name="title" placeholder="Title" required/><br>
    <textarea name="description" placeholder="Description" required></textarea><br>
    <input type="number" name="price" placeholder="Price" min="0" required/><br>
    <input type="number" name="quantity" placeholder="Quantity" min="0" required/><br>
    <select name="subcategory_id">
        <?php
        foreach ($subcategories as $subcategory) {
            echo "<option value=\"" . $subcategory['id'] . "\">" . $subcategory['name'] . "</option>";
        }
        ?>
    </select><br>
    <input type="submit" value="Continue to specs" name="submit">
</form>
</body>
</html>
