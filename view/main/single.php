<?php

require_once "../../controller/products/single_product_controller.php";
require_once "../../controller/favourites/check_favourites_controller.php";

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>MagBuy | <?= $product['title'] ?></title>
    <link rel="shortcut icon" href="../../web/assets/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../../web/assets/images/favicon.ico" type="image/x-icon">
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

    <!-- CSS for reviews -->
    <link rel="stylesheet" href="../../web/assets/css/reviews.css" type="text/css"/>

    <!-- Normal Slider CSS -->
    <link rel="stylesheet" href="../../web/assets/css/simplerSlider.css">

    <style>
        #normalSlider {
            display: none !important;
        }
    </style>


    <!-- Replace flex slider under width -->
    <style>
        @media screen and (max-width: 1200px) {
            #flexSliderDiv {
                display: none !important;
            }

            #normalSlider {
                display: inline-block !important;
            }
        }
    </style>


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

                <!-- Normal Slider, display: none by default -->
                <div id="normalSlider" class="col-md-5 grid-single">
                    <div class="flexslider">
                        <ul class="slides">
                            <div class="w3-content" style="max-width:1200px">
                                <img class="mySlides" src="<?= $images[0]['image_url'] ?>" style="width:100%">
                                <img class="mySlides" src="<?= $images[1]['image_url'] ?>" style="width:100%">
                                <img class="mySlides" src="<?= $images[2]['image_url'] ?>" style="width:100%">

                                <div class="w3-row-padding w3-section">
                                    <div class="w3-col s4">
                                        <img class="demo w3-opacity w3-hover-opacity-off "
                                             src="<?= $images[0]['image_url'] ?>" style="width:100%"
                                             onclick="currentDiv(1)">
                                    </div>
                                    <div class="w3-col s4">
                                        <img class="demo w3-opacity w3-hover-opacity-off"
                                             src="<?= $images[1]['image_url'] ?>" style="width:100%"
                                             onclick="currentDiv(2)">
                                    </div>
                                    <div class="w3-col s4">
                                        <img class="demo w3-opacity w3-hover-opacity-off"
                                             src="<?= $images[2]['image_url'] ?>" style="width:100%"
                                             onclick="currentDiv(3)">
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </div>

                    <script src="../../web/assets/js/normalSlider.js"></script>

                    <!-- FlexSlider -->
                    <script src="../../web/assets/js/image_zoom.js"></script>
                    <script defer src="../../web/assets/js/jquery_flexslider.js"></script>
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



                <!-- Flex Slider -->

                <div id="flexSliderDiv" class="col-md-5 grid-single">
                    <div class="flexslider">
                        <ul class="slides">
                            <?php
                            foreach ($images as $image) {
                                ?>
                                <li data-thumb="<?= $image['image_url'] ?>">
                                    <div class="thumb-image"><img src="<?= $image['image_url'] ?>"
                                                                  data-imagezoom="true"
                                                                  class="img-responsive" alt=""/></div>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <!-- FlexSlider sourse -->
                    <script src="../../web/assets/js/image_zoom.js"></script>
                    <script defer src="../../web/assets/js/jquery_flexslider.js"></script>
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
                        <img id="averageRating" class="media-object img"
                             src="../../web/assets/images/rating<?=$product['average']?>.png"><br/>
                        <div class="clearfix"></div>
                        <button class="btn btn-default"
                                onclick="addToCart(<?= $product['id'] ?>, <?= $product['price'] ?>)"><span
                                    class="glyphicon glyphicon-shopping-cart"></span> Add to cart
                        </button>
                        <br/><br/>


                        <?php if (!($isFavourite == 3)) {

                            if ($isFavourite == 2) { ?>

                                <div id="favourite">
                                    <button style="display: inline-block;" class="btn btn-primary"
                                            onclick="addFavourite(<?= $product['id'] ?>)"><span
                                                class="glyphicon glyphicon-heart"></span> Add to favourites
                                    </button>
                                </div>

                            <?php } else { ?>

                                <div id="favourite">
                                    <button style="display: inline-block;" class="btn btn-danger"
                                            onclick="removeFavourite(<?= $product['id'] ?>)"><span
                                                class="glyphicon glyphicon-heart-empty"></span> Remove from Favourites
                                    </button>
                                </div>

                            <?php }
                        } ?>

                        <?php if (isset($_SESSION['loggedUser'])) { ?>
                            <br/>
                            <a href="review.php?pid=<?= $product['id'] ?>" style="display: inline-block;"
                               class="btn btn-primary btn-warning"><span class="glyphicon glyphicon-tag"></span> Add
                                Review</a>
                        <?php } ?>

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
                                reviews(<?= $reviewsCount ?>)
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                         aria-labelledby="headingThree">

                        <?php foreach ($reviews as $review) { ?>

                        <div class="tab-content">
                            <div class="tab-pane active" id="comments-logout">
                                <ul class="media-list">
                                    <li class="media">
                                        <div class="pull-left" href="#">
                                            <img class="media-object img-circle"
                                                 src="<?= $review['image_url']?>"
                                                 alt="profile">
                                        </div>
                                        <div class="media-body">
                                            <div class="well well-lg">
                                                <h4 class="media-heading text-uppercase reviews"><?= $review['title'] .
                                                    "<small>" . "&nbsp by " . $review['first_name'] . "</small>" ?><img
                                                            id="reviewRating" class="media-object img"
                                                            src=
                                                            "../../web/assets/images/rating<?=$review['rating']?>.png">
                                                </h4>
                                                <ul class="media-date text-uppercase reviews list-inline">
                                                    <li class="dd"> <?= $review['created_at'] ?></li>

                                                </ul>
                                                <p style="word-wrap: break-word;" class="media-comment">
                                                    <?= $review['comment'] ?>
                                                </p>
                                            </div>
                                        </div>
                                </ul>
                            </div>
                        </div>

                        <?php } ?>

                    </div>
                </div>
            </div>
            <!-- collapse -->
            <!--/start-latest-->
            <div class="collection-section">
                <?php if(count($relatedProducts)) { echo "<h3 class=\"tittle\">Related Products</h3>"; } ?>

                <div class="main_filtered_product-info">
                    <?php foreach ($relatedProducts as $product) { ?>
                        <div class="products-grd">
                            <div class="p-one simpleCart_shelfItem prd">
                                <a href="single.php?pid=<?= $product['id']; ?>">
                                    <img src="<?= $product['image_url'] ?>"
                                         alt="Product Image" class="img-responsive"/>
                                </a>
                                <h4><?= $product['title']; ?></h4>
                                <p><a class="btn btn-default btn-sm"
                                      onclick="addToCart(<?= $product['id'] . "," . $product['price'] ?>)">
                                        <i class="glyphicon glyphicon-shopping-cart"></i>&nbspAdd
                                    </a>&nbsp&nbsp<span
                                            class=" item_price valsa">$<?= $product['price']; ?></span></p>
                                <div class="pro-grd">
                                    <a href="single.php?pid=<?= $product['id']; ?>">View</a>
                                </div>
                            </div>
                        </div>
                <?php } ?>
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