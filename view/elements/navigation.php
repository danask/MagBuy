<?php
//Include navigation controller for Megamenu
require_once "../../controller/navigation/navigation_controller.php";
//Include cart controller for cart field
require_once "../../controller/cart/cart_navi_controller.php"
?>

<!-- Header Div -->
<div id="header_bg">
    <div class="container">
        <div class="head-t">

            <!-- Logo -->
            <div class="logo">
                <a href="index.php"><h1>Mag<span>Buy</span></h1></a>
            </div>

            <!-- Favourites button -->
            <div class="header_right">
                <?php if (isset($_SESSION['loggedUser'])) { ?>
                    <a href="../main/favourites.php">
                        <button class="btn btn-primary btn-info" id='favouritesButton'><span
                                    class="glyphicon glyphicon-heart"></span> Favourites
                        </button>
                    </a>&nbsp&nbsp&nbsp&nbsp
                <?php } else { ?>
                    <div class="btn btn-primary btn-info" id='invisible'><span
                                class="glyphicon glyphicon-heart"></span>
                    </div>&nbsp&nbsp&nbsp&nbsp
                <?php } ?>

                <!-- Cart page button -->
                <div id="cartToHover" class="cart box_1">
                    <a href="checkout.php">
                        <div class="total">$
                            <div id="cartTotalPrice"><?= $cartTotalPrice ?></div>
                            <br>(
                            <div id="cartItems"><?= $cartItems ?></div>
                            items )
                        </div>
                        <i class="glyphicon glyphicon-shopping-cart"></i></a>

                    <div class="clearfix"></div>
                </div>
                <div id="cartDivHover"></div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!-- Navigation panel -->
        <ul class="megamenu skyblue">
            <li class="grid"><a class="color1" href="index.php">Home</a></li>
            <?php foreach ($supercategories as $supercategory) { ?>
                <li class="grid"><a class="color2" href="#"><?= $supercategory["name"] ?></a>
                    <div class="megapanel">
                        <div class="row">
                            <?php foreach ($categories as $category) {
                                if ($category['supercategory_id'] == $supercategory['id']) { ?>
                                    <div class="col1">
                                        <div class="h_nav">
                                            <h4><?= $category["name"] ?></h4>
                                            <ul>
                                                <?php foreach ($subcategories as $subcategory) {
                                                    if ($subcategory['category_id'] == $category['id']) { ?>
                                                        <li>
                                                            <a href="product.php?subcid=<?= $subcategory["id"] ?>">
                                                                <?= $subcategory["name"] ?></a>
                                                        </li>
                                                    <?php }
                                                } ?>
                                            </ul>
                                        </div>
                                    </div>
                                <?php }
                            } ?>
                        </div>
                        <div class="row">
                            <div class="col2"></div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>