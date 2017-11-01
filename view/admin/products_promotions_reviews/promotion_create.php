<?php
//Include Admin check
require_once '../../../utility/admin_mod_session.php';

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
</head>
<body>
<div class="page">
    <form action="../../../controller/admin/products_promotions_reviews/new_product_promotion_controller.php"
          method="post">
        Percent <input type="number" name="percent" placeholder="%" required><br>
        Start <input type="datetime-local" name="start_date" placeholder="Start Date" required><br>
        End <input type="datetime-local" name="end_date" placeholder="End Date" required><br>
        <input type="hidden" name="product_id" value="<?= $_GET['pid'] ?>">
        <input type="submit" name="submit" value="Add promotion!">
    </form>
    <a href="promotions_product_view.php?pid=<?= $_GET['pid'] ?>">
        <button>Back to Promotions</button>
    </a>
</div>
</body>
</html>
