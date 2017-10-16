<?php
require_once "../../controller/products/products_by_category_controller.php";
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Nuevo Shop a Ecommerce Online Shopping Flat Bootstarp Resposive Website Template | Products ::
        w3layouts</title>
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
    <link href="../../web/assets/css/megamenu.css" rel="stylesheet" type="text/css" media="all"/>
    <script type="text/javascript" src="../../web/assets/js/megamenu.js"></script>
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
    <script src="../../web/assets/js/scripts.js" type="text/javascript"></script>
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
    <!-- the jScrollPane script -->
    <script type="text/javascript" src="../../web/assets/js/jquery.jscrollpane.min.js"></script>
    <script type="text/javascript" id="sourcecode">
        $(function () {
            $('.scroll-pane').jScrollPane();
        });
    </script>
    <!-- //the jScrollPane script -->
</head>
<body>
<?php
require_once "head.php";
require_once "navigation.php";
?>
<!--start-content-->
<!--products-->
<div class="products">
    <div class="container">
        <div class="products-grids">
            <div class="col-md-8 products-grid-left">
                <div class="products-grid-lft">
                    <?php
                    $counter = 0;
                    foreach ($products as $product) {
                        $counter++;
                        if ($counter > 3) {
                            echo '<div class="clearfix"></div>
                </div>';
                            echo '<div class="products-grid-lft">';
                            $counter = 0;
                        }
                        ?>
                        <div class="products-grd">
                            <div class="p-one simpleCart_shelfItem prd">
                                <a href="single.php?pid=<?= $product['id']; ?>">
                                    <img src="../../web/assets/images/p7.jpg" alt="" class="img-responsive"/>
                                </a>
                                <h4><?= $product['title']; ?></h4>
                                <p><a class="item_add" href="#"><i class="glyphicon glyphicon-shopping-cart"></i>
                                        <span
                                                class=" item_price valsa">$<?= $product['price']; ?></span></a></p>
                                <div class="pro-grd">
                                    <a href="single.php?pid=<?= $product['id']; ?>">Quick View</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-4 products-grid-right">
                <div class="w_sidebar">
                    <div class="w_nav1">
                        <h4>All</h4>
                        <ul>
                            <li><a href="product.php">women</a></li>
                            <li><a href="#">new fashions</a></li>
                            <li><a href="#">trends</a></li>
                            <li><a href="#">boys</a></li>
                            <li><a href="#">girls</a></li>
                            <li><a href="#">sale</a></li>
                        </ul>
                    </div>
                    <section class="sky-form">
                        <h4>catogories</h4>
                        <div class="row1 scroll-pane">
                            <div class="col col-4">
                                <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Men's
                                    Jackets</label>
                            </div>
                            <div class="col col-4">
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Shoes</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Glases</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Watches</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Hand Bags</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Bags</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>shirts</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>tempore</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>soluta
                                    nobis</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>molestiae</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>repudiandae
                                    sint</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>nobis est</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>assumenda
                                    est</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Anouk</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>tempore</label>
                            </div>
                        </div>
                    </section>
                    <section class="sky-form">
                        <h4>brand</h4>
                        <div class="row1 scroll-pane">
                            <div class="col col-4">
                                <label class="checkbox"><input type="checkbox" name="checkbox"
                                                               checked=""><i></i>Lee</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Anouk</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>tempore</label>
                            </div>
                            <div class="col col-4">
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>vishud</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>amari</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>shree</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Anouk</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>biba</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>shree</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Anouk</label>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- //products -->
<!--start-image-cursuals-->
<div class="scroll-slider">
    <div class="container">
        <div class="nbs-flexisel-container">
            <div class="nbs-flexisel-inner">
                <ul class="flexiselDemo3 nbs-flexisel-ul" style="left: -253.6px; display: block;">
                    <li onclick="location.href='#';" class="nbs-flexisel-item" style="width: 253.6px;"><img
                                src="../../web/assets/images/c3.png" alt=""/></li>
                    <li onclick="location.href='#';" class="nbs-flexisel-item" style="width: 253.6px;"><img
                                src="images/c4.png" alt=""/></li>
                    <li onclick="location.href='#';" class="nbs-flexisel-item" style="width: 253.6px;"><img
                                src="images/c1.png" alt=""/></li>
                    <li onclick="location.href='#';" class="nbs-flexisel-item" style="width: 253.6px;"><img
                                src="images/c2.png" alt=""/></li>
                    <li onclick="location.href='#';" class="nbs-flexisel-item" style="width: 253.6px;"><img
                                src="images/c3.png" alt=""/></li>
                    <li onclick="location.href='#';" class="nbs-flexisel-item" style="width: 253.6px;"><img
                                src="images/c4.png" alt=""/></li>
                    <li onclick="location.href='#';" class="nbs-flexisel-item" style="width: 253.6px;"><img
                                src="images/c1.png" alt=""/></li>
                    <li onclick="location.href='#';" class="nbs-flexisel-item" style="width: 253.6px;"><img
                                src="images/c2.png" alt=""/></li>
                </ul>
                <div class="nbs-flexisel-nav-left" style="top: 21.5px;"></div>
                <div class="nbs-flexisel-nav-right" style="top: 21.5px;"></div>
            </div>
        </div>
        <div class="clearfix"></div>
        <!--start-image-->
        <script type="text/javascript" src="../../web/assets/js/jquery.flexisel.js"></script>
        <!--//end-->
        <script type="text/javascript">
            $(window).load(function () {
                $(".flexiselDemo3").flexisel({
                    visibleItems: 5,
                    animationSpeed: 1000,
                    autoPlay: true,
                    autoPlaySpeed: 3000,
                    pauseOnHover: true,
                    enableResponsiveBreakpoints: true,
                    responsiveBreakpoints: {
                        portrait: {
                            changePoint: 480,
                            visibleItems: 2
                        },
                        landscape: {
                            changePoint: 640,
                            visibleItems: 3
                        },
                        tablet: {
                            changePoint: 768,
                            visibleItems: 3
                        }
                    }
                });
            });
        </script>
        <!---->
    </div>
</div>
<!--//end-bottom-->
<!--start-footer-->
<div class="footer">
    <div class="container">
        <div class="footer-top">
            <div class="col-md-2 footer-left">
                <h3>About Us</h3>
                <ul>
                    <li><a href="#">Who We Are</a></li>
                    <li><a href="contact.html">Contact Us</a></li>
                    <li><a href="#">Our Sites</a></li>
                    <li><a href="#">In The News</a></li>
                    <li><a href="#">Carrers</a></li>
                </ul>
            </div>
            <div class="col-md-2 footer-left">
                <h3>Your Account</h3>
                <ul>
                    <li><a href="account.html">Your Account</a></li>
                    <li><a href="#">Personal Information</a></li>
                    <li><a href="contact.html">Addresses</a></li>
                    <li><a href="#">Discount</a></li>
                    <li><a href="#">Track your order</a></li>
                </ul>
            </div>
            <div class="col-md-2 footer-left">
                <h3>Shopping</h3>
                <ul>
                    <li><a href="#">Accesories</a></li>
                    <li><a href="#">Books</a></li>
                    <li><a href="#">Cloths</a></li>
                    <li><a href="#">Bags</a></li>
                    <li><a href="#">Shoes</a></li>
                </ul>
            </div>
            <div class="col-md-2 footer-left ">
                <h3>Categories</h3>
                <ul>
                    <li><a href="#">Sports Shoes</a></li>
                    <li><a href="#">Casual Shorts</a></li>
                    <li><a href="#">Formal Shoes</a></li>
                    <li><a href="#">Party Wear</a></li>
                    <li><a href="#">Ethnic Wear</a></li>
                </ul>
            </div>
            <div class="col-md-2 footer-left lost">
                <h3>Life Style</h3>
                <ul>
                    <li><a href="#">Spa</a></li>
                    <li><a href="#">Beauty</a></li>
                    <li><a href="#">Travel</a></li>
                    <li><a href="#">Food</a></li>
                    <li><a href="#">Trends</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>
</div>
<ul class="socials">
    <li><a class="soc1" href="#"></a></li>
    <li><a class="soc2" href="#"></a></li>
    <li><a class="soc3" href="#"></a></li>
</ul>
<!--/start-copyright-->
<div class="copy">
    <div class="container">
        <p>&copy; 2015 Nuevo Shop. All Rights Reserved | Design by <a href="http://w3layouts.com/">W3layouts</a></p>
    </div>
</div>
<!--//end-copyright-->
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