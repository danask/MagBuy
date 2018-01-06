<?php

// Start Session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user have session (if user is logged)
if (!isset($_SESSION['role']) || $_SESSION['role'] == 1) {

    //Redirect to Error
    header("Location: ../../view/error/error_400.php");
    die();
}

//Check if user is blocked
require_once "../../utility/blocked_user.php";

require_once "../elements/headers.php";
?>
<meta charset="UTF-8">
<title>Admin Panel</title>
<link rel="stylesheet" href="../../web/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../../web/assets/css/adminPanel.css">
<link rel="stylesheet" href="../../web/assets/css/font-awesome.min.css">
</head>
<?php
//Include Header
require_once "../elements/header.php";
?>
<body>
<br><br><br><br>
<a href="../main/index.php">
    <button class="btn btn-primary">Back to homepage</button>
</a>
<div align="center">
    <h3>Welcome! What would you like to check?</h3>
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 3) { ?>
    <a href="supercategories/supercategories_view.php">
        <button class="btn btn-sq-lg btn-primary"><i class="fa fa-th-large fa-4x" aria-hidden="true"></i><br>Super<br>Categories
        </button>
    </a>
    <a href="categories/categories_view.php">
        <button class="btn btn-sq-lg btn-primary"><i class="fa fa-th fa-4x" aria-hidden="true"></i><br>Categories
        </button>
    </a>
    <a href="subcategories/subcategories_view.php">
        <button class="btn btn-sq-lg btn-primary"><i class="fa fa-th-list fa-4x" aria-hidden="true"></i><br>Sub
            Categories
        </button>
    </a>
    <a href="subcategory_specs/subcat_specs_view.php">
        <button class="btn btn-sq-lg btn-primary"><i class="fa fa-info fa-4x" aria-hidden="true"></i><br>Subcategory<br>Specifications
        </button>
    </a><br>
    <?php } ?>
    <a href="products_promotions_reviews/products_view.php">
        <button class="btn btn-sq-lg btn-primary"><i class="fa fa-cubes fa-4x" aria-hidden="true"></i><br>Products
            and<br>
            Promotions
        </button>
    </a>
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 3) { ?>
    <a href="users/users_view.php">
        <button class="btn btn-sq-lg btn-primary"><i class="fa fa-user fa-4x" aria-hidden="true"></i><br>Users</button>
    </a>
    <?php } ?>
    <a href="orders/orders_view.php">
        <button class="btn btn-sq-lg btn-primary"><i class="fa fa-plane fa-4x" aria-hidden="true"></i><br>Orders
        </button>
    </a>
</div>
</body>
</html>