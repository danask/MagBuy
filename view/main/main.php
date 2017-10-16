<?php

//Start Session
session_start();

require_once '../../controller/products/all_products_controller.php';

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="../../web/assets/css/main.css" type="text/css">

    <title>MagBuy</title>

</head>
<body>


<div class="wrap">
    <div class="h-bg">
        <div class="total">
            <div class="header">
                <div class="box_header_user_menu">
                    <?php if (!isset($_SESSION['loggedUser'])) { ?>
                        <ul class="user_menu">
                            <li class=""><a href="">
                                    <div class="button-t"><span><a href="../user/login.php">Log in</a></span></div>
                                </a></li>
                            <li class="last"><a href="">
                                    <div class="button-t"><a href="../user/register.php">Create an Account</a></span>
                                    </div>
                                </a></li>
                        </ul>
                    <?php } else { ?>
                        <ul class="user_menu">
                            <li class="last"><a href="">
                                    <div class="button-t"><a href="../../utility/log_out.php">Log out</a></span></div>
                                </a></li>
                            <li class="last"><a href="">
                                    <div class="button-t"><a href="../user/edit.php">Edit Account</a></span></div>
                                </a></li>
                        </ul>
                    <?php } ?>
                </div>
                <div class="clear"></div>
                <div class="header-bot">
                    <div class="logo">
                        <a href="index.php"><img src="../../web/uploads/magbuy/logo.png" alt=""/></a>
                    </div>
                    <div class="search">
                        <input type="text" class="textbox">
                        <button class="gray-button"><span>Search</span></button>
                    </div>
                    <div class="cart">
                        <?php
                        $productsInCart = 0;
                        if (isset($_SESSION['cart'])) {
                            $cart = explode(";", $_SESSION['cart']);
                            foreach ($cart as $productId) {
                                $productsInCart++;
                            }
                        }
                        echo $productsInCart . " products in your cart";
                        ?>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="menu">
                <div class="top-nav">
                    <ul>
                        <li class="active"><a href="index.php">Products</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="banner-top">
                <div class="header-bottom">
                    <div class="header_bottom_right_images">
                        <div class="content-wrapper">
                            <div class="content-top">
                                <div class="text">
                                    <?php foreach ($products as $product) { ?>

                                        <div class="grid_1_of_3 images_1_of_3">
                                            <div class="grid_1">
                                                <a href="single.html"><img src="<?= $product['image_url'] ?>"
                                                                           title="continue reading" alt=""></a>
                                                <div class="grid_desc">
                                                    <p class="title"><?= $product['title'] ?></p>
                                                    <p class="title1"><?= $product['description'] ?></p>
                                                    <div class="price" style="height: 19px;">
                                                        <span class="reducedfrom">$<?= $product['price'] ?></span>
                                                    </div>
                                                    <div class="cart-button">
                                                        <div class="cart">
                                                            <a href="../../controller/cart/add_to_cart_controller.php?pid=<?= $product['id']; ?>"><img
                                                                        src="../../web/uploads/magbuy/cart.png" alt=""/></a>
                                                        </div>
                                                        <button class="button"><span>Details</span></button>
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="footer-bottom">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>
