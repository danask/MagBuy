<?php
//Include controller to display products
require_once "../../controller/products/home_products_controller.php"
?>

<!doctype html>
<html lang="en">
<head>

    <!-- Add Favicon -->
    <link rel="shortcut icon" href="../../web/assets/images/favicon.ico" type="image/x-icon">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="Nuevo Responsive web template, Bootstrap Web Templates, Flat Web Templates,
    Andriod Compatible web template,Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG,
    SonyErricsson, Motorola web design"/>

    <!-- Bootstrap CSS Library -->
    <link href="../../web/assets/css/bootstrap.css" rel='stylesheet' type='text/css'/>
    <!-- Main site CSS -->
    <link href="../../web/assets/css/style.css" rel='stylesheet' type='text/css'/>
    <!-- Navigation CSS -->
    <link href="../../web/assets/css/megamenu.css" rel="stylesheet" type="text/css" media="all"/>

    <!-- JQuery Library -->
    <script src="../../web/assets/js/jquery-1.11.1.min.js"></script>
    <!-- Navigation JS -->
    <script type="text/javascript" src="../../web/assets/js/megamenu.js"></script>

    <!-- Web fonts -->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,300italic,600,700' rel='stylesheet'
          type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Roboto+Slab:300,400,700' rel='stylesheet' type='text/css'>

    <title>MagBuy Home</title>
</head>
<body>
<?php
//Include Header
require_once "../elements/header.php";
//Include Navigation
require_once "../elements/navigation.php";
?>

<div class="main_filtered_products-section">
    <div class="container">
        <h3 class="title">TOP RATED</h3>
        <div class="main_filtered_product-info">

            <?php foreach ($topRated as $product) { ?>
                <div class="products-grd">
                    <div class="p-one simpleCart_shelfItem prd">
                        <a href="single.php?pid=<?= $product['id']; ?>">
                            <img src="<?= $product['image_url'] ?>"
                                 alt="Product Image" class="img-responsive"/></a>
                        <h4><?= $product['title']; ?></h4>
                        <p><a class="btn btn-default btn-sm"
                              onclick="addToCart(<?= $product['id'] . "," . $product['price'] ?>)">
                                <i class="glyphicon glyphicon-shopping-cart"></i>&nbspAdd
                            </a>&nbsp&nbsp<span
                                    class=" item_price valsa">$<?= $product['price']; ?></span></p>
                        <div class="pro-grd">
                            <a href="single.php?pid=<?= $product['id']; ?>">View</a>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="clearfix"></div>
        </div>
    </div>
</div>

<div class="main_filtered_products-section">
    <div class="container">
        <h3 class="title">MOST RECENT</h3>
        <div class="main_filtered_product-info">

            <?php foreach ($mostRecent as $product) { ?>
                <div class="products-grd">
                    <div class="p-one simpleCart_shelfItem prd">
                        <a href="single.php?pid=<?= $product['id']; ?>">
                            <img src="<?= $product['image_url'] ?>"
                                 alt="Product Image" class="img-responsive"/></a>
                        <h4><?= $product['title']; ?></h4>
                        <p><a class="btn btn-default btn-sm"
                              onclick="addToCart(<?= $product['id'] . "," . $product['price'] ?>)">
                                <i class="glyphicon glyphicon-shopping-cart"></i>&nbspAdd
                            </a>&nbsp&nbsp<span
                                    class=" item_price valsa">$<?= $product['price']; ?></span></p>
                        <div class="pro-grd">
                            <a href="single.php?pid=<?= $product['id']; ?>">View</a>
                        </div>
                    </div>
                </div>

            <?php } ?>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<?php
//Include footer
require_once "../elements/footer.php";
?>
</body>
</html>