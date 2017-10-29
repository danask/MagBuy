<?php
require_once "../../controller/products/products_by_category_controller.php";
//Include main Headers
require_once "../elements/headers.php";
?>
    <!-- Define Page Name -->
    <title>MagBuy | <?= $subcatName ?></title>
    <script src="../../web/assets/js/products/products.by.category.js"></script>
    <script src="../../web/assets/js/products/price.range.js"></script>
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
                <div class="col-md-4 products-grid-right">
                    <div class="w_sidebar">
                        <div class="w_nav1">
                            <h4>Filters</h4>
                            Order by:
                            <select id="filter" onchange="filteredProducts()">
                                <option value="1" selected>Newest</option>
                                <option value="2">Most sold</option>
                                <option value="3">Most reviewed</option>
                                <option value="4">Highest rated</option>
                            </select>
                        </div>
                        <section class="sky-form">
                            <h4>Price filter</h4>

                        </section>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12 products-grid-left" id="productsWindow">
                </div>
                <div id="loader" style="display: block" class="center-block"></div>
            </div>
        </div>
    </div>

<?php
//Include Footer
require_once "../elements/footer.php";
?>