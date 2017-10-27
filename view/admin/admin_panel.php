<?php
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
    <h3>Welcome, boss! What would you like to check?</h3>
    <a href="supercategories/supercategories_view.php">
        <button class="btn btn-sq-lg btn-primary"><i class="fa fa-code fa-4x" aria-hidden="true"></i><br>Super<br>Categories
        </button>
    </a>
    <a href="categories/categories_view.php">
        <button class="btn btn-sq-lg btn-primary"><i class="fa fa-code fa-4x" aria-hidden="true"></i><br>Categories
        </button>
    </a>
    <a href="subcategories/subcategories_view.php">
        <button class="btn btn-sq-lg btn-primary"><i class="fa fa-code fa-4x" aria-hidden="true"></i><br>Sub Categories
        </button>
    </a>
    <a href="subcategory_specs/subcat_spec_create.php">
        <button class="btn btn-sq-lg btn-primary"><i class="fa fa-code fa-4x" aria-hidden="true"></i><br>Subcategory<br>Specifications
        </button>
    </a><br>
    <a href="products_promotions_reviews/products_view.php">
        <button class="btn btn-sq-lg btn-primary"><i class="fa fa-cubes fa-4x" aria-hidden="true"></i><br>Products,<br>
            Reviews and<br>
            Promotions
        </button>
    </a>
    <a href="#">
        <button class="btn btn-sq-lg btn-primary"><i class="fa fa-user fa-4x" aria-hidden="true"></i><br>Users</button>
    </a>
    <a href="#">
        <button class="btn btn-sq-lg btn-primary"><i class="fa fa-plane fa-4x" aria-hidden="true"></i><br>Orders
        </button>
    </a>
</div>
</body>
</html>