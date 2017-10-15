<?php

//Check for Session
//require_once "../../utility/session_main.php";


//Autoload to require needed model files
function __autoload($className)
{
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}

if (isset($_POST['submit'])) {
    $product = new \model\Product();

    //Try to accomplish connection with the database
    try {

        $productDao = \model\database\ProductsDao::getInstance();

        $product->setTitle(htmlentities($_POST['title']));
        $product->setDescription(htmlentities($_POST['description']));
        $product->setPrice(htmlentities($_POST['price']));
        $product->setQuantity(htmlentities($_POST['quantity']));
        $product->setSubcategoryId(htmlentities($_POST['subcategory_id']));

        $id = $productDao->createNewProduct($product);

        header("Location: ../../view/main/main.php");

    } catch (PDOException $e) {

        header("Location: ../../view/error/pdo_error.php");
    }

} else {

    //Locate to error page
}