<?php
require_once "../../../controller/admin/subcategory_specs/view_subcat_specs_controller.php";

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
    <title>Admin | Categories</title>
    <link rel="stylesheet" href="../../../web/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../web/assets/css/adminPanel.css">
    <!-- Add Favicon -->
    <link rel="shortcut icon" href="../../../web/assets/images/favicon.ico?v4" type="image/x-icon">
    <script src="../../../web/assets/js/jquery-1.11.1.min.js"></script>
    <script src="../../../web/assets/js/admin/remove.admin.js"></script>
</head>
<body>
<div align="center">
    <h2>Subcategory Specifications</h2>
    <p>Here you can add, edit or delete subcategory specifications.</p>
    <a href="../admin_panel.php">
        <button class="btn btn-primary">Back to Admin Panel</button>
    </a>
    <a href="subcat_spec_create.php">
        <button class="btn btn-primary">New Subcategory Specification</button>
    </a>
</div>
<div class="adminMainWindow">
    <table>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Subcategory</th>
            <th>Options</th>
        </tr>
        <?php
        foreach ($specs as $spec) {
            ?>
            <tr id="delId-<?= $spec['id'] ?>">
                <td><?= $spec['id'] ?></td>
                <td><?= $spec['name'] ?></td>
                <td><?= $spec['subcat_name'] ?></td>
                <td>
                    <a href="subcat_spec_edit.php?ssid=<?= $spec['id'] ?>">
                        <button class="btn btn-warning">
                            Edit
                        </button>
                    </a>,
                    <button class="btn btn-danger" onclick="deleteSpec(<?= $spec['id'] ?>)">Delete</button>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>
</body>
</html>