<?php
require_once "../../../controller/admin/categories/view_categories_controller.php";
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
<h2>Categories</h2>
<p>Here you can add, edit or delete categories.</p>
<a href="categories_create.php">
    <button class="btn btn-primary">New Category</button>
</a>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Supercategory</th>
        <th>Options</th>
    </tr>
    <?php
    foreach ($cats as $cat) {
        ?>
        <tr id="delId-<?= $cat['id'] ?>">
            <td><?= $cat['id'] ?></td>
            <td><?= $cat['name'] ?></td>
            <td><?= $cat['supercatname'] ?></td>
            <td>
                <a href="categories_edit.php?cid=<?= $cat['id'] ?>">
                    Edit
                </a>,
                <button onclick="deleteCat(<?= $cat['id'] ?>)">Delete</button>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
<a href="../admin_panel.php">
    <button class="btn btn-primary">Back to Admin Panel</button>
</a>
</body>
</html>