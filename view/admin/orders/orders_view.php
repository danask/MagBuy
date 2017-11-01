<?php
require_once "../../../controller/admin/orders/view_orders_controller.php";

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
</head>
<body>
<div align="center">
    <h2>Orders</h2>
    <p>Here you can manage orders.</p>
    <a href="../admin_panel.php">
        <button class="btn btn-primary">Back to Admin Panel</button>
    </a>
</div>
<div class="adminMainWindow">
    <table>
        <tr>
            <th>Id</th>
            <th>User</th>
            <th>Date made</th>
            <th>Status</th>
            <th>Options</th>
        </tr>
        <?php
        foreach ($orders as $order) {
            ?>
            <tr>
                <td><?= $order['id'] ?></td>
                <td><?= $order['email'] ?></td>
                <td><?= $order['created_at'] ?></td>
                <td><?= $order['status'] ?></td>
                <td>
                    <a href="order_details.php?oid=<?= $order['id'] ?>">
                        <button class="btn btn-warning">
                            Details
                        </button>
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