<?php
require_once "../../../controller/admin/users/view_users_controller.php";

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
    <!-- Add Favicon -->
    <link rel="shortcut icon" href="../../../web/assets/images/favicon.ico?v4" type="image/x-icon">
    <link rel="stylesheet" href="../../../web/assets/css/adminPanel.css">
    <script src="../../../web/assets/js/jquery-1.11.1.min.js"></script>
    <script src="../../../web/assets/js/admin/users.manage.js"></script>
</head>
<body>
<div align="center">
    <h2>Users</h2>
    <p>Here you managa users.</p>
    <a href="../admin_panel.php">
        <button class="btn btn-primary">Back to Admin Panel</button>
    </a>
</div>
<div class="adminMainWindow">
    <table>
        <tr>
            <th>Id</th>
            <th>Email</th>
            <th>Enabled</th>
            <th>Role</th>
        </tr>
        <?php
        foreach ($users as $user) {
            ?>
            <tr>
                <td><?= $user['id'] ?>
                    <a href="user_details.php?uid=<?= $user['id'] ?>">
                        <button class="btn btn-info">View Details</button>
                    </a>
                </td>
                <td><?= $user['email'] ?></td>
                <td>
                    <div id="banId-<?= $user['id'] ?>"><?= ($user['enabled'] == 1 ? "Enabled" : "BANNED") ?></div>
                    <?php
                    if ($user['id'] != 1) {
                        ?>
                        <button class="btn btn-danger" onclick="banUser(<?= $user['id'] ?>)">Ban/Unban</button>
                        <?php
                    }
                    ?>
                </td>
                <td>
                    <div id="roleId-<?= $user['id'] ?>"><?php switch ($user['role']) {
                            case 1:
                                echo "User";
                                break;
                            case 2:
                                echo "Moderator";
                                break;
                            case 3:
                                echo "Admin";
                                break;
                        } ?></div>
                    <?php
                    if ($user['id'] != 1) {
                        ?>
                        <button class="btn btn-warning" onclick="changeRole(<?= $user['id'] ?>)">Make/Unmake Moderator
                        </button>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>
</body>
</html>