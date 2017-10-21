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

<div class="container">

    <form action="../../controller/reviews/add_review_controller.php?pid=<?=$_GET['pid']?>" method="post">

        <style>
            label > input{ /* HIDE RADIO */
                visibility: hidden; /* Makes input not-clickable */
                position: absolute; /* Remove input from document flow */
            }
            label > input + img{ /* IMAGE STYLES */
                cursor:pointer;
                border:2px solid transparent;
            }
            label > input:checked + img{ /* (RADIO CHECKED) IMAGE STYLES */
                background-color: #FDF000;
                border-radius: 50%;

            }
        </style>

        <div style="margin-bottom: 35px;"></div>
        <label>Rating</label>
        <div style="margin-bottom: 15px;"></div>
        <label class="radio-inline"><input type="radio" name="rating" value="1" required><img style="height: 40px; width: auto;" src="../../web/uploads/magbuy/star1.png"></label>
        <label class="radio-inline"><input type="radio" name="rating" value="2" required><img style="height: 43px; width: auto;" src="../../web/uploads/magbuy/star2.png"></label>
        <label class="radio-inline"><input type="radio" name="rating" value="3" required><img style="height: 46px; width: auto;" src="../../web/uploads/magbuy/star3.png"></label>
        <label class="radio-inline"><input type="radio" name="rating" value="4" required><img style="height: 49px; width: auto;" src="../../web/uploads/magbuy/star4.png"></label>
        <label class="radio-inline"><input type="radio" name="rating" value="5" required><img style="height: 52px; width: auto;" src="../../web/uploads/magbuy/star5.png"></label>

        <div class="clearfix"></div>

        <label for="title" style="margin-top: 20px;">Title</label>
        <input class="form-control" type="text" name="title" placeholder="Enter Title" id="title" required>

        <label for="reviewArea" style="margin-top: 20px;">Review</label>
        <textarea class="form-control" rows="5" name="review" id="reviewArea"></textarea><br/>

        <button style="margin-bottom: 50px;" type="submit" class="btn btn-primary btn-warning"><span class="glyphicon glyphicon-tag"></span> Add Review</button>

    </form>

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