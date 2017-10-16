<?php

//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

if (isset($_POST['submit'])) {
    $product = new \model\Product();

    $product->setTitle(htmlentities($_POST['title']));
    $product->setDescription(htmlentities($_POST['description']));
    $product->setPrice(htmlentities($_POST['price']));
    $product->setQuantity(htmlentities($_POST['quantity']));
    $subcatId = $_POST['subcategory_id'];
    $product->setSubcategoryId(htmlentities($subcatId));

    //Try to accomplish connection with the database
    try {

        $productDao = \model\database\ProductsDao::getInstance();

        $id = $productDao->createNewProduct($product);

        header("Location: ../../view/admin/product_spec_add.php?pid=$id&subcid=$subcatId");

    } catch (PDOException $e) {

        header("Location: ../../view/error/pdo_error.php");
    }

} elseif (isset($_POST['final_submit'])) {


} else {
    //Locate to error page
}