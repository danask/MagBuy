<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="../../controller/admin/new_promotion_controller.php" method="post">
    <input type="number" name="percent" placeholder="%"><br>
    <input type="datetime-local" name="start_date" placeholder="Start Date"><br>
    <input type="datetime-local" name="end_date" placeholder="End Date"><br>
    <input type="hidden" name="product_id" value="<?= $_GET['pid'] ?>">
    <input type="submit" name="submit" value="Add promotion!">
</form>
</body>
</html>
