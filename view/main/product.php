<?php
//Include products by category controller
require_once "../../controller/products/products_by_category_controller.php";
//Include main Headers
require_once "../elements/headers.php";
?>

    <!-- Define Page Name -->
    <title>MagBuy | <?= $categoryName ?></title>

<?php
//Include Header
require_once "../elements/header.php";
//Include Navigation
require_once "../elements/navigation.php";
?>

    <!-- Products by category -->
    <div class="products">
        <div class="container">
            <div class="products-grids">
                <div class="col-md-8 products-grid-left">
                    <div class="products-grid-lft">
                        <?php
                        $counter = 0;
                        foreach ($products as $product) {
                            if ($product['percent'] != null && $product['start_date'] < date("Y-m-d H:i:s")
                                && $product['end_date'] > date("Y-m-d H:i:s")
                            ) {
                                $promotedPrice = round($product['price'] - (($product['price'] * $product['percent']) / 100), 2);
                            } else {
                                unset($promotedPrice);
                            }
                            $counter++;
                            if ($counter > 3) {
                                echo '<div class="clearfix"></div>
                </div>';
                                echo '<div class="products-grid-lft">';
                                $counter = 0;
                            }
                            ?>
                            <div class="products-grd">
                                <div class="p-one simpleCart_shelfItem prd">
                                    <a href="single.php?pid=<?= $product['id']; ?>">
                                        <img src="<?= $product['image_url'] ?>"
                                             alt="Product Image" class="img-responsive"/>
                                    </a>
                                    <h4><?= $product['title']; ?></h4>
                                    <p><a class="btn btn-default btn-sm"
                                          onclick="addToCart(<?= $product['id'] . "," . (isset($promotedPrice) ? $promotedPrice : $product['price']) ?>)">
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
                            <?php
                        }
                        ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-4 products-grid-right">
                    <div class="w_sidebar">
                        <div class="w_nav1">
                            <h4>Filters</h4>
                            <ul>
                                <li>
                                    <button>Most/least sold</button>
                                </li>
                                <li>
                                    <button>Most/least reviewed</button>
                                </li>
                                <li>
                                    <button>Date added</button>
                                </li>
                                <li>
                                    <button>Highest/lowest rated</button>
                                </li>
                            </ul>
                        </div>
                        <section class="sky-form">
                            <h4>Price filter</h4>
                            <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
                            <div id="slider-range"></div>
                        </section>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

<?php
//Include Footer
require_once "../elements/footer.php";
?>