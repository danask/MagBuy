<?php
require_once "../../controller/cart/show_cart_controller.php"
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>MagBuy Cart</title>
    <link rel="shortcut icon" href="../../web/assets/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../../web/assets/images/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="Nuevo Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design"/>
    <script type="applijegleryion/x-javascript">
         addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }







    </script>
    <link href="../../web/assets/css/bootstrap.css" rel='stylesheet' type='text/css'/>
    <!-- Custom Theme files -->
    <link href="../../web/assets/css/style.css" rel='stylesheet' type='text/css'/>
    <script src="../../web/assets/js/jquery-1.11.1.min.js"></script>
    <!-- start menu -->
    <link href="../../web/assets/css/megaMenu.css" rel="stylesheet" type="text/css" media="all"/>
    <script type="text/javascript" src="../../web/assets/js/mega.menu.js"></script>
    <script>$(document).ready(function () {
            $(".megamenu").megamenu();
        });</script>
    <script src="../../web/assets/js/menu_jquery.js"></script>
    <script src="../../web/assets/js/simpleCart.min.js"></script>
    <!--web-fonts-->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,300italic,600,700' rel='stylesheet'
          type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Roboto+Slab:300,400,700' rel='stylesheet' type='text/css'>
    <!--//web-fonts-->
    <script src="../../web/assets/js/modernizr.custom.js"></script>
    <script type="text/javascript" src="../../web/assets/js/move-top.js"></script>
    <script type="text/javascript" src="../../web/assets/js/easing.js"></script>
    <!--/script-->
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();
                $('html,body').animate({scrollTop: $(this.hash).offset().top}, 900);
            });
        });
    </script>
    <script>
        function removeFromCart(productId, productPrice, productQuantity) {
            $('#button-' + productId).remove();
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.status == 200 && this.readyState == 4) {
                    var items = document.getElementById("cartItems");
                    items.innerHTML = parseInt(items.innerHTML) - productQuantity;
                    var price = document.getElementById("cartTotalPrice");
                    price.innerHTML = (parseFloat(price.innerHTML) - (productPrice * productQuantity)).toFixed(2);
                    var items2 = document.getElementById("cartItems2");
                    items2.innerHTML = parseInt(items2.innerHTML) - productQuantity;
                    var price2 = document.getElementById("cartTotalPrice2");
                    price2.innerHTML = (parseFloat(price2.innerHTML) - (productPrice * productQuantity)).toFixed(2);

                    $('#product-' + productId).remove();

                }
            };
            xhttp.open("GET", "../../controller/cart/remove_from_cart_controller.php?pid=" + productId, true);
            xhttp.send();
        }
    </script>
</head>
<body>
<?php
require_once "../elements/header.php";
require_once "../elements/navigation.php";
?>
<!--start-content-->
<!-- checkout -->
<div class="cart-items">
    <div class="container">
        <h3 class="title">My shopping(
            <div id="cartItems2" style="display: inline"><?= $cartItems ?></div>
            )
        </h3>
        <br>
        <h3 class="b-tittle" style="text-align: center">Price Total:
            <div style="color: red">$
                <div id="cartTotalPrice2" style="display: inline;">
                    <?= $cartTotalPrice ?>
                </div>
            </div>
        </h3>
        <br>
        <a href="../../controller/cart/new_order_controller.php">
            <button class="btn btn-danger btn-lg btn-block" style="margin: 0 auto 0 auto; display: block">Checkout
            </button>
        </a>
        <?php
        foreach ($cart as $cartProduct) {
            ?>
            <div id="product-<?= $cartProduct->getId() ?>">
                <div class="cart-header">
                    <div id="button-<?= $cartProduct->getId() ?>" class="close1"
                         onclick="removeFromCart(<?= $cartProduct->getId() . "," . $cartProduct->getPrice() . "," . $cartProduct->getQuantity() ?>)"></div>
                    <div class="cart-sec simpleCart_shelfItem">
                        <div class="cart-item cyc">
                            <a href="single.php?pid=<?= $cartProduct->getId() ?>"><img
                                        src="<?= $cartProduct->getImage() ?>" class="img-responsive" alt=""></a>
                        </div>
                        <div class="cart-item-info">
                            <h3>
                                <a href="single.php?pid=<?= $cartProduct->getId() ?>"> <?= $cartProduct->getTitle() ?> </a>
                            </h3>
                            <ul class="qty">
                                <li><p>Quantity: <?= $cartProduct->getQuantity() ?></p></li>
                                <li><p>FREE delivery</p></li>
                            </ul>
                            <div class="delivery">
                                <p>$<?= $cartProduct->getPrice() * $cartProduct->getQuantity() ?></p><br>
                                <p>Single price: $<?= $cartProduct->getPrice() ?></p>
                                <span>Delivered in 2 days</span>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<!--//checkout-->
<!--start-bottom-->
<?php
require_once "../elements/footer.php";
?>
<!--end-footer-->
<!--//end-content-->
<!--start-smooth-scrolling-->
<script type="text/javascript">
    $(document).ready(function () {
        /*
         var defaults = {
         containerID: 'toTop', // fading element id
         containerHoverID: 'toTopHover', // fading element hover id
         scrollSpeed: 1200,
         easingType: 'linear'
         };
         */

        $().UItoTop({easingType: 'easeOutQuart'});

    });
</script>
<a href="#home" id="toTop" class="scroll" style="display: block;"> <span id="toTopHover"
                                                                         style="opacity: 1;"> </span></a>


</body>
</html>