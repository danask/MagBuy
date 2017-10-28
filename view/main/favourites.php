<?php
//Include all favourite products controller
require_once "../../controller/favourites/all_favourites_user_controller.php";
//Include main Headers
require_once "../elements/headers.php";
?>

    <!-- Script for removing product from favourites -->
    <script type="text/javascript" src="../../web/assets/js/favourites.js"></script>

    <!-- Define Page Name -->
    <title>MagBuy | Favourites</title>

<?php
//Include Header
require_once "../elements/header.php";
//Include Navigation
require_once "../elements/navigation.php";
?>

    <!-- Show favourite products -->
    <div class="cart-items">
        <div class="container">
            <h3 id='favouritesTitle' class="title">
                <?= (count($products) ? "My Favourites" : "No Favourite Products Found") ?> </h3>

            <?php foreach ($products as $product) { ?>
                <div id="deleteItem<?= $product['id'] ?>">
                    <div class="cart-header">
                        <div class="close1" onclick="removeFavouriteList(<?= $product['id'] ?>)"></div>
                        <div class="cart-sec simpleCart_shelfItem">
                            <div class="cart-item cyc">
                                <a href="single.php?pid=<?= $product['id'] ?>">
                                    <img src="<?= $product['image_url'] ?>" class="img-responsive" alt=""></a>
                            </div>
                            <div class="cart-item-info">
                                <h3><a href="single.php?pid=<?= $product['id'] ?>"> <?= $product['title'] ?> </a></h3>
                                <div class="delivery">
                                    <p>$<?= $product['price'] ?></p>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

<?php
//Include Footer
require_once "../elements/footer.php";
?>