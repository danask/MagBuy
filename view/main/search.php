<?php
//Include controller to show all results
require_once "../../controller/search/search_controller.php";
//Include main Headers
require_once "../elements/headers.php";
?>

    <!-- Define Page Name -->
    <title>MagBuy | Search Results></title>
    </head>

<?php
//Include Header
require_once "../elements/header.php";
//Include Navigation
require_once "../elements/navigation.php";
?>

    <!-- Search result products grid -->
    <div class="products">
        <div class="container">
            <div class="products-grids">
                <?php if (count($result)) {
                    $counter = 0;
                    foreach ($result as $product) {
                        if ($product['percent'] != null) {
                            $promotedPrice = round($product['price'] - (($product['price'] *
                                        $product['percent']) / 100), 2);
                        } else {
                            unset($promotedPrice);
                        } ?>
                        <div class="products-grd" id='responsiveProductsDiv'>
                            <div class="p-one">
                                <a href="single.php?pid=<?= $product['id']; ?>">
                                    <img src="<?= $product['image_url'] ?>"
                                         alt="Product Image" class="img-responsive"/></a>
                                <h4><?= $product['title']; ?></h4>

                                <?php if ($product['average'] === null) {
                                    $product['average'] = 0;
                                } else {
                                    $product['average'] = round($product['average'], 0);
                                } ?>

                                <img class="ratingCatDiv media-object img"
                                     src="../../web/assets/images/rating<?= $product['average'] ?>.png">
                                <span>(<?= $product['reviewsCount'] ?>)</span>
                                <br/><br/>
                                <p><a id="addButtonBlock" class="btn btn-default btn-sm"
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
                                    ?></p><br/>
                                <div class="pro-grd">
                                    <a href="single.php?pid=<?= $product['id']; ?>">View</a>
                                </div>
                            </div>
                        </div>
                        <?php }
                } else {
                    echo "<h3 class='title'>NO RESULTS FOUND</h3>";
                } ?>
            </div>
        </div>
    </div>

<?php
//Include Footer
require_once "../elements/footer.php";
?>