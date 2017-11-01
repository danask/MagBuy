<?php
require_once "../../../controller/admin/users/view_user_details_controller.php";

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
    <title>Admin | Users</title>
    <link rel="stylesheet" href="../../../web/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../web/assets/css/adminPanel.css">
    <script src="../../../web/assets/js/jquery-1.11.1.min.js"></script>
    <script src="../../../web/assets/js/admin/order.manage.js"></script>
</head>
<body>
<div align="center">
    <h2>User ID <?= $userDetails['id'] ?></h2>
    <?php if ($_SESSION['role'] == 3) { ?>
    <a href="users_view.php">
        <button class="btn btn-primary">Back to Users Panel</button>
    </a>
    <?php } elseif ($_SESSION['role'] == 2) {?>
    <a href="../orders/orders_view.php">
        <button class="btn btn-primary">Back to Orders</button>
    </a>
    <?php } ?>

</div>
<div class="adminMainWindow">
    <img src="../<?= $userDetails['image_url'] ?>"><br>
    Email: <?= $userDetails['email'] ?><br>
    First Name: <?= $userDetails['first_name'] ?><br>
    Last Name: <?= $userDetails['last_name'] ?><br>
    Mobile phone: <?= $userDetails['mobile_phone'] ?><br>
    Last login: <?= $userDetails['last_login'] ?><br><br>
    <h3>Orders:</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Date made</th>
            <th>Status</th>
        </tr>
        <?php
        foreach ($userOrders as $order) {
            ?>
            <tr>
                <td><?= $order['id'] ?>
                    <a href="../orders/order_details.php?oid=<?= $order['id'] ?>">
                        <button class="btn btn-info">View Order</button>
                    </a>
                </td>
                <td><?= $order['created_at'] ?></td>
                <td><?= $order['status'] ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>
</body>
</html>