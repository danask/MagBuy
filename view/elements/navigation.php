<?php
require_once "../../controller/navigation/navigation_controller.php";
require_once "../../controller/cart/cart_navi_controller.php"
?>
<script>
    function addToCart(productId, productPrice) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.status == 200 && this.readyState == 4) {
                var items = document.getElementById("cartItems");
                items.innerHTML = parseInt(items.innerHTML) + 1;
                var price = document.getElementById("cartTotalPrice");
                price.innerHTML = parseInt(price.innerHTML) + productPrice;
            }
        };
        xhttp.open("GET", "../../controller/cart/add_to_cart_controller.php?pid=" + productId, true);
        xhttp.send();
    }
</script>
<div class="header_bg">
    <div class="container">
        <div class="header">
            <div class="head-t">
                <div class="logo">
                    <a href="index.php"><h1>Mag<span>Buy</span></h1></a>
                </div>
                <div class="header_right">
                    <div class="cart box_1">
                        <a href="checkout.html">
                            <div class="total">
                                <div id="cartItems" style="display: inline"><?= $cartItems ?></div>
                                products<br>
                                ($
                                <div id="cartTotalPrice" style="display: inline"><?= $cartTotalPrice ?></div>
                                )
                            </div>
                            <i class="glyphicon glyphicon-shopping-cart"></i></a>

                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <!--start-header-menu-->
            <ul class="megamenu skyblue">
                <li class="grid"><a class="color1" href="index.php">Home</a></li>
                <?php
                foreach ($supercategories as $supercategory) {
                    echo '<li class="grid"><a class="color2" href="#">' . $supercategory["name"] . '</a>';
                    echo '<div class="megapanel">';
                    echo '<div class="row">';
                    foreach ($categories as $category) {
                        if ($category['supercategory_id'] == $supercategory['id']) {
                            echo '<div class="col1">';
                            echo '<div class="h_nav">';
                            echo '<h4>' . $category["name"] . '</h4>';
                            echo '<ul>';
                            foreach ($subcategories as $subcategory) {
                                if ($subcategory['category_id'] == $category['id']) {
                                    echo '<li><a href="product.php?subcid=' . $subcategory["id"] . '">' . $subcategory["name"] . '</a></li>';
                                }
                            }
                            echo '</ul></div></div>';
                        }
                    }
                    echo '</div>';
                    echo '<div class="row">
                            <div class="col2"></div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                        </div>';
                    echo '</div>';
                    echo '</li>';
                }
                ?>
            </ul>
        </div>
    </div>
</div>