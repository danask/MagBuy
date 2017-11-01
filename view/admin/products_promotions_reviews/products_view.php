<?php
require_once "../../../controller/admin/products_promotions_reviews/view_products_controller.php";
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
    <title>Admin | Categories</title>
    <link rel="stylesheet" href="../../../web/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../web/assets/css/adminPanel.css">
    <script src="../../../web/assets/js/jquery-1.11.1.min.js"></script>
    <script src="../../../web/assets/js/admin/remove.admin.js"></script>
</head>
<body>
<div align="center">
    <h2>Products</h2>
    <p>Here you can add, edit or delete products.</p>
    <a href="../admin_panel.php">
        <button class="btn btn-primary">Back to Admin Panel</button>
    </a>
    <a href="product_create.php">
        <button class="btn btn-primary">New Product</button>
    </a>
</div>
<div class="adminMainWindow">
    <table>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Visible</th>
            <th>Created_at</th>
            <th>Subcat Name</th>
            <th>Options</th>
        </tr>
        <?php
        foreach ($products as $product) {
            ?>
            <tr>
                <td><?= $product['id'] ?></td>
                <td><a href="../../../view/main/single.php?pid=<?= $product['id'] ?>"><?= $product['title'] ?></a></td>
                <td style="font-size: 80%"><?= $product['description'] ?></td>
                <td><?= $product['price'] ?></td>
                <td><?= $product['quantity'] ?></td>
                <td id="togId-<?= $product['id'] ?>"><?= $product['visible'] ?></td>
                <td><?= $product['created_at'] ?></td>
                <td><?= $product['subcat_name'] ?></td>
                <td>
                    <a href="product_edit.php?pid=<?= $product['id'] ?>">
                        <button class="btn btn-warning">
                            Edit
                        </button>
                    </a>
                    <button class="btn btn-danger"
                            onclick="toggleVisibility(<?= $product['id'] . ", " . $product['visible'] ?>)">Toggle
                        visibility
                    </button>
                    <a href="promotions_product_view.php?pid=<?= $product['id'] ?>">
                        <button class="btn btn-success">Promotions</button>
                    </a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>
</body>
</html>