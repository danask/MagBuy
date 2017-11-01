<?php
require_once "../../../controller/admin/orders/view_order_details_controller.php";

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
    <script src="../../../web/assets/js/admin/order.manage.js"></script>
</head>
<body>
<div align="center">
    <h2>Order N<?= $userDetails[0]['id'] ?></h2>
    <a href="orders_view.php">
        <button class="btn btn-primary">Back to Orders Panel</button>
    </a>
</div>
<div class="adminMainWindow">
    User: <a href="../users/user_details.php?uid=<?= $userDetails[0]['user_id'] ?>"><?= $userDetails[0]['email'] ?></a><br>
    Status:
    <div id="status" style="display: inline;"><?= $userDetails[0]['status'] ?></div>
    <br>
    Change status:
    <select id="newStatus" onchange="changeStatus(<?= $userDetails[0]['id'] ?>)">
        <option value="1">1 - processing</option>
        <option value="2">2 - sent</option>
        <option value="3">3 - completed</option>
        <option value="4">4 - cancelled</option>
    </select><br>
    Date made: <?= $userDetails[0]['created_at'] ?><br><br>
    <table>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
        </tr>
        <?php
        foreach ($userDetails as $detail) {
            ?>
            <tr>
                <td><a href="../../main/single.php?pid=<?= $detail['product_id'] ?>"><?= $detail['product'] ?></a></td>
                <td><?= $detail['quantity'] ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>
</body>
</html>