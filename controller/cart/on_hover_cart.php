<?php

require_once '../../utility/error_handler.php';

session_start();
$cart = $_SESSION['cart'];

foreach ($cart as $value) {

}


function object_to_array($data)
{
    if(is_array($data) || is_object($data))
    {
        $result = array();

        foreach($data as $key => $value) {
            $result[$key] = $this->object_to_array($value);
        }

        return $result;
    }

    return $data;
}
