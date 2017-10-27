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
<h3>images</h3>
<form action="../../../controller/admin/products_promotions_reviews/new_product_images_controller.php" method="post" enctype="multipart/form-data">

    <input type="hidden" name="product_id" value="<?= $_GET['pid']; ?>">
    <input type="submit" value="Create product!" name="submit">
</form>
</body>
</html>
