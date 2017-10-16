<?php
require_once "../../controller/navigation/navigation_controller.php";
?>
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