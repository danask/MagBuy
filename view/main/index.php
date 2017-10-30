<?php
//Include controller to display products
require_once "../../controller/products/home_products_controller.php";
//Include main Headers
require_once "../elements/headers.php";
?>

    <!-- Define Page Name -->
    <title>MagBuy | Home</title>

<?php
//Include Header
require_once "../elements/header.php";
//Include Navigation
require_once "../elements/navigation.php";
?>
    <!-- Most Sold Products -->
    <div class="main_filtered_products-section">
        <div class="container">
            <h3 class="title">Most Sold</h3>
            <div class="main_filtered_product-info">

                <?php foreach ($mostSold as $product) {
                    if ($product['percent'] != null && $product['start_date'] < date("Y-m-d H:i:s")
                        && $product['end_date'] > date("Y-m-d H:i:s")
                    ) {
                        $promotedPrice = round($product['price'] - (($product['price'] *
                                    $product['percent']) / 100), 2);
                    } else {
                        unset($promotedPrice);
                    } ?>
                    <div class="products-grd" id='hideUnder1200'>
                        <div class="p-one">
                            <a href="single.php?pid=<?= $product['id']; ?>">
                                <img src="<?= $product['image_url'] ?>"
                                     alt="Product Image" class="img-responsive"/></a>
                            <h4><?= $product['title']; ?></h4>
                            <p><a class="btn btn-default btn-sm"
                                  onclick="addToCart(<?= $product['id'] . "," . $product['price'] ?>)">
                                    <i class="glyphicon glyphicon-shopping-cart"></i>&nbspAdd
                                </a>&nbsp&nbsp
                                <?php
                                if (isset($promotedPrice)) {
                                    ?>
                                    <span class="item_price valsa"
                                          style="color: red;">$<?= $promotedPrice; ?></span>
                                    <span class="item_price promoValsa">$<?= $product['price']; ?></span>
                                    <?php
                                } else {
                                    ?>
                                    <span class="item_price valsa">$<?= $product['price']; ?></span>
                                    <?php
                                }
                                ?></p>
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

    <!-- Top Rated Products -->
    <div class="main_filtered_products-section">
        <div class="container">
            <h3 class="title">TOP RATED</h3>
            <div class="main_filtered_product-info">

                <?php foreach ($topRated as $product) {
                    if ($product['percent'] != null && $product['start_date'] < date("Y-m-d H:i:s")
                        && $product['end_date'] > date("Y-m-d H:i:s")
                    ) {
                        $promotedPrice = round($product['price'] - (($product['price'] *
                                    $product['percent']) / 100), 2);
                    } else {
                        unset($promotedPrice);
                    } ?>
                    <div class="products-grd" id='hideUnder1200'>
                        <div class="p-one simpleCart_shelfItem prd">
                            <a href="single.php?pid=<?= $product['id']; ?>">
                                <img src="<?= $product['image_url'] ?>"
                                     alt="Product Image" class="img-responsive"/></a>
                            <h4><?= $product['title']; ?></h4>
                            <p><a class="btn btn-default btn-sm"
                                  onclick="addToCart(<?= $product['id'] . "," . $product['price'] ?>)">
                                    <i class="glyphicon glyphicon-shopping-cart"></i>&nbspAdd
                                </a>&nbsp&nbsp
                                <?php
                                if (isset($promotedPrice)) {
                                    ?>
                                    <span class="item_price valsa"
                                          style="color: red;">$<?= $promotedPrice; ?></span>
                                    <span class="item_price promoValsa">$<?= $product['price']; ?></span>
                                    <?php
                                } else {
                                    ?>
                                    <span class="item_price valsa">$<?= $product['price']; ?></span>
                                    <?php
                                }
                                ?></p>
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

                <?php foreach ($mostRecent as $product) {
                    if ($product['percent'] != null && $product['start_date'] < date("Y-m-d H:i:s")
                        && $product['end_date'] > date("Y-m-d H:i:s")
                    ) {
                        $promotedPrice = round($product['price'] - (($product['price'] *
                                    $product['percent']) / 100), 2);
                    } else {
                        unset($promotedPrice);
                    }
                    ?>
                    <div class="products-grd" id='hideUnder1200'>
                        <div class="p-one simpleCart_shelfItem prd" >
                            <a href="single.php?pid=<?= $product['id']; ?>">
                                <img src="<?= $product['image_url'] ?>"
                                     alt="Product Image" class="img-responsive"/></a>
                            <h4><?= $product['title']; ?></h4>
                            <p><a class="btn btn-default btn-sm"
                                  onclick="addToCart(<?= $product['id'] . "," . $product['price'] ?>)">
                                    <i class="glyphicon glyphicon-shopping-cart"></i>&nbspAdd
                                </a>&nbsp&nbsp
                                <?php
                                if (isset($promotedPrice)) {
                                    ?>
                                    <span class="item_price valsa"
                                          style="color: red;">$<?= $promotedPrice; ?></span>
                                    <span class="item_price promoValsa">$<?= $product['price']; ?></span>
                                    <?php
                                } else {
                                    ?>
                                    <span class="item_price valsa">$<?= $product['price']; ?></span>
                                    <?php
                                }
                                ?></p>
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