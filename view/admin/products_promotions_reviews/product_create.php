<?php
require_once "../../../controller/admin/products_promotions_reviews/new_product_controller.php";

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
    <!-- Add Favicon -->
    <link rel="shortcut icon" href="../../../web/assets/images/favicon.ico?v4" type="image/x-icon">
    <script src="../../../web/assets/js/jquery-1.11.1.min.js"></script>
    <script src="../../../web/assets/js/admin/product.specs.js"></script>

</head>
<body>
<div class="page">
    <form enctype="multipart/form-data"
          action="../../../controller/admin/products_promotions_reviews/new_product_controller.php" method="post">
        Title <input type="text" name="title" placeholder="Title" maxlength="40" required/><br>
        Description <textarea name="description" placeholder="Description" maxlength="150000" required></textarea><br>
        Price <input type="number" name="price" step="0.01" placeholder="Price" min="0" maxlength="100000000"
                     required/><br>
        Quantity <input type="number" name="quantity" placeholder="Quantity" min="0" maxlength="1000000000"
                        required/><br><br><br>
        Images:<br>
        <input type="file" name="pic1" required><br>
        <input type="file" name="pic2" required><br>
        <input type="file" name="pic3" required><br><br><br>
        Subcategory and specifications:<br><br>
        Choose subcategory
        <select id="selectSubCatId" onchange="loadSpecs()" name="subcategory_id" required>
            <option disabled selected value="">Choose Subcategory</option>
            <?php
            foreach ($subcategories as $subcategory) {
                ?>
                <option value="<?= $subcategory['id'] ?>"> <?= $subcategory['name'] ?> </option>
                <?php
            }
            ?>
        </select><br>
        <div id="specsWindow"></div>
        <br><br><br><br>
        <input type="submit" value="Create Product" name="submit">
    </form>
    <a href="products_view.php">
        <button>Back to Products</button>
    </a>
</div>
</body>
</html>
