<?php

//Autoload to require needed model files
function __autoload($className) {
    $className = '..\\..\\' . $className;
    require_once str_replace("\\", "/", $className) . '.php';
}


//Echo empty JSON if search is empty
if ($_GET['needle'] == "") {

    echo "{}";
} else {

//Try to accomplish connection with the database
    try {

        $searchDao = \model\database\ProductsDao::getInstance();

        $result = $searchDao->searchProduct($_GET['needle']);

        $resultJson = json_encode($result, JSON_UNESCAPED_SLASHES);
        echo $resultJson;


    } catch (PDOException $e) {

        header("Location: ../../view/error/pdo_error.php");
    }

}