<?php
require_once "../../../controller/admin/supercategories/view_supercategories_controller.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin | Supercategories</title>
    <link rel="stylesheet" href="../../../web/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../web/assets/css/adminPanel.css">
    <script src="../../../web/assets/js/jquery-1.11.1.min.js"></script>
    <script>
        function deleteSuperCat(superCatId) {
            if (confirm("Are you sure you want to delete SuperCategory with ID " + superCatId + " ?")) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.status == 200 && this.readyState == 4) {
                        $('#delId-' + superCatId).remove();
                    }
                };
                xhttp.open("GET", "../../../controller/admin/supercategories/delete_supercategory_controller.php?scid=" + superCatId, true);
                xhttp.send();
            }
        }
    </script>
</head>
<body>
<h2>Supercategories</h2>
<p>Here you can add, edit or delete supercategories.</p>
<a href="supercategories_create.php">
    <button class="btn btn-primary">New Supercategory</button>
</a>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Options</th>
    </tr>
    <?php
    foreach ($superCats as $superCat) {
        ?>
        <tr id="delId-<?= $superCat['id'] ?>">
            <td><?= $superCat['id'] ?></td>
            <td><?= $superCat['name'] ?></td>
            <td>
                <a href="supercategories_edit.php?scid=<?= $superCat['id'] ?>">
                    Edit
                </a>,
                <button onclick="deleteSuperCat(<?= $superCat['id'] ?>)">Delete</button>
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