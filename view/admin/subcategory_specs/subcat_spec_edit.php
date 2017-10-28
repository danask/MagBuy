<?php
require_once "../../../controller/admin/subcategory_specs/edit_subcat_spec_controller.php";
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
    <form action="../../../controller/admin/subcategory_specs/edit_subcat_spec_controller.php" method="post">
        <input type="hidden" name="spec_id" value="<?= $spec['id'] ?>">
        <input type="text" name="name" placeholder="Title" required value="<?= $spec['name'] ?>"/><br>
        <select name="subcategory_id">
            <?php
            foreach ($subcategories as $subcategory) {
                echo "<option value=\"" . $subcategory['id'] . "\"";
                if ($subcategory['id'] == $spec['subcategory_id']) {
                    echo "selected";
                }
                echo ">" . $subcategory['name'] . "</option>";
            }
            ?>
        </select><br>
        <input type="submit" value="Create" name="submit">
    </form>
    <a href="subcat_specs_view.php">
        <button>Back to Subcat Specs</button>
    </a>
</div>
</body>
</html>
