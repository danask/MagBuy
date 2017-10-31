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
                        $counter++;
                        if ($counter > 4) {
                            echo '<div class="clearfix"></div></div>';
                            echo '<div class="products-grid-lft">';
                            $counter = 0;
                        } ?>
                        <div class="products-grd">
                            <div class="p-one simpleCart_shelfItem prd">
                                <a href="single.php?pid=<?= $product['id']; ?>">
                                    <img src="<?= $product['image_url'] ?>"
                                         alt="Product Image" class="img-responsive"/></a>
                                <h4><?= $product['title']; ?></h4>
                                <p><a class="btn btn-default btn-sm"
                                      onclick="addToCart(<?= $product['id'] . "," . $product['price'] ?>)">
                                        <i class="glyphicon glyphicon-shopping-cart"></i>&nbspAdd</a>&nbsp&nbsp<span
                                            class=" item_price valsa">$<?= $product['price']; ?></span></p>
                                <div class="pro-grd">
                                    <a href="single.php?pid=<?= $product['id']; ?>">View</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
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