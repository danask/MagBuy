<?php
//Include products by category controller
require_once "../../controller/products/products_by_category_controller.php";
//Include main Headers
require_once "../elements/headers.php";
?>

    <!-- Define Page Name -->
    <title>MagBuy | <?= $categoryName ?></title>
    <script src="../../web/assets/js/products/product.infinite.scroll.js"></script>
<?php
//Include Header
require_once "../elements/header.php";
//Include Navigation
require_once "../elements/navigation.php";
?>

    <!-- Products by category -->
    <div class="products" onload="loadFirstProducts()">
        <div class="container">
            <div class="products-grids">
                <div class="col-md-8 products-grid-left" id="productsWindow">
                </div>
                <div id="loader"></div>
                <div class="col-md-4 products-grid-right">
                    <div class="w_sidebar">
                        <div class="w_nav1">
                            <h4>Filters</h4>
                            <ul>
                                <li>
                                    Most sold
                                    <input id="mostSoldFilter" type="checkbox" onclick="filterProducts()">
                                </li>
                                <li>
                                    Most reviewed
                                    <input id="mostReviewedFilter" type="checkbox" onclick="filterProducts()">
                                </li>
                                <li>
                                    Newest
                                    <input id="newestFilter" type="checkbox" onclick="filterProducts()">
                                </li>
                                <li>
                                    Highest rated
                                    <input id="highestRatedFilter" type="checkbox" onclick="filterProducts()">
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