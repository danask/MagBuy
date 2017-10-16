<?php
//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

$subcatSpecDao = \model\database\SubcatSpecificationsDao::getInstance();
$specifications = $subcatSpecDao->getAllSpecificationsForSubcategory($_GET['subcid']);
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
<h3>specs</h3>
<form action="../../controller/admin/new_product_specs_controller.php" method="post">
    <?php
    $specsTotal = 0;
    $specificationIds = array();
    foreach ($specifications as $spec) {
        echo $spec['name'] . "<br>";
        echo "<input type=\"text\" name=\"spec-" . $spec['id'] . "\" required/><br>";
        $specificationIds = $specsTotal . "=>" . $spec['id'] . ";";
        $specsTotal++;
    }
    ?>
    <input type="hidden" name="spec_ids" value="<?= $specificationIds; ?>">
    <input type="hidden" name="specs_total" value="<?= $specsTotal; ?>">
    <input type="hidden" name="product_id" value="<?= $_GET['pid']; ?>">
    <input type="submit" value="Create" name="submit">
</form>
</body>
</html>
