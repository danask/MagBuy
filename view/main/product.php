<?php
require_once "../../controller/products/products_by_category_controller.php";
//Include main Headers
require_once "../elements/headers.php";
?>

    <!-- Define Page Name -->
    <title>MagBuy | <?= $product['title'] ?></title>
    </head>

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
                            if ($product['percent'] != null) {
                                $promotedPrice = round($product['price'] - (($product['price'] * $product['percent']) / 100), 2);
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
                            <?php
                        }
                        ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-4 products-grid-right">
                    <div class="w_sidebar">
                        <div class="w_nav1">
                            <h4>All</h4>
                            <ul>
                                <li><a href="product.php">women</a></li>
                                <li><a href="#">new fashions</a></li>
                                <li><a href="#">trends</a></li>
                                <li><a href="#">boys</a></li>
                                <li><a href="#">girls</a></li>
                                <li><a href="#">sale</a></li>
                            </ul>
                        </div>
                        <section class="sky-form">
                            <h4>catogories</h4>
                            <div class="row1 scroll-pane">
                                <div class="col col-4">
                                    <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Men's
                                        Jackets</label>
                                </div>
                                <div class="col col-4">
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Shoes</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Glases</label>
                                    <label class="checkbox"><input type="checkbox"
                                                                   name="checkbox"><i></i>Watches</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Hand
                                        Bags</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Bags</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>shirts</label>
                                    <label class="checkbox"><input type="checkbox"
                                                                   name="checkbox"><i></i>tempore</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>soluta
                                        nobis</label>
                                    <label class="checkbox"><input type="checkbox"
                                                                   name="checkbox"><i></i>molestiae</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>repudiandae
                                        sint</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>nobis
                                        est</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>assumenda
                                        est</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Anouk</label>
                                    <label class="checkbox"><input type="checkbox"
                                                                   name="checkbox"><i></i>tempore</label>
                                </div>
                            </div>
                        </section>
                        <section class="sky-form">
                            <h4>brand</h4>
                            <div class="row1 scroll-pane">
                                <div class="col col-4">
                                    <label class="checkbox"><input type="checkbox" name="checkbox"
                                                                   checked=""><i></i>Lee</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Anouk</label>
                                    <label class="checkbox"><input type="checkbox"
                                                                   name="checkbox"><i></i>tempore</label>
                                </div>
                                <div class="col col-4">
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>vishud</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>amari</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>shree</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Anouk</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>biba</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>shree</label>
                                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Anouk</label>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

<?php
require_once "../elements/footer.php";
?>