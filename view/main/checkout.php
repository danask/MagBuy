<?php
//Include Error Handler
require_once '../../utility/error_handler.php';
//Include controller to show products in cart
require_once "../../controller/cart/show_cart_controller.php";
//Include main Headers
require_once "../elements/headers.php";
?>

    <!-- CSS for Cart  -->
    <link rel="stylesheet" href="../../web/assets/css/cart.css">

    <!-- Script for removing product from cart -->
    <script type="text/javascript" src="../../web/assets/js/cart/remove.cart.js"></script>

    <!-- Script for controlling cart quantity -->
    <script type="text/javascript" src="../../web/assets/js/cart/quantity.cart.js"></script>

    <!-- Define Page Name -->
    <title>MagBuy | Cart</title>

<?php
//Include Header
require_once "../elements/header.php";
//Include Navigation
require_once "../elements/navigation.php";
?>

    <!-- Show Total product price and checkout -->
    <div class="cart-items">
        <div class="container">
            <h3 class="title">My shopping(
                <div id="cartItems2"><?= ($orderSuccessful === 1 ? $orderQuantity : $cartItems) ?></div>
                )
            </h3>
            <br>
            <h3 class="b-tittle" id='totalPrice'>Price Total:
                <div id="totalPriceCurrency">$
                    <div id="cartTotalPrice2">
                        <?= ($orderSuccessful === 1 ? $orderTotalPrice : $cartTotalPrice) ?></div>
                </div>
            </h3>
            <br>
            <?php
            if ($cartIsEmpty === 0) {
                ?>
                <a href="../../controller/cart/new_order_controller.php">
                    <button class="btn btn-danger btn-lg btn-block" id="checkOutButton">Checkout</button>
                </a>

                <!-- Show products in cart -->
                <?php foreach ($cart as $cartProduct) { ?>
                    <div id="product-<?= $cartProduct->getId() ?>">
                        <div class="cart-header">
                            <div id="button-<?= $cartProduct->getId() ?>" class="close1"
                                 onclick="removeFromCart(<?= $cartProduct->getId() . "," . $cartProduct->getPrice() ?>)"></div>
                            <div class="cart-sec simpleCart_shelfItem">
                                <div class="cart-item cyc">
                                    <a href="single.php?pid=<?= $cartProduct->getId() ?>"><img
                                                src="<?= $cartProduct->getImage() ?>" class="img-responsive" alt=""></a>
                                </div>
                                <div class="cart-item-info">
                                    <h3>
                                        <a href="single.php?pid=<?= $cartProduct->getId() ?>">
                                            <?= $cartProduct->getTitle() ?>
                                        </a>
                                    </h3>
                                    <p><div id="quantityText">Quantity:<span id="quantityNumber">
                                            <span id="product-<?= $cartProduct->getId() ?>-quantity">
                                        <?= $cartProduct->getQuantity() ?>
                                    </span></span></div>
                                        <button class="btn btn-xs btn-info glyphicon glyphicon-minus"
                                                onclick="removeOneQuantityFromCart
                                                (<?= $cartProduct->getId()
                                        . "," . $cartProduct->getPrice() ?>)"></button>

                                    <button class="btn btn-xs btn-info glyphicon glyphicon-plus"
                                            onclick="addOneQuantityToCart
                                            (<?= $cartProduct->getId()
                                    . "," . $cartProduct->getPrice() ?>)"></button>
                                    </p>
                                    <div class="delivery">
                                        <p>$
                                        <div id="product-<?= $cartProduct->getId() ?>-totalPrice">
                                            <?= $cartProduct->getPrice() * $cartProduct->getQuantity() ?>
                                        </div>
                                        </p><br>
                                        <p>Single price: $<?= $cartProduct->getPrice() ?></p>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                <?php }
            } elseif ($cartIsEmpty === 1 && $orderSuccessful === 0) { ?>
                <h3 align="center">Your cart is empty!</h3><br>
                <?php
            } elseif ($orderSuccessful === 1) {
                ?>
                <h3 align="center">Your order was successful! Your order number is <?= $orderNumber ?>.
                    Expect a call from us within 24 hours.</h3><br>
                <?php
            }
            ?>
            <a href="index.php">
                <button class="btn btn-success btn-lg btn-block">Continue shopping</button>
            </a>
        </div>
    </div>

<?php
//Include Footer
require_once "../elements/footer.php";
?>