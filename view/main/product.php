<?php
require_once "../../controller/products/products_by_category_controller.php";
//Include main Headers
require_once "../elements/headers.php";
?>
    <!-- Define Page Name -->
    <title>MagBuy | <?= $subcatName ?></title>

    <script src="../../web/assets/js/products/products.by.category.js"></script>

    <!-- Price Slider CSS and JS -->
    <link rel="stylesheet" href="../../web/assets/css/jquery-ui.css">
    <script src="../../web/assets/js/jquery-ui.js"></script>
    <script>
        $(function () {
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 4000,
                values: [0, 1500],
                slide: function (event, ui) {
                    $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                    $(window).bind('scroll', function () {
                        onScrollToBottom();
                    });
                    offset = 0;
                    loadProducts(offset);
                }
            });
            $("#amount").val("$" + $("#slider-range").slider("values", 0) +
                " - $" + $("#slider-range").slider("values", 1));
        });
    </script>

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
                            <select class="form-control" id="filter" onchange="filteredProducts()">
                                <option value="1" selected>Newest</option>
                                <option value="2">Most sold</option>
                                <option value="3">Most reviewed</option>
                                <option value="4">Highest rated</option>
                            </select>
                        </div>
                        <section class="sky-form">
                            <h4>Price filter</h4>
                            <p>
                                <label for="amount">Price range:</label>
                                <input type="text" id="amount" readonly
                                       style="border:0; color:#f6931f; font-weight:bold;">
                            </p>

                            <div id="slider-range"></div>
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