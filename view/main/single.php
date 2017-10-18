<?php

require_once "../../controller/products/single_product_controller.php";
require_once "../../controller/favourites/check_favourites_controller.php";

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Nuevo Shop a Ecommerce Online Shopping Flat Bootstarp Resposive Website Template |Single :: w3layouts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="Nuevo Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design"/>
    <script type="applijegleryion/x-javascript">
         addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }

    </script>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f5f5f5
        }
    </style>
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
    <script src="../../web/assets/js/bootstrap.js"></script>
    <!--web-fonts-->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,300italic,600,700' rel='stylesheet'
          type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Roboto+Slab:300,400,700' rel='stylesheet' type='text/css'>
    <!--//web-fonts-->
    <script src="../../web/assets/js/modernizr.custom.js"></script>
    <script type="text/javascript" src="../../web/assets/js/move-top.js"></script>
    <script type="text/javascript" src="../../web/assets/js/easing.js"></script>
    <link rel="stylesheet" href="../../web/assets/css/flexslider.css" type="text/css" media="screen"/>

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

    <!--Script for adding product to favourites -->
    <script type="text/javascript" src="../../web/assets/js/add_favourites.js"></script>

</head>
<body>
<?php
require_once "../elements/header.php";
require_once "../elements/navigation.php";
?>
<!--start-content-->
<!-- products -->
<div class="products">
    <div class="container">
        <div class="products-grids">
            <div class="col-md-8 products-single">
                <div class="col-md-5 grid-single">
                    <div class="flexslider">
                        <ul class="slides">
                            <li data-thumb="images/z1.jpg">
                                <div class="thumb-image"><img src="../../web/assets/images/z1.jpg" data-imagezoom="true"
                                                              class="img-responsive" alt=""/></div>
                            </li>
                            <li data-thumb="images/z2.jpg">
                                <div class="thumb-image"><img src="../../web/assets/images/z2.jpg" data-imagezoom="true"
                                                              class="img-responsive" alt=""/></div>
                            </li>
                            <li data-thumb="images/z4.jpg">
                                <div class="thumb-image"><img src="../../web/assets/images/z4.jpg" data-imagezoom="true"
                                                              class="img-responsive" alt=""/></div>
                            </li>

                        </ul>
                    </div>
                    <!-- FlexSlider -->
                    <script src="../../web/assets/js/imagezoom.js"></script>
                    <script defer src="../../web/assets/js/jquery.flexslider.js"></script>
                    <script>
                        // Can also be used with $(document).ready()
                        $(window).load(function () {
                            $('.flexslider').flexslider({
                                animation: "slide",
                                controlNav: "thumbnails"
                            });
                        });
                    </script>

                </div>
                <div class="col-md-7 single-text">
                    <div class="details-left-info simpleCart_shelfItem">
                        <h3><?= $product['title']; ?></h3>
                        <p class="availability">Availability: <span class="color">In stock</span></p>
                        <div class="price_single">
                            <span class="reducedfrom">$800.00</span>
                            <span class="actual item_price">$<?= $product['price']; ?></span>
                        </div>
                        <h2 class="quick">Quick Overview</h2>
                        <p class="quick_desc"><?= $product['description']; ?></p>
                        <div class="clearfix"></div>
                        <button class="btn btn-default"
                                onclick="addToCart(<?= $product['id'] ?>, <?= $product['price'] ?>)">Add to cart
                        </button><br/><br/>


                        <?php if (!($isFavourite == 3)) {

                            if ($isFavourite == 2) { ?>

                                <div id="favourite">
                                    <button style="display: inline-block;" class="btn btn-primary" onclick="addFavourite(<?= $product['id'] ?>)">Add to favourites</button>
                                </div>

                            <?php } else { ?>

                                <div id="favourite">
                                    <button style="display: inline-block;" class="btn btn-danger" onclick="removeFavourite(<?= $product['id'] ?>)">Remove from Favourites</button>
                                </div>

                            <?php }
                        } ?>



                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <!-- collapse -->
            <div class="panel-group collpse" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                               aria-expanded="true" aria-controls="collapseOne">
                                Description
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                         aria-labelledby="headingOne">
                        <div class="panel-body">
                            <?= $product['description']; ?>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                               href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Specifications
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                            <table>
                                <tr>
                                    <th>Specification</th>
                                    <th>Value</th>
                                </tr>
                                <?php
                                foreach ($specifications as $spec) {
                                    ?>
                                    <tr>
                                        <td><?= $spec['name']; ?></td>
                                        <td><?= $spec['value']; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThree">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                               href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                reviews(5)
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                         aria-labelledby="headingThree">
                        <div class="panel-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                            squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                            nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                            single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft
                            beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice
                            lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you
                            probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
            </div>
            <!-- collapse -->
            <!--/start-latest-->
            <div class="collection-section">
                <h3 class="tittle">Related Products</h3>

                <div class="fashion-info">
                    <div class="col-md-4 fashion-grids">
                        <figure class="effect-bubba">
                            <img src="../../web/assets/images/f4.jpg" alt=""/>
                            <figcaption>
                                <h4>Nuevo Shop</h4>
                                <p class="cart"><a href="#">Shop</a></p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="col-md-4 fashion-grids">
                        <figure class="effect-bubba">
                            <img src="../../web/assets/images/f5.jpg" alt=""/>
                            <figcaption>
                                <h4>Nuevo Shop</h4>
                                <p class="cart"><a href="#">Shop</a></p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="col-md-4 fashion-grids">
                        <figure class="effect-bubba">
                            <img src="../../web/assets/images/f6.jpg" alt=""/>
                            <figcaption>
                                <h4>Nuevo Shop</h4>
                                <p class="cart"><a href="#">Shop</a></p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!--//latest-->
    </div>
</div>
<!-- //products -->
<!--start-bottom-->
<!--start-image-cursuals-->
<?php
require_once "../elements/footer.php";
?>
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