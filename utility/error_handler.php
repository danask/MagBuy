<?php

//Error handler function for error 500
if(!function_exists('Error500')) {
    function Error500(){
        header('Location: ../view/error/error_500');
        die();
    }
}

//Set error handler
set_error_handler("Error500");


