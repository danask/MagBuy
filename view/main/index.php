<?php
//Include controller to display products
require_once "../../controller/products/home_products_controller.php";

//Include Header
require_once "../elements/header.php";
//Include Navigation
require_once "../elements/navigation.php";
?>

<!-- Top Rated Products -->
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

<!-- Most Recent Products -->
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