<?php 

    include_once 'api.php';

    $api = new API();

    $code = $_GET['id'];
    $product = $_GET['product'];

    if  ( isset($code) ) 
        $api->getByCategory($code);
    else if ( isset($product) )
        $api->getProduct($product);
    else 
        $api->showAll();
